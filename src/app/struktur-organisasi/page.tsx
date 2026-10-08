import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Footer from '@/components/Footer';
import { getPayload } from 'payload';
import config from '@/payload.config';
import { connection } from 'next/server';

export const dynamic = 'force-dynamic';

export async function generateMetadata() {
  return {
    title: 'Struktur Organisasi - INKINDO DKI Jakarta',
    description: 'Struktur kepengurusan Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta.',
  };
}

// Client Component to handle Tabs (we will create this next)
import StrukturTabs from './StrukturTabs';

export default async function StrukturOrganisasi() {
  await connection();
  const payload = await getPayload({ config });
  
  // Fetch units and members
  const unitsRes = await payload.find({
    collection: 'org_units',
    sort: 'order',
    depth: 2, // populate members and their photos
    limit: 100,
  });

  const units = unitsRes.docs;

  // Fetch globals for layout shell
  const siteSettings = await payload.findGlobal({ slug: 'site-settings' });
  const externalLinks = await payload.findGlobal({ slug: 'external-links' });
  const navigation = await payload.findGlobal({ slug: 'navigation' });

  return (
    <>
      <Header settings={siteSettings} />
      <SideNavigation links={externalLinks} />
      
      <main className="page-main pt-24 pb-20 bg-slate-50 min-h-screen">
        <div className="container mx-auto px-4 max-w-6xl">
          <header className="mb-12 text-center">
            <h1 className="text-4xl md:text-5xl font-bold text-slate-900 mb-4">Struktur Organisasi</h1>
            <p className="text-lg text-slate-600 max-w-2xl mx-auto mb-6">Mengenal lebih dekat jajaran pengurus Dewan Pengurus Provinsi (DPP) INKINDO DKI Jakarta.</p>
            <div className="w-24 h-1 bg-royal mx-auto rounded-full"></div>
          </header>

          <StrukturTabs units={units} />

        </div>
      </main>

      <Footer settings={siteSettings} navigation={navigation} />
    </>
  );
}
