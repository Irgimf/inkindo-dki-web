/* eslint-disable @typescript-eslint/no-explicit-any */
import Link from 'next/link';

export default function News({ posts }: { posts?: any[] }) {
  const highlight = posts && posts.length > 0 ? posts[0] : null;
  const sidePosts = posts && posts.length > 1 ? posts.slice(1, 3) : [];

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
          {/* Highlight Card */}
          <article className="bento__feature reveal is-visible" id="bento-highlight">
            <div className="bento__media">
              <img src={highlight?.cover?.url || "/assets/gambar.png"} alt={highlight?.title || "Berita Utama"} />
            </div>
            <div className="bento__body">
              <div className="bento__meta">
                {highlight?.publishedDate ? new Date(highlight.publishedDate).toLocaleDateString('id-ID') : '04 Sep 2026'} | Berita
              </div>
              <h3 className="bento__heading">{highlight?.title || "INKINDO DKI Goes to Campus: Gandeng UTA '45 Bangun Kemitraan Strategis"}</h3>
            </div>
          </article>

          {/* Side Cards */}
          <div className="bento__side">
            {sidePosts.length > 0 ? sidePosts.map((post, idx) => (
              <article key={idx} className="bento__card bento__card--horizontal reveal is-visible">
                <div className="bento__media-side">
                  <img src={post?.cover?.url || "/assets/gambar2.jpg"} alt={post.title} />
                </div>
                <div className="bento__body-side">
                  <div className="bento__meta">
                    {post.publishedDate ? new Date(post.publishedDate).toLocaleDateString('id-ID') : '28 Nov 2025'} | Berita
                  </div>
                  <h3 className="bento__heading-side">{post.title}</h3>
                </div>
              </article>
            )) : (
              <>
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
              </>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
