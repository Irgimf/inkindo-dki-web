<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <title id="page-title">Profil Mitra Kerja – DPP INKINDO DKI Jakarta</title>
    <meta name="description" content="Profil dan katalog produk Mitra Kerja resmi DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>
        .mitra-profile-hero {
            position: relative;
            padding: 130px 0 64px;
            background: linear-gradient(135deg, #081229 0%, #0B62A2 65%, #0ea5e9 100%);
            color: #ffffff;
            overflow: hidden;
        }

        .mitra-profile-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ \App\Support\PageBackgroundHelper::get('mitra_detail_hero', 'assets/jakarta7.jpg') }}') center/cover no-repeat;
            opacity: 0.16;
            pointer-events: none;
        }

        .mitra-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .mitra-breadcrumb a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .mitra-breadcrumb a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .mitra-hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 24px;
            padding: 36px;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 36px;
            align-items: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.22);
        }

        @media (max-width: 820px) {
            .mitra-hero-card {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 28px 22px;
            }
        }

        .mitra-logo-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            height: 170px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .mitra-logo-box img {
            max-height: 120px;
            max-width: 100%;
            width: auto;
            object-fit: contain;
        }

        .mitra-verified-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 0.4px;
            margin-bottom: 14px;
        }

        .mitra-company-title {
            font-size: clamp(26px, 3.6vw, 40px);
            font-weight: 800;
            margin: 0 0 10px;
            line-height: 1.2;
            color: #ffffff;
        }

        .mitra-category-subtitle {
            font-size: 16px;
            color: #bae6fd;
            font-weight: 600;
            margin: 0 0 22px;
        }

        .mitra-hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        @media (max-width: 820px) {
            .mitra-hero-actions {
                justify-content: center;
            }
        }

        .btn-hero-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-hero-action--white {
            background: #ffffff;
            color: #0B62A2;
        }

        .btn-hero-action--white:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        .btn-hero-action--glass {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-hero-action--glass:hover {
            background: rgba(255, 255, 255, 0.24);
            transform: translateY(-2px);
        }

        /* Main Content Grid */
        .mitra-body-section {
            padding: 64px 0 88px;
            background: #f8fafc;
        }

        .mitra-info-grid {
            display: grid;
            grid-template-columns: 1.65fr 1fr;
            gap: 32px;
            margin-bottom: 56px;
        }

        @media (max-width: 960px) {
            .mitra-info-grid {
                grid-template-columns: 1fr;
            }
        }

        .mitra-panel-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        }

        .mitra-panel-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 18px;
            padding-bottom: 14px;
            border-bottom: 2px solid #f1f5f9;
        }

        .mitra-description-text {
            font-size: 15.5px;
            line-height: 1.85;
            color: #334155;
            white-space: pre-line;
            margin: 0;
        }

        .mitra-contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mitra-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .mitra-contact-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #eff6ff;
            color: #0B62A2;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .mitra-contact-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 2px;
            display: block;
        }

        .mitra-contact-val {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            word-break: break-word;
        }

        .mitra-contact-val a {
            color: #0B62A2;
            text-decoration: none;
        }

        /* Products Section */
        .products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 28px;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            display: flex;
            flex-direction: column;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(11, 98, 162, 0.12);
            border-color: #93c5fd;
        }

        .product-card__img-wrap {
            height: 210px;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
        }

        .product-card__img-wrap img {
            max-height: 165px;
            max-width: 100%;
            object-fit: contain;
        }

        .product-card__badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #0B62A2;
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 99px;
            box-shadow: 0 4px 10px rgba(11, 98, 162, 0.25);
        }

        .product-card__body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card__title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 10px;
            line-height: 1.35;
        }

        .product-card__desc {
            font-size: 14px;
            line-height: 1.7;
            color: #475569;
            margin: 0 0 18px;
            flex-grow: 1;
        }

        .product-card__spec {
            background: #f1f5f9;
            border-left: 3px solid #0B62A2;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            color: #334155;
            line-height: 1.55;
        }

        .product-card__spec strong {
            display: block;
            color: #0f172a;
            margin-bottom: 3px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* Other Partners Strip */
        .other-partners-box {
            margin-top: 64px;
            padding-top: 48px;
            border-top: 1px solid #e2e8f0;
        }

        .other-partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
            margin-top: 24px;
        }

        .other-partner-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            height: 86px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .other-partner-item:hover {
            transform: translateY(-4px);
            border-color: #0B62A2;
            box-shadow: 0 8px 20px rgba(11, 98, 162, 0.1);
        }

        .other-partner-item img {
            max-height: 46px;
            max-width: 100%;
            object-fit: contain;
            mix-blend-mode: multiply;
        }
    </style>
