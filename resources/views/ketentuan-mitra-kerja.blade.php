<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Informasi Tentang Mitra Kerja, Maksud & Tujuan, Syarat, dan Ketentuan Mitra Kerja DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>
        /* Hero Animation */
        @keyframes heroFadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-anim-title {
            animation: heroFadeUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .hero-anim-line {
            opacity: 0;
            animation: heroFadeUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.2s forwards;
        }

        .hero-anim-desc {
            opacity: 0;
            animation: heroFadeUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.4s forwards;
        }

        .hero-anim-btns {
            opacity: 0;
            animation: heroFadeUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.6s forwards;
        }

        /* Benefit Cards - iOS Glassmorphism */
        .benefit-card {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            padding: 36px 30px;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.02),
                0 12px 28px -4px rgba(15, 23, 42, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .benefit-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.92);
            border-color: rgba(255, 255, 255, 1);
            box-shadow:
                0 8px 12px -2px rgba(0, 0, 0, 0.03),
                0 22px 38px -6px rgba(15, 23, 42, 0.09),
                inset 0 1px 0 rgba(255, 255, 255, 1);
        }

        .benefit-icon-wrap {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            margin-bottom: 22px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .benefit-card:hover .benefit-icon-wrap {
            transform: scale(1.08);
        }

        .benefit-icon-wrap--blue {
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            border: 1px solid rgba(11, 98, 162, 0.15);
        }

        .benefit-icon-wrap--amber {
            background: linear-gradient(135deg, #fef3c7 0%, #ffedd5 100%);
            color: #d97706;
            border: 1px solid rgba(254, 215, 170, 0.8);
        }

        .benefit-icon-wrap--green {
            background: linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%);
            color: #16a34a;
            border: 1px solid rgba(187, 247, 208, 0.8);
        }

        .benefit-list {
            margin: auto 0 0;
            padding: 20px 0 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            border-top: 1px solid rgba(226, 232, 240, 0.7);
        }

        .benefit-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13.5px;
            line-height: 1.55;
            color: #334155;
        }

        .benefit-list-icon {
            font-size: 18px;
            line-height: 1.25;
            flex-shrink: 0;
        }

        /* Syarat Grid */
        .syarat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .syarat-item {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 10px;
            padding: 24px;
            display: flex;
            gap: 18px;
            align-items: flex-start;
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .syarat-item:hover {
            border-color: var(--royal);
            transform: translateX(4px);
        }

        .syarat-badge {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eff6ff;
            color: var(--royal);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            font-weight: 700;
        }

        /* Ketentuan Cards */
        .ketentuan-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 28px;
            transition: background 0.3s ease;
        }

        .ketentuan-card:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        /* Partner Logos Showcase */
        .partner-logo-item {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .partner-logo-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-color: var(--royal);
        }

        .partner-logo-item img {
            max-height: 48px;
            max-width: 100%;
            width: auto;
            object-fit: contain;
            mix-blend-mode: multiply;
        }

        /* CTA Card */
        .mitra-cta-box {
            background: linear-gradient(135deg, #005088 0%, #0B62A2 100%);
            border-radius: 16px;
            padding: 56px 40px;
            color: var(--white);
            box-shadow: 0 20px 40px rgba(11, 98, 162, 0.35);
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 40px;
            align-items: center;
        }

        @media (max-width: 900px) {
            .mitra-cta-box {
                grid-template-columns: 1fr;
                padding: 36px 24px;
            }
        }

        .syarat-layout {
            display: grid;
            grid-template-columns: 1fr 1.6fr;
            gap: 48px;
            align-items: flex-start;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
        }

        .ketentuan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
        }

        .partner-logos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }

        .mitra-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0F172A;
            background: url('{{ \App\Support\PageBackgroundHelper::get('ketentuan_mitra_hero', 'assets/jakarta7.webp') }}') center/cover no-repeat;
        }

        @media (max-width: 900px) {
            .syarat-layout {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            .mitra-hero {
                min-height: 70vh !important;
                padding: 100px 0 50px !important;
            }

            .mitra-hero h1 {
                font-size: 32px !important;
            }

            .benefit-card {
                padding: 24px 20px !important;
            }

            .ketentuan-card {
                padding: 20px 16px !important;
            }

            .mitra-content section {
                padding: 60px 0 !important;
            }

            .syarat-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .syarat-item {
                padding: 18px 16px;
            }
        }
    </style>
</head>

<body>
    <!-- ================= HEADER UTAMA ================= -->
    <header class="main-header" id="main-header">
        <div class="container main-header__inner">
            <a href="index.html" class="main-header__logo" id="logo-link" aria-label="Beranda">
                <img src="assets/logo-inkindo.webp" alt="Logo DPP INKINDO DKI Jakarta">
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
                <input type="text" id="header-search-input" class="header-search__input" placeholder="Cari di sini..."
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
                <li><a href="http://localhost:8080/auth/login" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">groups</span>
                        <span><strong>Anggota INKINDO</strong><small>Akses portal untuk anggota terdaftar</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="http://localhost:8080/mitra/login" target="_blank" rel="noopener noreferrer"
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
                <li><a href="http://localhost:8080/auth/register" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">person_add</span>
                        <span><strong>Pendaftaran Anggota</strong><small>Registrasi baru keanggotaan
                                INKINDO</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="http://localhost:8080/auth/login" target="_blank" rel="noopener noreferrer"
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
                <li><a href="ketentuan-mitra-kerja.html" class="panel-link is-current">
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
                    <img src="mitra_logos/avian.webp" alt="Avian"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/lesso.webp" alt="Lesso"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/seven.webp" alt="Seven"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/dekkson.webp" alt="Dekkson"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/alila.webp" alt="Alila"
                        style="max-height: 35px; width: auto; mix-blend-mode: multiply;">
                </div>
                <div class="partner-card"
                    style="padding: 12px; align-items: center; justify-content: center; height: 100%;">
                    <img src="mitra_logos/propan.webp" alt="Propan"
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

    <!-- ================= MAIN CONTENT ================= -->
    <main class="mitra-content">

        <!-- 1. Hero Section (Identik tentang.html: Full Screen 100vh & Warna Biru Identik) -->
        <section class="mitra-hero">
            <div
                style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(8, 14, 40, 0.45) 0%, rgba(8, 14, 40, 0.18) 35%, rgba(8, 14, 40, 0.65) 100%), linear-gradient(90deg, rgba(8, 14, 40, 0.35) 0%, transparent 60%);">
            </div>
            <div class="container" style="position: relative; z-index: 2; text-align: left; width: 100%;">
                <h1 class="hero-anim-title"
                    style="font-size: clamp(38px, 5vw, 56px); font-weight: 800; margin-bottom: 16px; letter-spacing: -1px; color: #ffffff; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);">
                    {{ $page->hero_judul ?? 'Tentang Mitra Kerja' }}</h1>
                <div class="hero-anim-line"
                    style="width: 70px; height: 5px; background: #ffffff; margin: 0 0 24px; border-radius: 4px;">
                </div>
                <div class="hero-anim-desc"
                    style="font-size: clamp(16px, 1.8vw, 19px); max-width: 780px; line-height: 1.8; color: rgba(255, 255, 255, 0.92); font-weight: 400; text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column; gap: 16px;">
                    <p style="margin: 0;">
                        {{ $page->hero_paragraf_1 ?? '' }}
                    </p>
                    @if (!empty($page->hero_paragraf_2))
                        <p
                            style="margin: 0; padding-left: 16px; border-left: 3px solid #60a5fa; color: rgba(255, 255, 255, 0.95); text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);">
                            {{ $page->hero_paragraf_2 }}
                        </p>
                    @endif
                </div>
                <div class="hero-anim-btns" style="margin-top: 36px; display: flex; gap: 16px; flex-wrap: wrap;">
                    <button type="button" class="btn btn--primary" onclick="openDaftarMitraModal()"
                        style="padding: 14px 28px; font-size: 15px; font-weight: 700; border-radius: 10px; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 8px 24px rgba(11, 98, 162, 0.25);">
                        <span class="material-symbols-outlined" style="font-size: 22px;">how_to_reg</span>
                        Daftar Mitra Kerja
                    </button>
                    <a href="#maksud-tujuan" class="btn btn--outline"
                        style="padding: 14px 28px; font-size: 15px; font-weight: 600; border-radius: 10px; color: #0B62A2; border: 1.5px solid #0B62A2; display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.8);">
                        <span class="material-symbols-outlined" style="font-size: 20px;">info</span>
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>
        </section>

        <!-- 2. Maksud & Tujuan Mitra Kerja (iOS Glassmorphism & Soft Ambient Background) -->
        <section id="maksud-tujuan"
            style="padding: 96px 0; background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); position: relative; overflow: hidden;">
            <!-- Ambient Blur Glows for Glassmorphism Effect -->
            <div
                style="position: absolute; top: -60px; left: 10%; width: 440px; height: 440px; background: radial-gradient(circle, rgba(14, 165, 233, 0.12) 0%, rgba(14, 165, 233, 0) 70%); filter: blur(60px); pointer-events: none;">
            </div>
            <div
                style="position: absolute; bottom: -80px; right: 10%; width: 480px; height: 480px; background: radial-gradient(circle, rgba(245, 158, 11, 0.10) 0%, rgba(245, 158, 11, 0) 70%); filter: blur(70px); pointer-events: none;">
            </div>

            <div class="container"
                style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; text-align: left;">
                <div style="text-align: center; max-width: 860px; margin: 0 auto 56px;">
                    <span
                        style="color: var(--royal); font-weight: 700; font-size: 13.5px; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 8px;">
                        {{ $page->tujuan_label ?? 'Kolaborasi & Sinergi Strategis' }}
                    </span>
                    <h2
                        style="font-size: clamp(28px, 3.5vw, 38px); color: var(--slate-900); font-weight: 800; margin-bottom: 20px; line-height: 1.3;">
                        {{ $page->tujuan_judul ?? 'Maksud & Tujuan Mitra Kerja' }}
                    </h2>
                    <div
                        style="width: 50px; height: 4px; background: var(--royal); margin: 0 auto 24px; border-radius: 2px;">
                    </div>
                    <p style="font-size: 17px; line-height: 1.8; color: var(--slate-700); margin: 0;">
                        {{ $page->tujuan_deskripsi ?? '' }}
                    </p>
                </div>

                <!-- 3 Pillars Benefit Grid (iOS Glassmorphism) -->
                @php
                    $cardStyles = [
                        ['wrap' => 'benefit-icon-wrap--blue',  'icon' => 'group',     'check' => '#0B62A2'],
                        ['wrap' => 'benefit-icon-wrap--amber', 'icon' => 'handshake', 'check' => '#d97706'],
                        ['wrap' => 'benefit-icon-wrap--green', 'icon' => 'public',    'check' => '#16a34a'],
                    ];
                @endphp
                <div class="benefits-grid">
                    @foreach (($page->tujuan_cards ?? []) as $cIdx => $card)
                        @php $st = $cardStyles[$cIdx % 3]; @endphp
                        <div class="benefit-card">
                            <div class="benefit-icon-wrap {{ $st['wrap'] }}">
                                <span class="material-symbols-outlined" style="font-size: 30px;">{{ $st['icon'] }}</span>
                            </div>
                            <h3
                                style="font-size: 21px; font-weight: 700; color: #0f172a; margin-bottom: 12px; letter-spacing: -0.015em;">
                                {{ $card->judul ?? '' }}
                            </h3>
                            <p style="font-size: 14.5px; line-height: 1.65; color: #475569; margin: 0 0 22px;">
                                {{ $card->deskripsi ?? '' }}
                            </p>
                            @if (!empty($card->poin))
                                <ul class="benefit-list">
                                    @foreach ($card->poin as $poinText)
                                        <li>
                                            <span class="material-symbols-outlined benefit-list-icon"
                                                style="color: {{ $st['check'] }};">check_circle</span>
                                            <span>{{ $poinText }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 3. Syarat Mitra Kerja (Subtle Slate Background) -->
        <section id="syarat"
            style="padding: 88px 0; background: var(--slate-50); border-top: 1px solid var(--slate-200); border-bottom: 1px solid var(--slate-200);">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: left;">
                <div class="syarat-layout">
                    <div>
                        <span
                            style="color: var(--royal); font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 8px;">
                            {{ $page->syarat_label ?? 'Kriteria & Legalitas' }}
                        </span>
                        <h2
                            style="font-size: clamp(28px, 3.5vw, 36px); color: var(--slate-900); font-weight: 800; margin-bottom: 20px; line-height: 1.3;">
                            {{ $page->syarat_judul ?? 'Syarat Mitra Kerja' }}
                        </h2>
                        <div
                            style="width: 50px; height: 4px; background: var(--royal); margin: 0 0 24px; border-radius: 2px;">
                        </div>
                        <p style="font-size: 16px; line-height: 1.8; color: var(--slate-600); margin-bottom: 24px;">
                            {{ $page->syarat_deskripsi ?? '' }}
                        </p>
                        <div
                            style="background: #eff6ff; border-left: 4px solid var(--royal); padding: 18px; border-radius: 8px;">
                            <h4
                                style="margin: 0 0 6px; font-size: 15px; font-weight: 700; color: var(--royal); display: flex; align-items: center; gap: 6px;">
                                <span class="material-symbols-outlined" style="font-size: 18px;">verified_user</span>
                                {{ $page->syarat_info_judul ?? 'Siapa yang Dapat Bermitra?' }}
                            </h4>
                            <p style="margin: 0; font-size: 13.5px; color: var(--slate-700); line-height: 1.6;">
                                {{ $page->syarat_info_isi ?? '' }}
                            </p>
                        </div>
                        <div style="margin-top: 32px;">
                            <button type="button" class="btn btn--primary" onclick="openDaftarMitraModal()"
                                style="padding: 12px 24px; font-size: 14px; font-weight: 700; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px;">
                                <span class="material-symbols-outlined">how_to_reg</span>
                                Daftar Mitra Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- Daftar Persyaratan -->
                    <div class="syarat-grid">
                        @foreach ($syaratItems as $idx => $sItem)
                            <div class="syarat-item">
                                <div class="syarat-badge">{{ $idx + 1 }}</div>
                                <div>
                                    <h4
                                        style="margin: 0 0 6px; font-size: 16px; font-weight: 700; color: var(--slate-900);">
                                        {{ $sItem->judul }}
                                    </h4>
                                    <p style="margin: 0; font-size: 14px; line-height: 1.6; color: var(--slate-600);">
                                        {{ $sItem->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Ketentuan Mitra Kerja (Image Background Identik Visi Misi tentang.html) -->
        <section id="ketentuan"
            style="position: relative; padding: 96px 0; color: var(--white); background: url('{{ \App\Support\PageBackgroundHelper::get('ketentuan_mitra_section', 'assets/jakarta3.webp') }}') center/cover no-repeat fixed;">
            <div style="position: absolute; inset: 0; background: rgba(8, 14, 40, 0.72);"></div>
            <div class="container"
                style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; text-align: left;">
                <div style="text-align: center; max-width: 800px; margin: 0 auto 56px;">
                    <span
                        style="color: var(--accent, #f59e0b); font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 8px;">
                        {{ $page->ketentuan_label ?? 'Tata Tertib & Regulasi Kerjasama' }}
                    </span>
                    <h2 style="font-size: clamp(28px, 3.5vw, 38px); margin-bottom: 16px; font-weight: 800;">
                        {{ $page->ketentuan_judul ?? 'Ketentuan Mitra Kerja' }}
                    </h2>
                    <div
                        style="width: 50px; height: 4px; background: var(--accent, #f59e0b); margin: 0 auto 20px; border-radius: 2px;">
                    </div>
                    <p style="font-size: 16px; line-height: 1.7; color: rgba(255, 255, 255, 0.9);">
                        {{ $page->ketentuan_deskripsi ?? '' }}
                    </p>
                </div>

                <div class="ketentuan-grid">
                    @foreach ($ketentuanItems as $kItem)
                        <div class="ketentuan-card">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                                <span class="material-symbols-outlined"
                                    style="font-size: 28px; color: var(--accent, #f59e0b);">{{ $kItem->ikon ?: 'gavel' }}</span>
                                <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: var(--white);">{{ $kItem->judul }}</h3>
                            </div>
                            <p style="margin: 0; font-size: 14.5px; line-height: 1.7; color: rgba(255, 255, 255, 0.88);">
                                {{ $kItem->deskripsi }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 5. Showcase Mitra Kerja Terdaftar -->
        <section style="padding: 88px 0 100px; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: left;">
                <div style="text-align: center; max-width: 800px; margin: 0 auto 48px;">
                    <span
                        style="color: var(--royal); font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 8px;">
                        Jejaring Rekanan Resmi
                    </span>
                    <h2
                        style="font-size: clamp(26px, 3.2vw, 36px); color: var(--slate-900); font-weight: 800; margin-bottom: 16px;">
                        Mitra Kerja Terdaftar INKINDO DKI Jakarta
                    </h2>
                    <div
                        style="width: 50px; height: 4px; background: var(--royal); margin: 0 auto 20px; border-radius: 2px;">
                    </div>
                    <p style="font-size: 16px; line-height: 1.7; color: var(--slate-600); margin: 0;">
                        Sinergi terpercaya bersama perusahaan-perusahaan terkemuka di sektor industri material,
                        teknologi rancang bangun, dan jasa konstruksi nasional.
                    </p>
                </div>

                <div class="partner-logos-grid">
                    <div class="partner-logo-item"><img src="mitra_logos/avian.webp" alt="Avian Brands"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/lesso.webp" alt="Lesso Group"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/seven.webp" alt="Seven ACP"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/dekkson.webp"
                            alt="Dekkson Architectural Hardware"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/alila.webp" alt="Alila"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/propan.webp" alt="Propan Raya"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/kulitbatu.webp" alt="Kulit Batu"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/kjpp.webp" alt="KJPP"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/amtyas.webp" alt="Amtyas"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/dc.webp" alt="DC"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/cbm.webp" alt="CBM"></div>
                    <div class="partner-logo-item"><img src="mitra_logos/cec.webp" alt="CEC"></div>
                </div>
            </div>
        </section>

    </main>

    <!-- ================= FOOTER ================= -->
@include('partials.footer')

    <script src="js/script.js?v=cerah15"></script>
</body>

</html>