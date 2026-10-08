import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="site-footer" id="kontak">
      <div className="site-footer__container">
        <div className="site-footer__grid">
          {/* Col 1: Identity & Bio */}
          <div className="site-footer__brand">
            <div className="site-footer__logo">
              <img alt="Logo INKINDO DKI Jakarta" src="/assets/logo-inkindo.png" />
            </div>
            <p className="site-footer__bio">
              Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta merupakan wadah asosiasi perusahaan jasa konsultansi independen yang profesional dan berintegritas.
            </p>
            <div className="site-footer__social">
              <Link href="#" aria-label="Website"><span className="material-symbols-outlined">public</span></Link>
              <Link href="#" aria-label="Email"><span className="material-symbols-outlined">mail</span></Link>
              <Link href="#" aria-label="Telepon"><span className="material-symbols-outlined">call</span></Link>
            </div>
          </div>
          {/* Col 2: Navigation Links */}
          <div className="site-footer__col site-footer__col--nav">
            <h4>Akses Cepat</h4>
            <ul>
              <li><Link href="#">Sistem Informasi Anggota (SIA)</Link></li>
              <li><Link href="https://www.inkindo-dki.org/register" target="_blank" rel="noopener noreferrer">Pendaftaran &amp; SBU Online</Link></li>
              <li><Link href="#">Standar Billing Rate Remunerasi</Link></li>
              <li><Link href="#">Direktori Anggota Terverifikasi</Link></li>
            </ul>
          </div>
          {/* Col 3: Contact Snippet */}
          <div className="site-footer__col site-footer__col--contact">
            <h4>Sekretariat DPP</h4>
            <p>Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760, DKI Jakarta</p>
            <div className="site-footer__contact">
              <span>Telepon: (021) 797-1582 / 797-1583</span>
              <span>Email: dpp_dki@inkindo.org</span>
              <span className="site-footer__hours">Senin - Jumat: 08.30 - 17.00 WIB</span>
            </div>
          </div>
        </div>
        {/* Copyright & Bottom Policy */}
        <div className="site-footer__bottom">
          <p>© 2026 DPP INKINDO DKI Jakarta. Hak Cipta Dilindungi.</p>
          <div className="site-footer__policy">
            <Link href="#">Kebijakan Privasi</Link>
            <Link href="#">Syarat Layanan</Link>
            <Link href="#">LPJK PUPR</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
