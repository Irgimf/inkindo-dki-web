import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Hero from '@/components/Hero';
import News from '@/components/News';
import Footer from '@/components/Footer';
import { getPayload } from 'payload';
import config from '@/payload.config';
import { connection } from 'next/server';

export async function generateMetadata() {
  await connection();
  const payload = await getPayload({ config });
  const homepage = await payload.findGlobal({ slug: 'homepage' });
  const meta = homepage?.meta || {};
  return {
    title: meta.title || 'INKINDO DKI Jakarta',
    description: meta.description || 'Ekosistem Konsultansi Digital Jakarta',
  };
}

export default async function Home() {
  await connection();
  const payload = await getPayload({ config });

  // Fetch Globals
  const homepage = await payload.findGlobal({ slug: 'homepage' });
  const siteSettings = await payload.findGlobal({ slug: 'site-settings' });
  const externalLinks = await payload.findGlobal({ slug: 'external-links' });
  const navigation = await payload.findGlobal({ slug: 'navigation' });

  // Fetch Collections
  const banners = await payload.find({
    collection: 'banners',
    where: { isActive: { equals: true } },
    sort: 'order',
  });

  const partners = await payload.find({
    collection: 'partners',
    where: { showOnHome: { equals: true } },
    sort: 'order',
  });

  const featuredPosts = await payload.find({
    collection: 'posts',
    where: { featured: { equals: true } },
    limit: 3,
    sort: '-publishedDate',
  });

  return (
    <>
      <Header settings={siteSettings} />
      <SideNavigation links={externalLinks} />
      <main>
        <Hero 
          banners={banners.docs} 
          homepage={homepage} 
          partners={partners.docs} 
        />
        <News 
          posts={featuredPosts.docs} 
        />
      </main>
      <Footer 
        settings={siteSettings} 
        navigation={navigation} 
      />
    </>
  );
}
