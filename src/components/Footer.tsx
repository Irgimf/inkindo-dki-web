/* eslint-disable @typescript-eslint/no-explicit-any */
import Link from 'next/link';

export default function Footer({ settings, navigation }: { settings?: any, navigation?: any }) {
  const address = settings?.address || 'Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760, DKI Jakarta';
  const phone = settings?.contactPhone || '(021) 797-1582 / 797-1583';
  const email = settings?.contactEmail || 'dpp_dki@inkindo.org';
  const hours = settings?.operatingHours || 'Senin - Jumat: 08.30 - 17.00 WIB';

  return (
    <footer className="site-footer" id="kontak">
      <div className="site-footer__container">
        <div className="site-footer__grid">
          {/* Col 1: Identity & Bio */}
          <div className="site-footer__brand">
            <div className="site-footer__logo">
              <img alt="Logo INKINDO DKI Jakarta" src={settings?.logo?.url || "/assets/logo-inkindo.png"} />
            </div>
            <p className="site-footer__bio">
              Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta merupakan wadah asosiasi perusahaan jasa konsultansi independen yang profesional dan berintegritas.
            </p>
            <div className="site-footer__social">
              {settings?.socialLinks && settings.socialLinks.length > 0 ? (
                settings.socialLinks.map((s: any, idx: number) => (
                  <Link key={idx} href={s.url || '#'} aria-label={s.platform} target="_blank" rel="noopener noreferrer">
                    <span className="material-symbols-outlined">
                      {s.platform?.toLowerCase()?.includes('instagram') ? 'photo_camera' : 
                       s.platform?.toLowerCase()?.includes('facebook') ? 'public' : 'link'}
                    </span>
                  </Link>
                ))
              ) : (
                <>
                  <Link href="#" aria-label="Website"><span className="material-symbols-outlined">public</span></Link>
                  <Link href={`mailto:${email}`} aria-label="Email"><span className="material-symbols-outlined">mail</span></Link>
                  <Link href={`tel:${phone.split('/')[0].trim()}`} aria-label="Telepon"><span className="material-symbols-outlined">call</span></Link>
                </>
              )}
            </div>
          </div>
          {/* Col 2: Navigation Links */}
          <div className="site-footer__col site-footer__col--nav">
            <h4>Akses Cepat</h4>
            <ul>
              {navigation?.footerLinks && navigation.footerLinks.length > 0 ? (
                navigation.footerLinks.map((link: any, idx: number) => (
                  <li key={idx}><Link href={link.url || '#'}>{link.label}</Link></li>
                ))
              ) : (
                <>
                  <li><Link href="#">Sistem Informasi Anggota (SIA)</Link></li>
                  <li><Link href="https://www.inkindo-dki.org/register" target="_blank" rel="noopener noreferrer">Pendaftaran &amp; SBU Online</Link></li>
                  <li><Link href="#">Standar Billing Rate Remunerasi</Link></li>
                  <li><Link href="#">Direktori Anggota Terverifikasi</Link></li>
                </>
              )}
            </ul>
          </div>
          {/* Col 3: Contact Snippet */}
          <div className="site-footer__col site-footer__col--contact">
            <h4>Sekretariat DPP</h4>
            <p>{address}</p>
            <div className="site-footer__contact">
              <span>Telepon: {phone}</span>
              <span>Email: {email}</span>
              <span className="site-footer__hours">{hours}</span>
            </div>
          </div>
        </div>
        {/* Copyright & Bottom Policy */}
        <div className="site-footer__bottom">
          <p>© {new Date().getFullYear()} DPP INKINDO DKI Jakarta. Hak Cipta Dilindungi.</p>
          <div className="site-footer__policy">
            {navigation?.footerPolicy && navigation.footerPolicy.length > 0 ? (
              navigation.footerPolicy.map((link: any, idx: number) => (
                <Link key={idx} href={link.url || '#'}>{link.label}</Link>
              ))
            ) : (
              <>
                <Link href="#">Kebijakan Privasi</Link>
                <Link href="#">Syarat Layanan</Link>
                <Link href="#">LPJK PUPR</Link>
              </>
            )}
          </div>
        </div>
      </div>
    </footer>
  );
}
