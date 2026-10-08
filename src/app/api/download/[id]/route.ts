import { getPayload } from 'payload';
import config from '@/payload.config';
import { NextRequest, NextResponse } from 'next/server';

// Simple in-memory rate limiting map (IP -> timestamp array)
// Note: In production, use Redis or database for rate limiting across serverless instances.
const rateLimitMap = new Map<string, number[]>();

export async function GET(
  request: NextRequest,
  { params }: { params: Promise<{ id: string }> }
) {
  const resolvedParams = await params;
  const ip = request.headers.get('x-forwarded-for') || request.ip || 'unknown';
  
  // Rate limiting logic: Max 10 downloads per 5 minutes per IP
  const now = Date.now();
  const windowMs = 5 * 60 * 1000;
  const maxRequests = 10;
  
  if (!rateLimitMap.has(ip)) {
    rateLimitMap.set(ip, [now]);
  } else {
    const timestamps = rateLimitMap.get(ip)!;
    // Remove timestamps older than windowMs
    const validTimestamps = timestamps.filter(t => now - t < windowMs);
    
    if (validTimestamps.length >= maxRequests) {
      return new NextResponse('Terlalu banyak permintaan unduhan. Silakan coba beberapa saat lagi.', { status: 429 });
    }
    
    validTimestamps.push(now);
    rateLimitMap.set(ip, validTimestamps);
  }

  const payload = await getPayload({ config });

  try {
    const reg = await payload.findByID({
      collection: 'regulations',
      id: resolvedParams.id,
      depth: 1,
    });

    if (!reg || !reg.pdfFile) {
      return new NextResponse('File tidak ditemukan', { status: 404 });
    }

    // Increment download counter
    await payload.update({
      collection: 'regulations',
      id: resolvedParams.id,
      data: {
        downloads: (reg.downloads || 0) + 1,
      },
    });

    // Redirect to the actual file URL
    // @ts-expect-error - pdfFile is populated as media object
    const fileUrl = reg.pdfFile.url;
    
    return NextResponse.redirect(new URL(fileUrl, request.url));
  } catch (error) {
    return new NextResponse('Terjadi kesalahan pada server', { status: 500 });
  }
}
