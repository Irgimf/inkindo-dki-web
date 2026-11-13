<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="DPP INKINDO DKI Jakarta menaungi 900+ badan usaha konsultan profesional dengan standar integritas, kepatuhan SMAP, dan layanan anggota digital terintegrasi.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
</head>

<body>

    <!-- ================= HEADER ================= -->
    <header class="main-header" id="main-header">
        <div class="container main-header__inner">
            <a href="index.html" class="main-header__logo" id="logo-link" aria-label="Beranda DPP INKINDO DKI Jakarta">
                <img src="assets/logo-inkindo.png" alt="Logo DPP INKINDO DKI Jakarta">
            </a>

            <nav class="main-nav" id="main-nav" aria-label="Navigasi utama">
                <ul class="main-nav__menu">
                    <li><a href="index.html" class="main-nav__link is-active" id="nav-home">Home</a></li>
                    <li>
                        <a href="tentang.html" class="main-nav__link" id="nav-tentang">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="regulasi.html" class="main-nav__link" id="nav-regulasi">Regulasi</a>
                    </li>
                    <li><a href="berita.html" class="main-nav__link" id="nav-berita">Berita &amp; Informasi</a></li>
                    <li class="main-nav__icon-item">
                        <button type="button" class="main-nav__icon" id="header-search-toggle" aria-label="Cari">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </li>
                    <li>
                        <div class="lang-switch" id="lang-switch">
                            <button type="button" class="lang-switch__btn is-active" data-lang="id">ID</button>
                            <button type="button" class="lang-switch__btn" data-lang="en">EN</button>
                        </div>
                    </li>
                </ul>
            </nav>

            <button type="button" class="mobile-toggle" id="mobile-toggle" aria-label="Buka menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>

        <!-- Header search bar -->
        <div class="header-search" id="header-search">
            <form class="container header-search__form" id="header-search-form">
                <input type="text" id="header-search-input" class="header-search__input" placeholder="Cari di sini?"
                    autocomplete="off">
                <button type="submit" class="header-search__btn" aria-label="Cari">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>
    </header>

    <!-- ================= SIDE NAV KIRI ================= -->
    <aside class="side-nav" id="side-nav" aria-label="Menu layanan">
        <div class="side-nav__list">
            <button type="button" class="side-nav__link" data-panel="login" id="side-login">
                <span class="material-symbols-outlined side-nav__icon">login</span>
                <span class="side-nav__label">Login</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="lelang" id="side-lelang">
                <span class="material-symbols-outlined side-nav__icon">gavel</span>
                <span class="side-nav__label">Info Lelang</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="anggota" id="side-anggota">
                <span class="material-symbols-outlined side-nav__icon">groups</span>
                <span class="side-nav__label">Anggota</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="mitra" id="side-mitra">
                <span class="material-symbols-outlined side-nav__icon">handshake</span>
                <span class="side-nav__label">Mitra Kerja</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="klinik" id="side-klinik">
                <span class="material-symbols-outlined side-nav__icon">medical_information</span>
                <span class="side-nav__label">Klinik Konsultasi</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="kontak" id="side-kontak">
                <span class="material-symbols-outlined side-nav__icon">call</span>
                <span class="side-nav__label">Hubungi Kami</span>
            </button>
            <button type="button" class="side-nav__link" data-panel="chat" id="side-chat">
                <span class="material-symbols-outlined side-nav__icon">forum</span>
                <span class="side-nav__label">Chat</span>
            </button>
        </div>
    </aside>

    <!-- Panel geser dari kanan -->
    <div class="side-panel" id="side-panel" aria-hidden="true">
        <div class="side-panel__top">
            <button type="button" class="side-panel__close" id="side-panel-close" aria-label="Tutup panel">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Login -->
        <div class="side-panel__content" data-content="login">
            <h3 class="side-panel__title">Login</h3>
            <ul class="panel-links">
                <li><a href="{{ rtrim(config('app.sim_url', 'http://localhost:8080'), '/') }}/auth/login" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">groups</span>
                        <span><strong>Anggota INKINDO</strong><small>Akses portal untuk anggota terdaftar</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="{{ rtrim(config('app.sim_url', 'http://localhost:8080'), '/') }}/mitra/login" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">handshake</span>
                        <span><strong>Mitra Kerja</strong><small>Portal kolaborasi dan kemitraan</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
        </div>

        <!-- Info Lelang -->
        <div class="side-panel__content" data-content="lelang">
            <h3 class="side-panel__title">Info Lelang</h3>
            <p class="side-panel__desc">Pantau paket pengadaan jasa konsultansi pemerintah melalui kanal resmi
                berikut.</p>
            <ul class="panel-links">
                <li><a href="https://lpse.lkpp.go.id/eproc4/lelang" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">shopping_cart_checkout</span>
                        <span><strong>LKPP</strong><small>Lembaga Kebijakan Pengadaan Barang/Jasa
                                Pemerintah</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="lelang-lainnya.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">campaign</span>
                        <span><strong>Info Lelang Lainnya</strong><small>Informasi paket pengadaan
                                alternatif</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
        </div>

        <!-- Anggota -->
        <div class="side-panel__content" data-content="anggota">
            <h3 class="side-panel__title">Anggota</h3>
            <ul class="panel-links">
                <li><a href="{{ rtrim(config('app.sim_url', 'http://localhost:8080'), '/') }}/auth/register" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">person_add</span>
                        <span><strong>Pendaftaran Anggota</strong><small>Registrasi baru keanggotaan
                                INKINDO</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="{{ rtrim(config('app.sim_url', 'http://localhost:8080'), '/') }}/auth/login" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">autorenew</span>
                        <span><strong>Perpanjangan Anggota</strong><small>Herregistrasi keanggotaan
                                tahunan</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="anggota-terdaftar.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">fact_check</span>
                        <span><strong>Anggota Terdaftar</strong><small>Direktori badan usaha
                                terverifikasi</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
        </div>

        <!-- Mitra Kerja -->
        <div class="side-panel__content" data-content="mitra">
            <h3 class="side-panel__title">Mitra Kerja</h3>
            <ul class="panel-links">
                <li><a href="ketentuan-mitra-kerja.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">rule</span>
                        <span><strong>Ketentuan Mitra Kerja</strong><small>Syarat dan panduan kemitraan</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="javascript:void(0)" class="panel-link" onclick="openDaftarMitraModal(event)">
                        <span class="material-symbols-outlined panel-link__icon">how_to_reg</span>
                        <span><strong>Daftar Mitra Kerja</strong><small>Formulir registrasi kemitraan
                                baru</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
            <h4
                style="margin-top: 24px; font-size: 14px; font-weight: 700; color: var(--slate-900); display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--royal); font-size: 20px;">verified</span>
                Mitra Kerja Terdaftar
            </h4>
            <div class="partner-grid" style="margin-top: 12px; grid-template-columns: repeat(3, 1fr);">
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/avian.jpg" alt="Avian"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/lesso.jpg" alt="Lesso"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/seven.jpg" alt="Seven"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/dekkson.jpg" alt="Dekkson"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/alila.jpg" alt="Alila"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/propan.jpg" alt="Propan"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
            </div>
        </div>

        <!-- Klinik Konsultasi -->
        <div class="side-panel__content" data-content="klinik">
            <h3 class="side-panel__title">Klinik Konsultasi</h3>
            <p class="side-panel__desc">Pendampingan gratis bagi anggota terkait regulasi, sertifikasi, dan
                pengadaan jasa konsultansi.</p>
            <div class="topic-list">
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Advokasi & Mediasi')">Advokasi &amp;
                    Mediasi</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Regulasi')">Regulasi</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Perpajakan')">Perpajakan</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Pelayanan')">Pelayanan (KTA, SBU,
                    OSS, dll)</span>
            </div>
            <div class="panel-info">
                <span class="material-symbols-outlined">schedule</span>
                <span>Sesi tatap muka &amp; daring<br><small>Senin - Jumat: 08.00 - 16.30 WIB</small></span>
            </div>
            <button type="button" class="btn btn--primary btn--block" id="klinik-cta"
                onclick="openKlinikKonsultasiModal(event)">Ajukan Konsultasi</button>
        </div>

