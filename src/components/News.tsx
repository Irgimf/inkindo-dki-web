import Link from 'next/link';

export default function News() {
  return (
    <section className="news" id="berita">
      <div className="news__container">
        <div className="news__head">
          <div className="news__tabs">
            <button type="button" className="news__tab is-active">Berita &amp; Informasi</button>
          </div>
          <Link href="#" className="news__all" id="news-all">
            Lihat Selengkapnya <span className="material-symbols-outlined">chevron_right</span>
          </Link>
        </div>

        <div className="bento">
          <article className="bento__feature reveal is-visible" id="bento-highlight">
            <div className="bento__media">
              <img src="/assets/gambar.png" alt="INKINDO DKI Goes to Campus: Gandeng UTA '45 Bangun Kemitraan Strategis" />
            </div>
            <div className="bento__body">
              <div className="bento__meta">
                04 Sep 2026 | Kolaborasi Akademik
              </div>
              <h3 className="bento__heading">INKINDO DKI Goes to Campus: Gandeng UTA &apos;45 Bangun Kemitraan Strategis</h3>
            </div>
          </article>

          <div className="bento__side">
            <article className="bento__card bento__card--horizontal reveal is-visible">
              <div className="bento__media-side">
                <img src="/assets/gambar2.jpg" alt="Agenda" />
              </div>
              <div className="bento__body-side">
                <div className="bento__meta">
                  28 Nov 2025 | Agenda Mendatang
                </div>
                <h3 className="bento__heading-side">Pelatihan Audit Internal ISO 37001:2016 (SMAP)</h3>
              </div>
            </article>

            <article className="bento__card bento__card--horizontal reveal is-visible">
              <div className="bento__media-side">
                <img src="/assets/gambar1.jpg" alt="e-Magazine" />
              </div>
              <div className="bento__body-side">
                <div className="bento__meta">
                  01 Sep 2026 | e-Magazine Edisi 79
                </div>
                <h3 className="bento__heading-side">Majalah INKINDO DKI Jakarta</h3>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>
  );
}
