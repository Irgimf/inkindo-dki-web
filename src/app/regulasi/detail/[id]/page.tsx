/* eslint-disable @typescript-eslint/no-explicit-any */
import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Footer from '@/components/Footer';
import { getPayload } from 'payload';
import config from '@/payload.config';
import { connection } from 'next/server';
import Link from 'next/link';
import { notFound } from 'next/navigation';

export const dynamic = 'force-dynamic';

export async function generateMetadata({ params }: { params: Promise<{ id: string }> }) {
  await connection();
  const resolvedParams = await params;
  const payload = await getPayload({ config });
  
  try {
    const reg = await payload.findByID({
      collection: 'regulations',
      id: resolvedParams.id,
    });
    return {
      title: `${reg.title} - Regulasi INKINDO DKI Jakarta`,
      description: reg.summary || `Dokumen regulasi ${reg.number} tahun ${reg.year}`,
    };
  } catch (err) {
    return { title: 'Regulasi Tidak Ditemukan' };
  }
}

export default async function RegulasiDetailPage({ 
  params, 
}: { 
  params: Promise<{ id: string }>,
}) {
  await connection();
  const resolvedParams = await params;
  const payload = await getPayload({ config });
  
  let reg: any;
  try {
    reg = await payload.findByID({
      collection: 'regulations',
      id: resolvedParams.id,
      depth: 1, // To get the pdfFile object
    });
  } catch (error) {
    notFound();
  }

  // Fetch globals
  const siteSettings = await payload.findGlobal({ slug: 'site-settings' });
  const externalLinks = await payload.findGlobal({ slug: 'external-links' });
  const navigation = await payload.findGlobal({ slug: 'navigation' });

  const categoryMap: Record<string, string> = {
    inkindo: 'inkindo',
    jasa_konsultansi: 'jasa-konsultansi',
    terkait: 'terkait',
  };

  const backLink = `/regulasi/${categoryMap[reg.category]}`;

  return (
    <>
      <Header settings={siteSettings} />
      <SideNavigation links={externalLinks} />
      
      <main className="page-main pt-24 pb-20 bg-slate-50 min-h-screen">
        <div className="container mx-auto px-4 max-w-5xl">
          {/* Back button */}
          <Link href={backLink} className="inline-flex items-center gap-2 text-slate-500 hover:text-royal mb-6 transition-colors">
            <span className="material-symbols-outlined">arrow_back</span> Kembali ke Daftar Regulasi
          </Link>

          <div className="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 mb-8">
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8 border-b border-slate-100 pb-8">
              <div>
                <div className="flex items-center gap-3 mb-4">
                  <span className={`text-xs font-bold px-3 py-1 rounded-full ${reg.status === 'berlaku' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                    {reg.status === 'berlaku' ? 'Berlaku' : 'Dicabut'}
                  </span>
                  <span className="text-sm font-semibold text-royal bg-blue-50 px-3 py-1 rounded-full">Tahun {reg.year}</span>
                  {reg.subCategory && <span className="text-sm text-slate-500">{reg.subCategory.replace('_', ' ')}</span>}
                </div>
                <h1 className="text-3xl md:text-4xl font-bold text-slate-900 mb-2 leading-tight">{reg.title}</h1>
                <p className="text-xl text-slate-500 font-medium">Nomor: {reg.number}</p>
              </div>
              
              <div className="flex flex-col items-center shrink-0 w-full md:w-auto">
                <a href={`/api/download/${reg.id}`} target="_blank" rel="noopener noreferrer" className="w-full md:w-auto bg-royal hover:bg-blue-800 text-white text-center font-bold py-4 px-8 rounded-xl transition-colors flex items-center justify-center gap-3 shadow-lg shadow-royal/30 hover:shadow-royal/50 hover:-translate-y-1">
                  <span className="material-symbols-outlined">download</span> Unduh Dokumen
                </a>
                <span className="text-sm text-slate-400 mt-3 font-medium">{reg.downloads || 0} kali diunduh</span>
              </div>
            </div>

            {reg.summary && (
              <div className="mb-10">
                <h3 className="text-lg font-bold text-slate-900 mb-3">Ringkasan</h3>
                <p className="text-slate-600 leading-relaxed text-lg">{reg.summary}</p>
              </div>
            )}

            <div className="pdf-preview-container rounded-2xl overflow-hidden border-2 border-slate-200 bg-slate-100">
              <div className="bg-slate-800 text-white p-3 flex justify-between items-center">
                <span className="font-semibold text-sm flex items-center gap-2">
                  <span className="material-symbols-outlined text-sm">picture_as_pdf</span>
                  Pratinjau Dokumen
                </span>
                <a href={reg.pdfFile?.url} target="_blank" rel="noopener noreferrer" className="text-xs hover:text-blue-300 flex items-center gap-1">
                  Buka di Tab Baru <span className="material-symbols-outlined text-xs">open_in_new</span>
                </a>
              </div>
              {reg.pdfFile?.url ? (
                <iframe 
                  src={`${reg.pdfFile.url}#toolbar=0`} 
                  className="w-full h-[600px] md:h-[800px]" 
                  title={reg.title}
                ></iframe>
              ) : (
                <div className="w-full h-[400px] flex flex-col items-center justify-center text-slate-400">
                  <span className="material-symbols-outlined text-6xl mb-3">broken_image</span>
                  <p>File PDF tidak tersedia untuk dipratinjau.</p>
                </div>
              )}
            </div>
          </div>
        </div>
      </main>

      <Footer settings={siteSettings} navigation={navigation} />
    </>
  );
}