@include('partials.side_contact')

        <!-- Chat -->
        <div class="side-panel__content side-panel__content--chat" data-content="chat">
            <div class="chat-head">
                <div class="chat-head__avatar"><span class="material-symbols-outlined">smart_toy</span></div>
                <div>
                    <h3 class="side-panel__title side-panel__title--chat">Asisten INKINDO</h3>
                    <span class="chat-head__status">Online</span>
                </div>
            </div>
            <div class="chat-body" id="chat-body"></div>
            <div class="chat-quick" id="chat-quick">
                <button type="button" class="chat-quick__btn">Cara daftar anggota</button>
                <button type="button" class="chat-quick__btn">Jam operasional</button>
            </div>
            <form class="chat-form" id="chat-form">
                <input type="text" id="chat-input" class="chat-form__input" placeholder="Ketik pesan..."
                    autocomplete="off">
                <button type="submit" class="chat-form__btn" aria-label="Kirim">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>
    </div>
    <div class="overlay" id="overlay"></div>

    <main>
        <!-- ================= HERO ================= -->
        <section class="hero" id="hero">
            <div class="hero__bg hero__bg--a" id="hero-bg-a"></div>
            <div class="hero__bg hero__bg--b" id="hero-bg-b"></div>
            <script>
                (function () {
                    var jakartaImages = [
                        'assets/jakartahome1.jpg',
                        'assets/jakartahome3.jpg'
                    ];
                    window.__JAKARTA_HERO_IMAGES = jakartaImages;
                    var initIdx = Math.floor(Math.random() * jakartaImages.length);
                    window.__currentJakartaBgIndex = initIdx;
                    var elA = document.getElementById('hero-bg-a');
                    if (elA) {
                        elA.style.backgroundImage = "url('" + jakartaImages[initIdx] + "')";
                    }
                })();
            </script>
            <div class="hero__shade"></div>

            <div class="container hero__container">
                <div class="hero__content">
                    <h1 class="sr-only">DPP INKINDO DKI Jakarta – Ekosistem Konsultansi Digital Jakarta</h1>

                    <!-- Teks animasi selamat datang dengan garis dan tombol sesuai referensi gambar -->
                    <div class="hero-search hero-search--display" id="hero-search" role="region"
                        aria-label="Sambutan Interaktif">
                        <div class="hero-search__display">
                            <span class="hero-search__text" id="hero-type-text">Selamat Datang</span>
                            <span class="hero-type__cursor" aria-hidden="true">|</span>
                        </div>
                    </div>

                    <!-- Carousel banner -->
                    <div class="carousel" id="hero-carousel">
                        <div class="carousel__track">
                            <div class="carousel__slide is-active">
                                <img src="assets/hero-bg.jpg" alt="Dewan Pengurus Provinsi INKINDO DKI Jakarta">
                                <div class="carousel__caption">
                                    <span class="carousel__intro">DPP Masa Bakti 2026–2030</span>
                                    <a href="#tentang" class="carousel__title">Dewan Pengurus Provinsi INKINDO DKI
                                        Jakarta</a>
                                </div>
                            </div>
                            <div class="carousel__slide">
                                <img src="assets/gambar.png" alt="INKINDO DKI Goes to Campus">
                                <div class="carousel__caption">
                                    <span class="carousel__intro">Kemitraan Kampus</span>
                                    <a href="#berita" class="carousel__title">INKINDO DKI Goes to Campus</a>
                                </div>
                            </div>
                            <div class="carousel__slide carousel__slide--graphic">
                                <img src="assets/gambar2.jpg" alt="Agenda Mendatang">
                                <span class="material-symbols-outlined carousel__graphic">verified_user</span>
                                <div class="carousel__caption">
                                    <span class="carousel__intro">Agenda Mendatang</span>
                                    <a href="#berita" class="carousel__title">Pelatihan Audit Internal ISO 37001</a>
                                </div>
                            </div>
                            <div class="carousel__slide carousel__slide--graphic carousel__slide--dark">
                                <img src="assets/gambar1.jpg" alt="Majalah INKINDO DKI Jakarta">
                                <span class="material-symbols-outlined carousel__graphic">auto_stories</span>
                                <div class="carousel__caption">
                                    <span class="carousel__intro">e-Magazine Edisi 79</span>
                                    <a href="#berita" class="carousel__title">Majalah INKINDO DKI Jakarta</a>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="carousel__nav carousel__nav--prev" id="carousel-prev"
                            aria-label="Sebelumnya">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button type="button" class="carousel__nav carousel__nav--next" id="carousel-next"
                            aria-label="Berikutnya">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                        <div class="carousel__dots" id="carousel-dots"></div>
                    </div>

                    <!-- Akses cepat  -->
                    <div class="hero-bottom-bar">
                        <div class="mitra-kerja">
                            <div class="mitra-kerja__head">
                                <h2 class="mitra-kerja__title">Didukung Oleh:</h2>
                                <a href="ketentuan-mitra-kerja.html"
                                    style="font-size: 14px; font-weight: 600; color: rgba(255, 255, 255, 0.9); text-shadow: 0 1px 3px rgba(0,0,0,0.5); display: inline-flex; align-items: center; gap: 4px;">Info
                                    Lengkap <span class="material-symbols-outlined"
                                        style="font-size: 18px;">chevron_right</span></a>
                            </div>
                            <div class="mitra-kerja__marquee-wrapper">
                                <div class="mitra-kerja__marquee">
                                    <!-- Track 1 -->
                                    <div class="mitra-kerja__track">
                                        <div class="mitra-card"><img src="mitra_logos/avian.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/lesso.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/seven.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/dekkson.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/alila.jpg" alt=""></div>
                                    </div>
                                    <!-- Track 2 (Duplicate for infinite loop) -->
                                    <div class="mitra-kerja__track">
                                        <div class="mitra-card"><img src="mitra_logos/kulitbatu.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/lesso.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/kjpp.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/amtyas.jpg" alt=""></div>
                                        <div class="mitra-card"><img src="mitra_logos/dc.jpg" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="scroll-hint">
                            <span class="material-symbols-outlined scroll-hint__icon">keyboard_double_arrow_down</span>
                            <p>Scroll untuk melihat lebih</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget strip -->
            <div class="widget-strip">
                <div class="container widget-strip__inner">
                    <a href="tentang.html" class="widget-strip__label">Tentang INKINDO DKI</a>
                    <div class="ticker" id="stats-ticker">
                        <button type="button" class="ticker__nav" id="ticker-prev" aria-label="Sebelumnya">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <div class="ticker__viewport">
                            <div class="ticker__item is-active"><strong>900+</strong> Konsultan Aktif <em>Badan usaha
                                    terdaftar</em></div>
                            <div class="ticker__item"><strong>#1</strong> Provinsi Terbesar <em>Dari 33 DPP</em></div>
                            <div class="ticker__item"><strong>Hybrid</strong> Layanan Terpadu <em>Online &amp; tatap
                                    muka</em></div>
                            <div class="ticker__item"><strong>ISO 37001</strong> Standar SMAP <em>Anti
                                    penyuapan</em></div>
                        </div>
                        <button type="button" class="ticker__nav" id="ticker-next" aria-label="Berikutnya">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                    <p class="widget-strip__note">Data keanggotaan diperbarui berkala.</p>
                </div>
            </div>
        </section>

        <!-- ================= BERITA & INFORMASI  ================= -->
        <section class="news" id="berita">
            <div class="news__container">
                <div class="news__head">
                    <div class="news__tabs">
                        <button type="button" class="news__tab is-active">Berita &amp; Informasi</button>
                    </div>
                    <a href="berita.html" class="news__all" id="news-all">
                        Lihat Selengkapnya <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                </div>

                <div class="bento" id="homepage-bento-grid">
                    <!-- Card 1: Highlight (Slot 1) -->
                    <a href="berita.html" class="bento__feature reveal" id="bento-slot-1" style="text-decoration: none; color: inherit; cursor: pointer; display: flex; flex-direction: column;">
                        <div class="bento__media">
                            <img id="bento-slot-1-img" src="assets/gambar.png"
                                alt="Berita Utama INKINDO DKI Jakarta">
                        </div>
                        <div class="bento__body">
                            <div class="bento__meta" id="bento-slot-1-meta">
                                Memuat...
                            </div>
                            <h3 class="bento__heading" id="bento-slot-1-title">Memuat Berita Utama...</h3>
                        </div>
                    </a>

                    <div class="bento__side">
                        <!-- Card 2: Kanan Atas (Slot 2) -->
                        <a href="berita.html" class="bento__card bento__card--horizontal reveal" id="bento-slot-2" style="text-decoration: none; color: inherit; cursor: pointer;">
                            <div class="bento__media-side">
                                <img id="bento-slot-2-img" src="assets/gambar2.jpg" alt="Informasi">
                            </div>
                            <div class="bento__body-side">
                                <div class="bento__meta" id="bento-slot-2-meta">
                                    Memuat...
                                </div>
                                <h3 class="bento__heading-side" id="bento-slot-2-title">Memuat Informasi...</h3>
                            </div>
                        </a>

                        <!-- Card 3: Kanan Bawah (Slot 3) -->
                        <a href="berita.html" class="bento__card bento__card--horizontal reveal" id="bento-slot-3" style="text-decoration: none; color: inherit; cursor: pointer;">
                            <div class="bento__media-side">
                                <img id="bento-slot-3-img" src="assets/gambar1.jpg" alt="Informasi">
                            </div>
                            <div class="bento__body-side">
                                <div class="bento__meta" id="bento-slot-3-meta">
                                    Memuat...
                                </div>
                                <h3 class="bento__heading-side" id="bento-slot-3-title">Memuat Informasi...</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <script>
                    (function () {
                        function applySlot(slotNum, item) {
                            var card = document.getElementById('bento-slot-' + slotNum);
                            var img = document.getElementById('bento-slot-' + slotNum + '-img');
                            var meta = document.getElementById('bento-slot-' + slotNum + '-meta');
                            var title = document.getElementById('bento-slot-' + slotNum + '-title');
                            if (!card) return;
                            if (!item) {
                                card.style.display = 'none';
                                return;
                            }
                            card.style.display = slotNum === 1 ? 'flex' : '';
                            card.setAttribute('href', item.target_url || 'berita.html');
                            if (img) {
                                img.src = item.gambar || 'assets/gambar.png';
                                img.alt = item.judul || '';
                            }
                            if (meta) {
                                var parts = [item.tanggal_label, item.kategori_label || item.badge].filter(Boolean);
                                meta.textContent = parts.join(' | ');
                            }
                            if (title) {
                                title.textContent = item.judul || '';
                            }
                        }

                        function applyHeroBanners(banners) {
                            if (!Array.isArray(banners) || banners.length === 0) return;
                            var oldCarousel = document.getElementById('hero-carousel');
                            if (!oldCarousel || !oldCarousel.parentNode) return;

                            var carousel = oldCarousel.cloneNode(true);
                            oldCarousel.parentNode.replaceChild(carousel, oldCarousel);

                            var track = carousel.querySelector('.carousel__track');
                            var dotsWrap = carousel.querySelector('#carousel-dots');
                            var prevBtn = carousel.querySelector('#carousel-prev');
                            var nextBtn = carousel.querySelector('#carousel-next');
                            if (!track || !dotsWrap) return;

                            track.innerHTML = '';
                            dotsWrap.innerHTML = '';

                            banners.forEach(function (b, idx) {
                                var slide = document.createElement('div');
                                slide.className = 'carousel__slide' + (idx === 0 ? ' is-active' : '');

                                var img = document.createElement('img');
                                img.src = b.gambar || 'assets/hero-bg.jpg';
                                img.alt = b.judul || 'Banner INKINDO DKI Jakarta';
                                slide.appendChild(img);

                                var caption = document.createElement('div');
                                caption.className = 'carousel__caption';

                                if (b.subjudul) {
                                    var intro = document.createElement('span');
                                    intro.className = 'carousel__intro';
                                    intro.textContent = b.subjudul;
                                    caption.appendChild(intro);
                                }

                                var titleLink = document.createElement('a');
                                titleLink.href = b.target_url || '#berita';
                                titleLink.className = 'carousel__title';
                                titleLink.textContent = b.judul || '';
                                caption.appendChild(titleLink);

                                slide.appendChild(caption);
                                track.appendChild(slide);

                                var dot = document.createElement('button');
                                dot.type = 'button';
                                dot.className = 'carousel__dot' + (idx === 0 ? ' is-active' : '');
                                dot.setAttribute('aria-label', 'Slide ' + (idx + 1));
                                dot.addEventListener('click', function () {
                                    goToSlide(idx, true);
                                });
                                dotsWrap.appendChild(dot);
                            });

                            var slidesCount = banners.length;
                            var dots = Array.from(dotsWrap.querySelectorAll('.carousel__dot'));
                            var slideIndex = 0;
                            var autoTimer = null;

                            function goToSlide(i, user) {
                                slideIndex = (i + slidesCount) % slidesCount;
                                track.style.transform = 'translateX(-' + (slideIndex * 100) + '%)';
                                dots.forEach(function (d, n) {
                                    d.classList.toggle('is-active', n === slideIndex);
                                });
                                if (user) restartTimer();
                            }

                            function restartTimer() {
                                if (autoTimer) clearInterval(autoTimer);
                                if (slidesCount > 1) {
                                    autoTimer = setInterval(function () {
                                        goToSlide(slideIndex + 1, false);
                                    }, 5000);
                                }
                            }

                            if (prevBtn) {
                                prevBtn.addEventListener('click', function () {
                                    goToSlide(slideIndex - 1, true);
                                });
                            }
                            if (nextBtn) {
                                nextBtn.addEventListener('click', function () {
                                    goToSlide(slideIndex + 1, true);
                                });
                            }

                            carousel.addEventListener('mouseenter', function () {
                                if (autoTimer) clearInterval(autoTimer);
                            });
                            carousel.addEventListener('mouseleave', restartTimer);

                            var touchX = null;
                            carousel.addEventListener('touchstart', function (e) {
                                touchX = e.touches[0].clientX;
                            }, { passive: true });
                            carousel.addEventListener('touchend', function (e) {
                                if (touchX === null) return;
                                var dx = e.changedTouches[0].clientX - touchX;
                                if (Math.abs(dx) > 40) {
                                    goToSlide(slideIndex + (dx < 0 ? 1 : -1), true);
                                }
                                touchX = null;
                            });

                            restartTimer();
                        }

                        function applyHeroPhrases(phrases) {
                            if (!Array.isArray(phrases) || phrases.length === 0) return;
                            if (typeof window.__setHeroPhrases === 'function') {
                                window.__setHeroPhrases(phrases);
                            }
                        }

                        function applyHeroBackgrounds(backgrounds) {
                            if (!Array.isArray(backgrounds) || backgrounds.length === 0) return;
                            var oldBgA = document.getElementById('hero-bg-a');
                            var oldBgB = document.getElementById('hero-bg-b');
                            if (!oldBgA || !oldBgB || !oldBgA.parentNode) return;

                            var heroBgA = oldBgA.cloneNode(true);
                            var heroBgB = oldBgB.cloneNode(true);
                            oldBgA.parentNode.replaceChild(heroBgA, oldBgA);
                            oldBgB.parentNode.replaceChild(heroBgB, oldBgB);

                            window.__JAKARTA_HERO_IMAGES = backgrounds;
                            var currentIndex = 0;
                            if (backgrounds.length > 1 && typeof window.__currentJakartaBgIndex === 'number' && window.__currentJakartaBgIndex < backgrounds.length) {
                                currentIndex = window.__currentJakartaBgIndex;
                            }

                            heroBgA.style.backgroundImage = "url('" + backgrounds[currentIndex] + "')";
                            heroBgA.style.opacity = '1';
                            heroBgB.style.opacity = '0';

                            var activeLayer = 'a';
                            function rotateBg() {
                                if (backgrounds.length <= 1) return;
                                var nextIndex = Math.floor(Math.random() * (backgrounds.length - 1));
                                if (nextIndex >= currentIndex) nextIndex++;
                                currentIndex = nextIndex;
                                var nextSrc = backgrounds[currentIndex];

                                var imgLoader = new Image();
                                imgLoader.onload = function () {
                                    if (activeLayer === 'a') {
                                        heroBgB.style.backgroundImage = "url('" + nextSrc + "')";
                                        heroBgB.style.opacity = '1';
                                        heroBgA.style.opacity = '0';
                                        activeLayer = 'b';
                                    } else {
                                        heroBgA.style.backgroundImage = "url('" + nextSrc + "')";
                                        heroBgA.style.opacity = '1';
                                        heroBgB.style.opacity = '0';
                                        activeLayer = 'a';
                                    }
                                };
                                imgLoader.src = nextSrc;
                            }

            if ( backgrounds.length > 1) {
                                setInterval(rotateBg, 5 * 60 * 1000);
                            }
                            window.changeJakartaHeroBg = rotateBg;
                        }

                        function applyPublikasiGrid(pubList) {
                            var grid = document.getElementById('homepage-publikasi-grid');
                            if (!grid) return;
                            if (!Array.isArray(pubList) || pubList.length === 0) {
                                grid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center; color: #6b7280; padding: 24px 0;">Belum ada data publikasi.</p>';
                                return;
                            }

                            grid.innerHTML = '';
                            pubList.slice(0, 8).forEach(function (item) {
                                var card = document.createElement('a');
                                card.className = 'pub-home-card reveal is-visible';
                                card.href = item.target_url || ('berita-detail.html?type=publikasi&id=' + encodeURIComponent(item.slug || ''));

                                var media = document.createElement('div');
                                media.className = 'pub-home-card__media';

                                var img = document.createElement('img');
                                img.src = item.gambar || 'assets/gambar.png';
                                img.alt = item.judul || 'Publikasi INKINDO DKI Jakarta';
                                img.loading = 'lazy';
                                media.appendChild(img);

                                var badgeText = item.badge || item.kategori_label || 'Publikasi';
                                if (badgeText) {
                                    var badge = document.createElement('span');
                                    badge.className = 'pub-home-card__badge';
                                    badge.textContent = badgeText;
                                    media.appendChild(badge);
                                }

                                var body = document.createElement('div');
                                body.className = 'pub-home-card__body';

                                var meta = document.createElement('div');
                                meta.className = 'pub-home-card__meta';
                                var metaParts = [item.tanggal_label, item.kategori_label || 'Publikasi'].filter(Boolean);
                                meta.textContent = metaParts.join(' | ');
                                body.appendChild(meta);

                                var title = document.createElement('h3');
                                title.className = 'pub-home-card__title';
                                title.textContent = item.judul || '';
                                title.title = item.judul || '';
                                body.appendChild(title);

                                card.appendChild(media);
                                card.appendChild(body);
                                grid.appendChild(card);
                            });
                        }

                        fetch('/api/cms/berita')
                            .then(function (r) { return r.json(); })
                            .then(function (data) {
                                var hp = (data && data.homepage) ? data.homepage : {};
                                var items = (data && data.items) ? data.items : [];
                                var s1 = hp.slot_1 || items[0] || null;
                                var s2 = hp.slot_2 || items[1] || null;
                                var s3 = hp.slot_3 || items[2] || null;
                                applySlot(1, s1);
                                applySlot(2, s2);
                                applySlot(3, s3);

                                var pubItems = (data && Array.isArray(data.homepage_publikasi) && data.homepage_publikasi.length > 0)
                                    ? data.homepage_publikasi
                                    : ((data && data.grouped && Array.isArray(data.grouped.publikasi)) ? data.grouped.publikasi.slice(0, 8) : []);
                                applyPublikasiGrid(pubItems);

                                if (data && Array.isArray(data.hero_banners) && data.hero_banners.length > 0) {
                                    applyHeroBanners(data.hero_banners);
                                }
                                if (data && Array.isArray(data.hero_phrases) && data.hero_phrases.length > 0) {
                                    applyHeroPhrases(data.hero_phrases);
                                }
                                if (data && Array.isArray(data.hero_backgrounds) && data.hero_backgrounds.length > 0) {
                                    applyHeroBackgrounds(data.hero_backgrounds);
                                }
                            })
                            .catch(function () {});
                    })();
                </script>
            </div>
        </section>

        <!-- ================= PUBLIKASI (GRID 4x2) ================= -->
        <section class="news news--publikasi" id="publikasi-beranda">
            <div class="news__container">
                <div class="news__head">
                    <div class="news__tabs">
                        <button type="button" class="news__tab is-active">Publikasi</button>
                    </div>
                    <a href="berita.html?tab=publikasi" class="news__all" id="publikasi-all">
                        Lihat Selengkapnya <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                </div>

                <div class="pub-grid-4x2" id="homepage-publikasi-grid">
                    <!-- 8 Kartu Publikasi (4 ke samping x 2 ke bawah) dimuat otomatis dari CMS -->
                </div>
            </div>
        </section>
    </main>

    <!-- ================= FOOTER ================= -->
@include('partials.footer')

    <script src="js/script.js?v=cerah15"></script>
</body>

</html>