</head>

<body>
    <!-- ================= HEADER UTAMA ================= -->
    <header class="main-header is-scrolled" id="main-header">
        <div class="container main-header__inner">
            <a href="index.html" class="main-header__logo" id="logo-link" aria-label="Beranda">
                <img src="assets/logo-inkindo.png" alt="Logo DPP INKINDO DKI Jakarta">
            </a>

            <nav class="main-nav" id="main-nav">
                <ul class="main-nav__menu">
                    <li><a href="index.html" class="main-nav__link" id="nav-home">Home</a></li>
                    <li><a href="tentang.html" class="main-nav__link" id="nav-tentang">Tentang Kami</a></li>
                    <li><a href="regulasi.html" class="main-nav__link" id="nav-regulasi">Regulasi</a></li>
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

        <div class="header-search" id="header-search">
            <form class="container header-search__form" id="header-search-form">
                <input type="text" id="header-search-input" class="header-search__input" placeholder="Cari di sini..." autocomplete="off">
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

    <!-- Panel geser dari kiri -->
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
                <li><a href="http://localhost:8080/auth/login" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">groups</span>
                        <span><strong>Anggota INKINDO</strong><small>Akses portal untuk anggota terdaftar</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="http://localhost:8080/mitra/login" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">handshake</span>
                        <span><strong>Mitra Kerja</strong><small>Portal kolaborasi dan kemitraan</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
        </div>

        <!-- Info Lelang -->
        <div class="side-panel__content" data-content="lelang">
            <h3 class="side-panel__title">Info Lelang</h3>
            <p class="side-panel__desc">Pantau paket pengadaan jasa konsultansi pemerintah melalui kanal resmi berikut.</p>
            <ul class="panel-links">
                <li><a href="https://lpse.lkpp.go.id/eproc4/lelang" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">shopping_cart_checkout</span>
                        <span><strong>LKPP</strong><small>Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="lelang-lainnya.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">campaign</span>
                        <span><strong>Info Lelang Lainnya</strong><small>Informasi paket pengadaan alternatif</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
        </div>

        <!-- Anggota -->
        <div class="side-panel__content" data-content="anggota">
            <h3 class="side-panel__title">Anggota</h3>
            <ul class="panel-links">
                <li><a href="http://localhost:8080/auth/register" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">person_add</span>
                        <span><strong>Pendaftaran Anggota</strong><small>Registrasi baru keanggotaan INKINDO</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="http://localhost:8080/auth/login" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">autorenew</span>
                        <span><strong>Perpanjangan Anggota</strong><small>Herregistrasi keanggotaan tahunan</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="anggota-terdaftar.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">fact_check</span>
                        <span><strong>Anggota Terdaftar</strong><small>Direktori badan usaha terverifikasi</small></span>
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
                <li><a href="http://localhost:8080/mitra/register" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">how_to_reg</span>
                        <span><strong>Daftar Mitra Kerja</strong><small>Formulir registrasi kemitraan baru</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
            </ul>
            <h4 style="margin-top: 24px; font-size: 14px; font-weight: 700; color: var(--slate-900); display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: var(--royal); font-size: 20px;">verified</span>
                Mitra Kerja Terdaftar
            </h4>
            <div class="partner-grid" style="margin-top: 12px; grid-template-columns: repeat(3, 1fr);"></div>
        </div>

        <!-- Klinik Konsultasi -->
        <div class="side-panel__content" data-content="klinik">
            <h3 class="side-panel__title">Klinik Konsultasi</h3>
            <p class="side-panel__desc">Pendampingan gratis bagi anggota terkait regulasi, sertifikasi, dan pengadaan jasa konsultansi.</p>
            <div class="topic-list">
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Advokasi & Mediasi')">Advokasi &amp; Mediasi</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Regulasi')">Regulasi</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Perpajakan')">Perpajakan</span>
                <span class="topic-chip" onclick="openKlinikKonsultasiModal(event, 'Pelayanan')">Pelayanan (KTA, SBU, OSS, dll)</span>
            </div>
            <div class="panel-info">
                <span class="material-symbols-outlined">schedule</span>
                <span>Sesi tatap muka &amp; daring<br><small>Senin - Jumat: 08.00 - 16.30 WIB</small></span>
            </div>
            <button type="button" class="btn btn--primary btn--block" id="klinik-cta" onclick="openKlinikKonsultasiModal(event)">Ajukan Konsultasi</button>
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
                <input type="text" id="chat-input" class="chat-form__input" placeholder="Ketik pesan..." autocomplete="off">
                <button type="submit" class="chat-form__btn" aria-label="Kirim">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>
    </div>
    <div class="overlay" id="overlay"></div>

    <!-- ================= HERO PROFIL MITRA KERJA ================= -->
    <main>
        <section class="mitra-profile-hero">
            <div class="container" style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto;">
                <nav class="mitra-breadcrumb" aria-label="Breadcrumb">
                    <a href="index.html">Beranda</a>
                    <span class="material-symbols-outlined" style="font-size: 16px;">chevron_right</span>
                    <a href="ketentuan-mitra-kerja.html">Mitra Kerja</a>
                    <span class="material-symbols-outlined" style="font-size: 16px;">chevron_right</span>
                    <span id="breadcrumb-mitra-name">Profil Mitra Kerja</span>
                </nav>

                <div class="mitra-hero-card">
                    <div class="mitra-logo-box">
                        <img id="mitra-logo-img" src="assets/logo-inkindo.png" alt="Logo Mitra Kerja">
                    </div>
                    <div>
                        <div class="mitra-verified-pill">
                            <span class="material-symbols-outlined" style="font-size: 16px;">verified</span>
                            Mitra Kerja Resmi DPP INKINDO DKI Jakarta
                        </div>
                        <h1 class="mitra-company-title" id="mitra-company-name">Memuat Data Mitra Kerja...</h1>
                        <p class="mitra-category-subtitle" id="mitra-category-name">-</p>
                        <div class="mitra-hero-actions" id="mitra-hero-actions">
                            <button type="button" class="btn-hero-action btn-hero-action--white" onclick="openKontakMitraModal()" style="border: none; cursor: pointer; font-family: inherit;">
                                <span class="material-symbols-outlined" style="font-size: 18px;">mail</span>
                                Kontak Kami
                            </button>
                            <a href="ketentuan-mitra-kerja.html" class="btn-hero-action btn-hero-action--glass">
                                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                                Halaman Mitra Kerja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= DESKRIPSI & KATALOG PRODUK MITRA KERJA ================= -->
        <section class="mitra-body-section" id="mitra-active-body">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <div class="mitra-info-grid">
                    <!-- Deskripsi Perusahaan -->
                    <div class="mitra-panel-card">
                        <h2 class="mitra-panel-title">
                            <span class="material-symbols-outlined" style="color: #0B62A2; font-size: 26px;">domain</span>
                            Tentang Perusahaan Mitra Kerja
                        </h2>
                        <p class="mitra-description-text" id="mitra-description-text">Memuat deskripsi perusahaan...</p>
                    </div>

                    <!-- Informasi Kontak & Alamat -->
                    <div class="mitra-panel-card">
                        <h2 class="mitra-panel-title">
                            <span class="material-symbols-outlined" style="color: #0B62A2; font-size: 26px;">contact_phone</span>
                            Informasi &amp; Kontak Mitra
                        </h2>
                        <ul class="mitra-contact-list">
                            <li class="mitra-contact-item">
                                <div class="mitra-contact-icon">
                                    <span class="material-symbols-outlined">location_on</span>
                                </div>
                                <div>
                                    <span class="mitra-contact-label">Alamat Kantor / Showroom</span>
                                    <div class="mitra-contact-val" id="mitra-contact-alamat">-</div>
                                </div>
                            </li>
                            <li class="mitra-contact-item">
                                <div class="mitra-contact-icon">
                                    <span class="material-symbols-outlined">call</span>
                                </div>
                                <div>
                                    <span class="mitra-contact-label">Telepon</span>
                                    <div class="mitra-contact-val" id="mitra-contact-telepon">-</div>
                                </div>
                            </li>
                            <li class="mitra-contact-item">
                                <div class="mitra-contact-icon">
                                    <span class="material-symbols-outlined">mail</span>
                                </div>
                                <div>
                                    <span class="mitra-contact-label">Email Resmi</span>
                                    <div class="mitra-contact-val" id="mitra-contact-email">-</div>
                                </div>
                            </li>
                            <li class="mitra-contact-item">
                                <div class="mitra-contact-icon">
                                    <span class="material-symbols-outlined">language</span>
                                </div>
                                <div>
                                    <span class="mitra-contact-label">Website</span>
                                    <div class="mitra-contact-val" id="mitra-contact-website">-</div>
                                </div>
                            </li>
                        </ul>

                        <button type="button" onclick="openKontakMitraModal()" style="margin-top: 20px; width: 100%; background: #0B62A2; color: #ffffff; border: none; border-radius: 12px; padding: 13px 20px; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; font-family: inherit; box-shadow: 0 6px 18px rgba(11, 98, 162, 0.25);">
                            <span class="material-symbols-outlined" style="font-size: 20px;">send</span>
                            Kontak Kami (Kirim Pesan ke Mitra)
                        </button>
                    </div>
                </div>

                <!-- Katalog & Detail Produk -->
                <div>
                    <div class="products-header">
                        <div>
                            <span style="color: #0B62A2; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1.4px; display: block; margin-bottom: 4px;">
                                Katalog &amp; Spesifikasi Teknis
                            </span>
                            <h2 style="font-size: clamp(24px, 3vw, 32px); font-weight: 800; color: #0f172a; margin: 0;">
                                Detail Produk &amp; Layanan Unggulan
                            </h2>
                        </div>
                        <span id="products-count-badge" style="background: #eff6ff; color: #0B62A2; border: 1px solid #bfdbfe; padding: 8px 16px; border-radius: 99px; font-size: 13.5px; font-weight: 700;">
                            0 Produk Terdaftar
                        </span>
                    </div>

                    <div class="products-grid" id="mitra-products-grid">
                        <!-- Diisi otomatis via JS -->
                    </div>
                </div>

                <!-- Mitra Kerja Lainnya -->
                <div class="other-partners-box">
                    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 6px;">
                        Jejaring Mitra Kerja Lainnya
                    </h3>
                    <p style="font-size: 14px; color: #64748b; margin: 0;">
                        Klik pada logo mitra kerja di bawah ini untuk melihat profil perusahaan dan detail produknya.
                    </p>
                    <div class="other-partners-grid" id="other-partners-grid"></div>
                </div>
            </div>
        </section>

        <!-- Tampilan Otomatis Jika Mitra Kerja Expired / Nonaktif -->
        <section class="mitra-body-section" id="mitra-inactive-body" style="display: none;">
            <div class="container" style="max-width: 720px; margin: 0 auto;">
                <div style="background: #ffffff; border: 1px solid #fecaca; border-radius: 24px; padding: 48px 36px; text-align: center; box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);">
                    <div style="width: 72px; height: 72px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <span class="material-symbols-outlined" style="font-size: 38px;">event_busy</span>
                    </div>
                    <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 12px;" id="inactive-title">
                        Halaman Mitra Kerja Tidak Aktif
                    </h2>
                    <p style="font-size: 15px; line-height: 1.7; color: #475569; margin: 0 0 28px;" id="inactive-desc">
                        Masa berlaku kerjasama Mitra Kerja ini telah berakhir (Expired) atau sedang menunggu persetujuan Admin.
                    </p>
                    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                        <a href="ketentuan-mitra-kerja.html" style="background: #0B62A2; color: #ffffff; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                            Kembali ke Halaman Mitra Kerja
                        </a>
                        <a href="http://localhost:8080/mitra/login" target="_blank" style="background: #f1f5f9; color: #0f172a; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">autorenew</span>
                            Login Mitra (Perpanjang Kemitraan)
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ================= POP-UP MODAL KONTAK KAMI (MITRA KERJA) ================= -->
    <div class="daftar-mitra-modal-overlay" id="kontak-mitra-modal" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="daftar-mitra-modal-card" style="max-width: 580px;">
            <div class="daftar-mitra-modal-header">
                <div class="daftar-mitra-header-left">
                    <div class="daftar-mitra-header-icon" style="background: rgba(11, 98, 162, 0.1); color: #0B62A2;">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h3 class="daftar-mitra-modal-title">Kontak Kami</h3>
                        <p class="daftar-mitra-modal-subtitle" id="kontak-mitra-subtitle">Kirim pesan langsung kepada Mitra Kerja</p>
                    </div>
                </div>
                <button type="button" class="daftar-mitra-modal-close" onclick="closeKontakMitraModal()" aria-label="Tutup modal">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form id="form-kontak-mitra" onsubmit="handleKontakMitraSubmit(event)">
                <div class="daftar-mitra-modal-body" id="kontak-mitra-form-body">
                    <div class="mitra-form-group">
                        <label class="mitra-form-label" for="km-nama-perusahaan">Nama Perusahaan <span class="req">*</span></label>
                        <div class="mitra-input-wrapper">
                            <span class="material-symbols-outlined mitra-input-icon">apartment</span>
                            <input type="text" id="km-nama-perusahaan" class="mitra-form-input" placeholder="Contoh: PT Mega Trustlink" required>
                        </div>
                    </div>

                    <div class="mitra-form-row">
                        <div class="mitra-form-group">
                            <label class="mitra-form-label" for="km-email-perusahaan">Email Perusahaan <span class="req">*</span></label>
                            <div class="mitra-input-wrapper">
                                <span class="material-symbols-outlined mitra-input-icon">mail</span>
                                <input type="email" id="km-email-perusahaan" class="mitra-form-input" placeholder="email@perusahaan.co.id" required>
                            </div>
                        </div>
                        <div class="mitra-form-group">
                            <label class="mitra-form-label" for="km-no-telepon">No. Telepon <span class="req">*</span></label>
                            <div class="mitra-input-wrapper">
                                <span class="material-symbols-outlined mitra-input-icon">call</span>
                                <input type="tel" id="km-no-telepon" class="mitra-form-input" placeholder="(021) 1234567 / 0812..." required>
                            </div>
                        </div>
                    </div>

                    <div class="mitra-form-group">
                        <label class="mitra-form-label" for="km-nama-pic">Nama PIC <span class="req">*</span></label>
                        <div class="mitra-input-wrapper">
                            <span class="material-symbols-outlined mitra-input-icon">person</span>
                            <input type="text" id="km-nama-pic" class="mitra-form-input" placeholder="Nama lengkap PIC / Narahubung" required>
                        </div>
                    </div>

                    <div class="mitra-form-group">
                        <label class="mitra-form-label" for="km-pesan">Pesan <span class="req">*</span></label>
                        <div class="mitra-input-wrapper mitra-input-wrapper--textarea">
                            <span class="material-symbols-outlined mitra-input-icon">edit_note</span>
                            <textarea id="km-pesan" class="mitra-form-textarea" rows="4" placeholder="Tuliskan pertanyaan spesifikasi produk, permintaan penawaran harga, atau kerjasama..." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="daftar-mitra-modal-footer" id="kontak-mitra-footer">
                    <button type="button" class="btn-mitra-cancel" onclick="closeKontakMitraModal()">Batal</button>
                    <button type="submit" class="btn-mitra-submit" id="btn-submit-kontak-mitra">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    @include('partials.footer')

    <script src="js/script.js?v=cerah15"></script>
    <script>
        (function () {
            let currentSlug = '';
            let currentMitraName = 'Mitra Kerja';

            function escapeHtml(str) {
                return String(str ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            window.openKontakMitraModal = function () {
                const modal = document.getElementById('kontak-mitra-modal');
                if (!modal) return;
                modal.classList.add('is-active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            window.closeKontakMitraModal = function () {
                const modal = document.getElementById('kontak-mitra-modal');
                if (!modal) return;
                modal.classList.remove('is-active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            document.getElementById('kontak-mitra-modal')?.addEventListener('click', (e) => {
                if (e.target.id === 'kontak-mitra-modal') window.closeKontakMitraModal();
            });

            window.handleKontakMitraSubmit = async function (e) {
                e.preventDefault();
                if (!currentSlug) return;

                const submitBtn = document.getElementById('btn-submit-kontak-mitra');
                const origText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengirim...';

                const payload = {
                    nama_perusahaan: document.getElementById('km-nama-perusahaan').value,
                    email_perusahaan: document.getElementById('km-email-perusahaan').value,
                    no_telepon: document.getElementById('km-no-telepon').value,
                    nama_pic: document.getElementById('km-nama-pic').value,
                    pesan: document.getElementById('km-pesan').value
                };

                try {
                    const res = await fetch('/api/mitra/' + encodeURIComponent(currentSlug) + '/messages', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await res.json();
                    if (res.ok) {
                        const bodyEl = document.getElementById('kontak-mitra-form-body');
                        const footerEl = document.getElementById('kontak-mitra-footer');
                        bodyEl.innerHTML = `
                            <div class="mitra-success-box">
                                <div class="mitra-success-icon">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                                <h4 class="mitra-success-title">Pesan Berhasil Dikirim!</h4>
                                <p class="mitra-success-desc">
                                    Terima kasih <strong>${escapeHtml(payload.nama_pic)} (${escapeHtml(payload.nama_perusahaan)})</strong>. Pesan Anda telah masuk ke kotak <strong>Pesan Masuk</strong> dashboard <strong>${escapeHtml(currentMitraName)}</strong>.
                                </p>
                                <button type="button" class="btn-mitra-submit" onclick="window.location.reload()" style="margin: 0 auto;">
                                    Selesai &amp; Tutup
                                </button>
                            </div>
                        `;
                        footerEl.style.display = 'none';
                    } else {
                        alert(data.message || 'Gagal mengirim pesan. Mohon periksa kembali isian Anda.');
                        submitBtn.disabled = false;
                        submitBtn.textContent = origText;
                    }
                } catch (err) {
                    alert('Terjadi kesalahan jaringan saat mengirim pesan.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = origText;
                }
            };

            async function loadMitraDetail() {
                const pathParts = window.location.pathname.split('/').filter(Boolean);
                const slugParam = new URLSearchParams(window.location.search).get('slug');
                const slug = slugParam || (pathParts.length >= 2 ? pathParts[pathParts.length - 1] : '');

                if (!slug) return;
                currentSlug = slug;

                try {
                    const res = await fetch('/api/mitra/' + encodeURIComponent(slug), {
                        headers: { 'Accept': 'application/json' }
                    });
                    const data = await res.json();

                    if (res.status === 403 && data.inactive) {
                        document.getElementById('mitra-company-name').textContent = data.nama_perusahaan || 'Mitra Kerja Nonaktif';
                        document.getElementById('mitra-category-name').textContent = 'Status Kemitraan: ' + String(data.status_kemitraan || 'Expired').toUpperCase();
                        document.getElementById('mitra-hero-actions').innerHTML = `
                            <a href="ketentuan-mitra-kerja.html" class="btn-hero-action btn-hero-action--glass">
                                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                                Halaman Mitra Kerja
                            </a>
                        `;
                        document.getElementById('mitra-active-body').style.display = 'none';
                        document.getElementById('mitra-inactive-body').style.display = 'block';
                        document.getElementById('inactive-desc').textContent = data.message;
                        return;
                    }

                    if (!res.ok || !data.mitra) {
                        document.getElementById('mitra-company-name').textContent = 'Mitra Kerja Tidak Ditemukan';
                        document.getElementById('mitra-active-body').style.display = 'none';
                        document.getElementById('mitra-inactive-body').style.display = 'block';
                        return;
                    }

                    const m = data.mitra;
                    currentMitraName = m.nama_perusahaan;
                    const others = Array.isArray(data.other_mitra) ? data.other_mitra : [];

                    document.title = m.nama_perusahaan + ' – Mitra Kerja INKINDO DKI Jakarta';
                    document.getElementById('breadcrumb-mitra-name').textContent = m.nama_perusahaan;
                    document.getElementById('mitra-company-name').textContent = m.nama_perusahaan;
                    document.getElementById('mitra-category-name').textContent = m.kategori_bisnis || 'Mitra Strategis INKINDO DKI Jakarta';
                    document.getElementById('kontak-mitra-subtitle').textContent = 'Kirim pesan langsung kepada ' + m.nama_perusahaan;

                    const logoEl = document.getElementById('mitra-logo-img');
                    logoEl.src = m.logo || 'assets/logo-inkindo.png';
                    logoEl.alt = m.nama_perusahaan;

                    document.getElementById('mitra-description-text').textContent = m.deskripsi || '-';
                    document.getElementById('mitra-contact-alamat').textContent = m.alamat || '-';
                    document.getElementById('mitra-contact-telepon').textContent = m.telepon || '-';

                    const emailEl = document.getElementById('mitra-contact-email');
                    if (m.email && m.email !== '-') {
                        emailEl.innerHTML = `<a href="mailto:${escapeHtml(m.email)}">${escapeHtml(m.email)}</a>`;
                    } else {
                        emailEl.textContent = '-';
                    }

                    const webEl = document.getElementById('mitra-contact-website');
                    const actionsEl = document.getElementById('mitra-hero-actions');
                    let actionsHtml = `
                        <button type="button" class="btn-hero-action btn-hero-action--white" onclick="openKontakMitraModal()" style="border: none; cursor: pointer; font-family: inherit;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">mail</span>
                            Kontak Kami
                        </button>
                    `;
                    if (m.website && m.website !== '-') {
                        const href = m.website.startsWith('http') ? m.website : 'https://' + m.website;
                        webEl.innerHTML = `<a href="${escapeHtml(href)}" target="_blank" rel="noopener noreferrer">${escapeHtml(m.website)}</a>`;
                        actionsHtml += `
                            <a href="${escapeHtml(href)}" target="_blank" rel="noopener noreferrer" class="btn-hero-action btn-hero-action--glass">
                                <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
                                Kunjungi Website Resmi
                            </a>
                        `;
                    } else {
                        webEl.textContent = '-';
                    }
                    actionsHtml += `
                        <a href="ketentuan-mitra-kerja.html" class="btn-hero-action btn-hero-action--glass">
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                            Semua Mitra Kerja
                        </a>
                    `;
                    actionsEl.innerHTML = actionsHtml;

                    const products = Array.isArray(m.products) ? m.products : [];
                    document.getElementById('products-count-badge').textContent = products.length + ' Produk Unggulan';

                    const productsGrid = document.getElementById('mitra-products-grid');
                    if (products.length > 0) {
                        productsGrid.innerHTML = products.map(p => `
                            <article class="product-card">
                                <div class="product-card__img-wrap">
                                    <span class="product-card__badge">${escapeHtml(p.kategori_produk || 'Produk Unggulan')}</span>
                                    <img src="${escapeHtml(p.gambar_produk || m.logo)}" alt="${escapeHtml(p.nama_produk)}">
                                </div>
                                <div class="product-card__body">
                                    <h3 class="product-card__title">${escapeHtml(p.nama_produk)}</h3>
                                    <p class="product-card__desc">${escapeHtml(p.deskripsi_produk)}</p>
                                    ${p.spesifikasi && p.spesifikasi !== '-' ? `
                                        <div class="product-card__spec">
                                            <strong>Spesifikasi &amp; Detail Teknis</strong>
                                            ${escapeHtml(p.spesifikasi)}
                                        </div>
                                    ` : ''}
                                </div>
                            </article>
                        `).join('');
                    } else {
                        productsGrid.innerHTML = `
                            <div style="grid-column: 1 / -1; background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 16px; padding: 40px; text-align: center; color: #64748b;">
                                <span class="material-symbols-outlined" style="font-size: 40px; color: #94a3b8; margin-bottom: 8px;">inventory_2</span>
                                <p style="margin: 0; font-size: 15px;">Belum ada rincian katalog produk yang diunggah oleh Mitra Kerja ini.</p>
                            </div>
                        `;
                    }

                    const otherGrid = document.getElementById('other-partners-grid');
                    if (otherGrid && others.length > 0) {
                        otherGrid.innerHTML = others.map(o => `
                            <a href="/mitra-kerja/${encodeURIComponent(o.slug)}" class="other-partner-item" title="${escapeHtml(o.nama_perusahaan)}">
                                <img src="${escapeHtml(o.logo)}" alt="${escapeHtml(o.nama_perusahaan)}">
                            </a>
                        `).join('');
                    }
                } catch (err) {
                    console.error('Gagal memuat detail mitra:', err);
                }
            }

            loadMitraDetail();
        })();
    </script>
</body>

</html>