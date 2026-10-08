/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable @next/next/no-img-element */
import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Footer from '@/components/Footer';
import { getPayload } from 'payload';
import config from '@/payload.config';
import { connection } from 'next/server';
import Link from 'next/link';

export const dynamic = 'force-dynamic';

export async function generateMetadata() {
  await connection();
  const payload = await getPayload({ config });
  const page = await payload.find({
    collection: 'pages',
    where: { slug: { equals: 'profil' } },
  });
  const pageData = page.docs[0];
  return {
    title: pageData?.seo?.metaTitle || pageData?.title || 'Profil INKINDO DKI Jakarta',
    description: pageData?.seo?.metaDescription || 'Halaman profil Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta.',
  };
}

export default async function Profil() {
  await connection();
  const payload = await getPayload({ config });
  
  // Fetch layout data
  const pageRes = await payload.find({
    collection: 'pages',
    where: { slug: { equals: 'profil' } },
  });
  
  const pageData = pageRes.docs[0];
  const layout = pageData?.layout || [];

  // Fetch globals for layout shell
  const siteSettings = await payload.findGlobal({ slug: 'site-settings' });
  const externalLinks = await payload.findGlobal({ slug: 'external-links' });
  const navigation = await payload.findGlobal({ slug: 'navigation' });

  return (
    <>
      <Header settings={siteSettings} />
      <SideNavigation links={externalLinks} />
      
      <main className="page-main pt-24 pb-20">
        <div className="container mx-auto px-4 max-w-5xl">
          <header className="mb-12 text-center">
            <h1 className="text-4xl md:text-5xl font-bold text-slate-900 mb-4">{pageData?.title || 'Profil INKINDO DKI Jakarta'}</h1>
            <div className="w-24 h-1 bg-royal mx-auto rounded-full"></div>
          </header>

          <div className="layout-builder space-y-16">
            {layout.length > 0 ? (
              layout.map((block: any, idx: number) => {
                if (block.blockType === 'content') {
                  return (
                    <div key={idx} className="prose prose-lg max-w-none text-slate-700">
                      {/* For now, just render raw JSON or a fallback string. Ideally we'd use a Lexical renderer */}
                      <p><em>Konten teks dinamis (Lexical Rich Text) akan dirender di sini.</em></p>
                    </div>
                  );
                }
                
                if (block.blockType === 'image') {
                  return (
                    <figure key={idx} className={`my-8 ${block.fullWidth ? 'w-full' : 'max-w-3xl mx-auto'}`}>
                      <img src={block.image?.url || '/assets/placeholder.jpg'} alt={block.image?.alt || 'Profil Image'} className="w-full h-auto rounded-xl shadow-lg" />
                      {block.caption && <figcaption className="text-center text-sm text-slate-500 mt-3">{block.caption}</figcaption>}
                    </figure>
                  );
                }

                if (block.blockType === 'visionMission') {
                  return (
                    <div key={idx} className="vision-mission-grid grid md:grid-cols-2 gap-8 my-12">
                      <div className="vision-card bg-royal text-white p-8 rounded-2xl shadow-xl">
                        <div className="flex items-center gap-3 mb-6">
                          <span className="material-symbols-outlined text-4xl">visibility</span>
                          <h2 className="text-3xl font-bold m-0">Visi</h2>
                        </div>
                        <p className="text-lg leading-relaxed">{block.vision}</p>
                      </div>
                      <div className="mission-card bg-white border border-slate-200 p-8 rounded-2xl shadow-xl">
                        <div className="flex items-center gap-3 mb-6">
                          <span className="material-symbols-outlined text-4xl text-royal">rocket_launch</span>
                          <h2 className="text-3xl font-bold m-0 text-slate-900">Misi</h2>
                        </div>
                        <ul className="space-y-4">
                          {block.missions?.map((m: any, i: number) => (
                            <li key={i} className="flex gap-4">
                              <span className="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-royal flex items-center justify-center font-bold">{i + 1}</span>
                              <span className="text-slate-700 leading-relaxed">{m.item}</span>
                            </li>
                          ))}
                        </ul>
                      </div>
                    </div>
                  );
                }

                if (block.blockType === 'timeline') {
                  return (
                    <div key={idx} className="timeline-container relative my-16">
                      <h2 className="text-3xl font-bold text-center mb-12">Jejak Langkah</h2>
                      <div className="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-slate-200"></div>
                      <div className="space-y-12">
                        {block.events?.map((ev: any, i: number) => (
                          <div key={i} className={`flex items-center w-full ${i % 2 === 0 ? 'justify-start' : 'justify-end'}`}>
                            <div className={`w-1/2 ${i % 2 === 0 ? 'pr-8 text-right' : 'pl-8 text-left'} relative`}>
                              {/* Marker */}
                              <div className={`absolute top-1/2 transform -translate-y-1/2 w-6 h-6 rounded-full bg-royal border-4 border-white shadow ${i % 2 === 0 ? '-right-3' : '-left-3'}`}></div>
                              
                              <span className="text-royal font-bold text-xl block mb-2">{ev.year}</span>
                              <h3 className="text-xl font-bold text-slate-900 mb-2">{ev.title}</h3>
                              <p className="text-slate-600">{ev.description}</p>
                            </div>
                          </div>
                        ))}
                      </div>
                    </div>
                  );
                }

                return null;
              })
            ) : (
              // Fallback Layout if CMS is empty
              <div className="text-center py-20 text-slate-500">
                <span className="material-symbols-outlined text-6xl mb-4 text-slate-300">note_stack</span>
                <p>Halaman Profil belum diisi di CMS.</p>
              </div>
            )}
          </div>
        </div>
      </main>

      <Footer settings={siteSettings} navigation={navigation} />
    </>
  );
}
