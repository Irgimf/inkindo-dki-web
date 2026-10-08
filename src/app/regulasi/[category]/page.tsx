/* eslint-disable @typescript-eslint/no-explicit-any */
import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Footer from '@/components/Footer';
import { getPayload } from 'payload';
import config from '@/payload.config';
import { connection } from 'next/server';
import Link from 'next/link';

export const dynamic = 'force-dynamic';

export async function generateMetadata({ params }: { params: Promise<{ category: string }> }) {
  const resolvedParams = await params;
  const titles: Record<string, string> = {
    inkindo: 'Regulasi INKINDO',
    'jasa-konsultansi': 'Regulasi Jasa Konsultansi',
    terkait: 'Regulasi Terkait',
  };
  return {
    title: `${titles[resolvedParams.category] || 'Regulasi'} - INKINDO DKI Jakarta`,
  };
}

export default async function RegulasiCategoryPage({ 
  params, 
  searchParams 
}: { 
  params: Promise<{ category: string }>,
  searchParams: Promise<{ [key: string]: string | string[] | undefined }>
}) {
  await connection();
  const resolvedParams = await params;
  const resolvedSearchParams = await searchParams;

  const payload = await getPayload({ config });
  
  const categoryMap: Record<string, string> = {
    inkindo: 'inkindo',
    'jasa-konsultansi': 'jasa_konsultansi',
    terkait: 'terkait',
  };

  const payloadCategory = categoryMap[resolvedParams.category];
  
  if (!payloadCategory) {
    return <div className="p-20 text-center">Kategori tidak ditemukan</div>;
  }

  const q = typeof resolvedSearchParams.q === 'string' ? resolvedSearchParams.q : '';
  const year = typeof resolvedSearchParams.year === 'string' ? resolvedSearchParams.year : '';
  const status = typeof resolvedSearchParams.status === 'string' ? resolvedSearchParams.status : '';
  const sub = typeof resolvedSearchParams.subCategory === 'string' ? resolvedSearchParams.subCategory : '';
  const page = typeof resolvedSearchParams.page === 'string' ? parseInt(resolvedSearchParams.page, 10) : 1;

  // Build where clause
  const where: any = {
    category: { equals: payloadCategory }
  };

  if (q) {
    where.or = [
      { title: { like: q } },
      { number: { like: q } }
    ];
  }
  
  if (year) {
    where.year = { equals: parseInt(year, 10) };
  }
  
  if (status) {
    where.status = { equals: status };
  }
  
  if (sub && payloadCategory === 'jasa_konsultansi') {
    where.subCategory = { equals: sub };
  }

  // Fetch regulations
  const regulations = await payload.find({
    collection: 'regulations',
    where,
    limit: 10,
    page,
    sort: '-year',
  });

  // Fetch globals
  const siteSettings = await payload.findGlobal({ slug: 'site-settings' });
  const externalLinks = await payload.findGlobal({ slug: 'external-links' });
  const navigation = await payload.findGlobal({ slug: 'navigation' });

  const titles: Record<string, string> = {
    inkindo: 'Regulasi INKINDO',
    'jasa-konsultansi': 'Regulasi Jasa Konsultansi',
    terkait: 'Regulasi Terkait',
  };

  return (
    <>
      <Header settings={siteSettings} />
      <SideNavigation links={externalLinks} />
      
      <main className="page-main pt-24 pb-20 bg-slate-50 min-h-screen">
        <div className="container mx-auto px-4 max-w-6xl">
          <header className="mb-8 text-center">
            <h1 className="text-4xl font-bold text-slate-900 mb-4">{titles[resolvedParams.category]}</h1>
            <div className="w-24 h-1 bg-royal mx-auto rounded-full"></div>
          </header>

          <div className="flex flex-col lg:flex-row gap-8">
            {/* Sidebar Filters */}
            <aside className="w-full lg:w-1/4">
              <form className="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6 sticky top-24">
                <h3 className="font-bold text-lg border-b pb-2">Filter Pencarian</h3>
                
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-2">Kata Kunci (Judul/Nomor)</label>
                  <input type="text" name="q" defaultValue={q} placeholder="Cari regulasi..." className="w-full border-slate-300 rounded-lg shadow-sm focus:border-royal focus:ring-royal" />
                </div>

                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-2">Tahun</label>
                  <input type="number" name="year" defaultValue={year} placeholder="Contoh: 2023" className="w-full border-slate-300 rounded-lg shadow-sm focus:border-royal focus:ring-royal" />
                </div>

                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-2">Status</label>
                  <select name="status" defaultValue={status} className="w-full border-slate-300 rounded-lg shadow-sm focus:border-royal focus:ring-royal">
                    <option value="">Semua Status</option>
                    <option value="berlaku">Berlaku</option>
                    <option value="dicabut">Dicabut/Tidak Berlaku</option>
                  </select>
                </div>

                {payloadCategory === 'jasa_konsultansi' && (
                  <div>
                    <label className="block text-sm font-medium text-slate-700 mb-2">Sub Kategori</label>
                    <select name="subCategory" defaultValue={sub} className="w-full border-slate-300 rounded-lg shadow-sm focus:border-royal focus:ring-royal">
                      <option value="">Semua Sub Kategori</option>
                      <option value="konstruksi">Konstruksi</option>
                      <option value="non_konstruksi">Non Konstruksi</option>
                      <option value="umum">Umum</option>
                    </select>
                  </div>
                )}

                <button type="submit" className="w-full bg-royal hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition-colors">
                  Terapkan Filter
                </button>
                
                {(q || year || status || sub) && (
                  <Link href={`/regulasi/${resolvedParams.category}`} className="block text-center text-sm text-slate-500 hover:text-royal mt-2">
                    Reset Filter
                  </Link>
                )}
              </form>
            </aside>

            {/* List */}
            <div className="w-full lg:w-3/4 space-y-4">
              <div className="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex justify-between items-center">
                <span className="text-slate-600">Menampilkan <strong>{regulations.totalDocs}</strong> dokumen</span>
              </div>

              {regulations.docs.length > 0 ? (
                regulations.docs.map((doc: any) => (
                  <div key={doc.id} className="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-2">
                        <span className={`text-xs font-bold px-3 py-1 rounded-full ${doc.status === 'berlaku' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                          {doc.status === 'berlaku' ? 'Berlaku' : 'Dicabut'}
                        </span>
                        <span className="text-sm font-semibold text-royal bg-blue-50 px-3 py-1 rounded-full">Tahun {doc.year}</span>
                        {doc.subCategory && <span className="text-sm text-slate-500">{doc.subCategory.replace('_', ' ')}</span>}
                      </div>
                      <h2 className="text-xl font-bold text-slate-900 mb-1">{doc.title}</h2>
                      <p className="text-slate-500 text-sm mb-3">Nomor: {doc.number}</p>
                      {doc.summary && <p className="text-slate-600 line-clamp-2 text-sm">{doc.summary}</p>}
                    </div>
                    <div className="flex flex-col gap-2 min-w-[140px]">
                      <Link href={`/regulasi/detail/${doc.id}`} className="bg-slate-100 hover:bg-slate-200 text-slate-800 text-center font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span className="material-symbols-outlined text-sm">visibility</span> Detail
                      </Link>
                      <a href={`/api/download/${doc.id}`} target="_blank" rel="noopener noreferrer" className="bg-royal hover:bg-blue-800 text-white text-center font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span className="material-symbols-outlined text-sm">download</span> Unduh
                      </a>
                      <span className="text-xs text-center text-slate-400 mt-1">{doc.downloads || 0} kali diunduh</span>
                    </div>
                  </div>
                ))
              ) : (
                <div className="text-center py-20 bg-white rounded-2xl shadow-sm border border-slate-100">
                  <span className="material-symbols-outlined text-5xl text-slate-300 mb-3">search_off</span>
                  <p className="text-slate-500">Tidak ada regulasi yang sesuai kriteria.</p>
                </div>
              )}

              {/* Pagination */}
              {regulations.totalPages > 1 && (
                <div className="flex justify-center gap-2 mt-8">
                  {regulations.hasPrevPage && (
                    <Link href={`?page=${regulations.prevPage}&q=${q}&year=${year}&status=${status}&subCategory=${sub}`} className="px-4 py-2 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">
                      Sebelumnya
                    </Link>
                  )}
                  <span className="px-4 py-2 bg-royal text-white rounded-lg">
                    Halaman {regulations.page} dari {regulations.totalPages}
                  </span>
                  {regulations.hasNextPage && (
                    <Link href={`?page=${regulations.nextPage}&q=${q}&year=${year}&status=${status}&subCategory=${sub}`} className="px-4 py-2 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">
                      Selanjutnya
                    </Link>
                  )}
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
