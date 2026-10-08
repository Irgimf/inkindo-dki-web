import Header from '@/components/Header';
import SideNavigation from '@/components/SideNavigation';
import Hero from '@/components/Hero';
import News from '@/components/News';
import Footer from '@/components/Footer';

export default function Home() {
  return (
    <>
      <Header />
      <SideNavigation />
      <main>
        <Hero />
        <News />
      </main>
      <Footer />
    </>
  );
}
