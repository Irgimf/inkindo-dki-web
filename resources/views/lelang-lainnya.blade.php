<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Informasi paket lelang BUMN, lembaga multilateral internasional, dan peluang usaha konsultansi bagi anggota DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>
        /* Animasi Hero seperti di tentang.html */
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

        /* Card Portal Lelang */
        .portal-card {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 12px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }

        .portal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #0B62A2;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .portal-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .portal-card:hover::before {
            opacity: 1;
        }

        .portal-card__icon-box {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            display: grid;
            place-items: center;
            margin-bottom: 20px;
        }

        .portal-card__icon-box span {
            font-size: 28px;
        }

        .portal-card__category {
            font-size: 12px;
            font-weight: 600;
            color: #0B62A2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .portal-card__title {
            font-size: 19px;
            font-weight: 700;
            color: var(--slate-900);
            margin: 0 0 12px;
            line-height: 1.4;
        }

        .portal-card__desc {
            font-size: 14px;
            color: var(--slate-600);
            line-height: 1.6;
            margin: 0 0 24px;
            flex-grow: 1;
        }

        .portal-card__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #f1f5f9;
            color: var(--slate-800);
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            width: 100%;
        }

        .portal-card:hover .portal-card__btn {
            background: #0B62A2;
            color: #ffffff;
        }

        /* Surat Peluang Usaha Elegan */
        .notice-board {
            background: var(--white);
            border-radius: 16px;
            padding: 44px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
            color: var(--slate-900);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notice-board__head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--slate-100);
            padding-bottom: 24px;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .notice-board__badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            letter-spacing: 0.5px;
        }

        .notice-board__badge span {
            font-size: 16px;
        }

        .kualifikasi-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #0B62A2;
            border-radius: 8px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: 0.2s;
        }

        .kualifikasi-card:hover {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(11, 98, 162, 0.08);
            border-left-color: #0B62A2;
        }

        .kualifikasi-num {
            font-size: 20px;
            font-weight: 800;
            color: #0B62A2;
            line-height: 1;
            padding-top: 2px;
            min-width: 24px;
        }

        .kualifikasi-text {
            font-size: 15px;
            line-height: 1.6;
            color: var(--slate-700);
            margin: 0;
        }

        @media (max-width: 768px) {
            .notice-board {
                padding: 24px;
            }
        }
    </style>
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
                    <li><a href="index.html" class="main-nav__link" id="nav-home">Home</a></li>
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
            <p class="side-panel__desc">Pantau paket pengadaan jasa konsultansi pemerintah dan BUMN melalui kanal resmi
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
                        <span><strong>Info Lelang Lainnya</strong><small>Informasi paket pengadaan alternatif &amp;
                                peluang usaha</small></span>
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

        <!-- Hubungi Kami -->
        <div class="side-panel__content" data-content="kontak">
            <h3 class="side-panel__title">Hubungi Kami</h3>
            <ul class="panel-links">
                <li><a href="tel:+62217942940" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">call</span>
                        <span><strong>Telp: +62217942940(H) / +6282112079750</strong><small>Fax:
                                +62217942941</small></span>
                    </a></li>
                <li><a href="mailto:sekretariat@inkindo-dki.org" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">mail</span>
                        <span><strong>sekretariat@inkindo-dki.org</strong><small>inkindo_dki@yahoo.com</small></span>
                    </a></li>
                <li>
                    <div class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">location_on</span>
                        <span><strong>Sekretariat DPP</strong><small>Jl. Pertani No. 7, Duren Tiga - Pancoran,
                                Jakarta Selatan 12760</small></span>
                    </div>
                </li>
                <li>
                    <div class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">schedule</span>
                        <span><strong>Jam Operasional</strong><small>Senin - Jumat: 08.00 - 16.30 WIB</small></span>
                    </div>
                </li>
            </ul>
        </div>

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
    <main class="lelang-content">

        <!-- 1. Hero Section (Sama persis tentang.html: Full Screen 100vh & Warna Biru Identik) -->
        <section
            style="position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #0F172A; background: url('{{ \App\Support\PageBackgroundHelper::get('lelang_hero', 'assets/jakarta4.jpg') }}') center/cover no-repeat;">
            <div
                style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(8, 14, 40, 0.45) 0%, rgba(8, 14, 40, 0.18) 35%, rgba(8, 14, 40, 0.65) 100%), linear-gradient(90deg, rgba(8, 14, 40, 0.35) 0%, transparent 60%);">
            </div>
            <div class="container" style="position: relative; z-index: 2; text-align: left; width: 100%;">
                <h1 class="hero-anim-title"
                    style="font-size: clamp(40px, 5vw, 56px); font-weight: 800; margin-bottom: 16px; letter-spacing: -1px; color: #ffffff; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);">
                    {{ $peluang->hero_judul ?? 'Lelang Lainnya & Peluang Usaha' }}</h1>
                <div class="hero-anim-line"
                    style="width: 70px; height: 5px; background: #ffffff; margin: 0 0 24px; border-radius: 4px;">
                </div>
                <p class="hero-anim-desc"
                    style="font-size: clamp(16px, 1.8vw, 20px); max-width: 720px; line-height: 1.7; color: rgba(255, 255, 255, 0.92); font-weight: 400; text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);">
                    {{ $peluang->hero_deskripsi ?? '' }}
                </p>
            </div>
        </section>

        <!-- 2. Portal Pengadaan BUMN & Internasional (White Background) -->
        <section style="padding: 80px 0; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: left;">
                <div style="text-align: center; max-width: 780px; margin: 0 auto 56px;">
                    <span
                        style="font-size: 13px; font-weight: 700; color: #0B62A2; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 8px;">
                        Portal e-Procurement Resmi
                    </span>
                    <h2
                        style="font-size: clamp(28px, 3vw, 36px); color: var(--royal); font-weight: 700; margin: 0 0 16px;">
                        Lelang Lainnya (BUMN &amp; Multilateral)
                    </h2>
                    <p style="font-size: 16px; line-height: 1.7; color: var(--slate-600); margin: 0;">
                        Pantau langsung paket pengadaan barang dan jasa konsultansi melalui tautan resmi masing-masing
                        pengelola pengadaan berikut:
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
                    @forelse ($portals as $portal)
                        <div class="portal-card">
                            <div>
                                <div class="portal-card__icon-box">
                                    <span class="material-symbols-outlined">{{ $portal->ikon ?: 'public' }}</span>
                                </div>
                                <div class="portal-card__category">{{ $portal->kategori }}</div>
                                <h3 class="portal-card__title">{{ $portal->judul }}</h3>
                                <p class="portal-card__desc">{{ $portal->deskripsi }}</p>
                            </div>
                            <a href="{{ $portal->url }}" target="_blank" rel="noopener noreferrer"
                                class="portal-card__btn">
                                <span>{{ $portal->teks_tombol ?: 'Buka Portal Pengadaan' }}</span>
                                <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
                            </a>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 36px 16px; color: #64748b;">
                            Belum ada portal e-Procurement yang tersedia saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 3. Peluang Usaha Lainnya (Section Berlatar Belakang Biru / Gaya Visi & Misi tentang.html) -->
        <section
            style="position: relative; padding: 90px 0; color: var(--white); background: url('{{ \App\Support\PageBackgroundHelper::get('lelang_peluang_section', 'assets/jakarta4.jpg') }}') center/cover no-repeat fixed;">
            <div style="position: absolute; inset: 0; background: rgba(8, 14, 40, 0.72);"></div>
            <div class="container" style="position: relative; z-index: 2; max-width: 1000px; margin: 0 auto;">

                <div style="text-align: center; margin-bottom: 36px;">
                    <div class="notice-board__badge"
                        style="background: rgba(255,255,255,0.2); color: #ffffff; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 12px;">
                        <span class="material-symbols-outlined">campaign</span>
                        {{ $peluang->section_badge ?? 'Pemberitahuan Resmi Sekretariat DPP' }}
                    </div>
                    <h2
                        style="font-size: clamp(30px, 3.5vw, 40px); font-weight: 800; margin: 0 0 12px; color: #ffffff;">
                        {{ $peluang->section_judul ?? 'Peluang Usaha Lainnya' }}
                    </h2>
                    @if (!empty($peluang->section_deskripsi))
                        <p
                            style="font-size: 16px; color: rgba(255,255,255,0.9); margin: 0; max-width: 650px; margin-left: auto; margin-right: auto;">
                            {{ $peluang->section_deskripsi }}
                        </p>
                    @endif
                </div>

                <!-- Kartu Dokumen Resmi -->
                <div class="notice-board">
                    <div class="notice-board__head">
                        <div>
                            <span
                                style="font-size: 13px; font-weight: 700; color: #0B62A2; text-transform: uppercase; letter-spacing: 0.5px;">{{ $peluang->surat_label ?? 'Surat Pemberitahuan Terbuka' }}</span>
                            <h3 style="font-size: 22px; font-weight: 700; color: var(--slate-900); margin: 4px 0 0;">
                                {{ $peluang->surat_judul ?? '' }}
                            </h3>
                        </div>
                        <div
                            style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b; background: #f1f5f9; padding: 6px 14px; border-radius: 20px;">
                            <span class="material-symbols-outlined"
                                style="font-size: 18px; color: #0B62A2;">event_available</span>
                            Status: {{ $peluang->surat_status ?? 'Terbuka' }}
                        </div>
                    </div>

                    <!-- Isi Surat -->
                    <div style="font-size: 16px; line-height: 1.8; color: var(--slate-700); margin-bottom: 28px;">
                        <p style="margin: 0 0 8px; font-weight: 700; color: var(--slate-900);">Kepada Yth.</p>
                        <p style="margin: 0 0 16px; font-weight: 600; color: var(--royal);">{{ $peluang->surat_kepada ?? 'Seluruh Anggota INKINDO DKI Jakarta' }}</p>
                        <p style="margin: 0 0 16px;">Dengan hormat,</p>
                        <p style="margin: 0 0 20px;">
                            {{ $peluang->surat_pengantar ?? '' }}
                        </p>
                    </div>

                    <!-- Kualifikasi dalam Card Grid -->
                    @if (!empty($peluang->kualifikasi))
                        <div style="display: grid; gap: 14px; margin-bottom: 28px;">
                            @foreach ($peluang->kualifikasi as $idx => $kualifikasiItem)
                                <div class="kualifikasi-card">
                                    <span class="kualifikasi-num">{{ $idx + 1 }}</span>
                                    <p class="kualifikasi-text">{{ $kualifikasiItem }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Penutup Surat -->
                    <div
                        style="font-size: 15px; line-height: 1.8; color: var(--slate-700); margin-bottom: 32px; background: #f8fafc; padding: 20px 24px; border-radius: 10px; border: 1px dashed #cbd5e1;">
                        <p style="margin: 0 0 10px; font-weight: 500;">
                            {{ $peluang->surat_penutup ?? '' }}
                        </p>
                        <p style="margin: 0 0 8px;">
                            Demikian yang dapat kami sampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.
                        </p>
                        <p style="margin: 0; font-weight: 600; color: var(--slate-900);">
                            Terima kasih
                        </p>
                    </div>

                    <!-- Action Box / Kontak Sekretariat -->
                    <div
                        style="display: flex; justify-content: flex-start; align-items: center; flex-wrap: wrap; gap: 20px; padding-top: 10px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div
                                style="width: 46px; height: 46px; border-radius: 50%; background: rgba(11, 98, 162, 0.08); color: #0B62A2; display: grid; place-items: center;">
                                <span class="material-symbols-outlined" style="font-size: 24px;">support_agent</span>
                            </div>
                            <div>
                                <span style="font-size: 13px; color: var(--slate-500); display: block;">Layanan
                                    Anggota</span>
                                <strong style="font-size: 15px; color: var(--slate-900);">{{ $peluang->kontak_telp ?? '+62217942940(H) / +6282112079750' }}</strong>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer" id="kontak">
        <div class="site-footer__container">
            <div class="site-footer__grid">
                <!-- Col 1: Identity & Bio & Social Media -->
                <div class="site-footer__brand">
                    <div class="site-footer__logo">
                        <img alt="Logo INKINDO DKI Jakarta" src="assets/logo-inkindo.png">
                    </div>
                    <p class="site-footer__bio">
                        Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta merupakan wadah asosiasi
                        perusahaan jasa konsultansi independen yang profesional dan berintegritas.
                    </p>
                    <div class="site-footer__social">
                        <a href="https://www.youtube.com/@inkindodkiofficial" target="_blank" rel="noopener noreferrer"
                            class="site-footer__social-link site-footer__social-link--youtube"
                            aria-label="YouTube INKINDO DKI" title="YouTube">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/inkindodki" target="_blank" rel="noopener noreferrer"
                            class="site-footer__social-link site-footer__social-link--facebook"
                            aria-label="Facebook INKINDO DKI" title="Facebook">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="https://x.com/inkindoD" target="_blank" rel="noopener noreferrer"
                            class="site-footer__social-link site-footer__social-link--x"
                            aria-label="X (Twitter) INKINDO DKI" title="X (Twitter)">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/inkindo_dki/" target="_blank" rel="noopener noreferrer"
                            class="site-footer__social-link site-footer__social-link--instagram"
                            aria-label="Instagram INKINDO DKI" title="Instagram">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Col 2: Sekretariat DPP -->
                <div class="site-footer__col site-footer__col--contact">
                    <h4>Sekretariat DPP</h4>
                    <p class="site-footer__address">
                        <span class="material-symbols-outlined site-footer__icon">location_on</span>
                        <span>Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760, DKI Jakarta</span>
                    </p>
                    <div class="site-footer__contact">
                        <div class="site-footer__contact-item">
                            <span class="material-symbols-outlined site-footer__icon">call</span>
                            <span>Telp: <a href="tel:+62217942940" class="site-footer__link">+62217942940</a>(H), <a
                                    href="tel:+6282112079750" class="site-footer__link">+6282112079750</a>, Fax:
                                +62217942941</span>
                        </div>
                        <div class="site-footer__contact-item">
                            <span class="material-symbols-outlined site-footer__icon">mail</span>
                            <span>
                                <a href="mailto:sekretariat@inkindo-dki.org"
                                    class="site-footer__link">sekretariat@inkindo-dki.org</a>
                                <span style="opacity: 0.5; margin: 0 4px;">-</span>
                                <a href="mailto:inkindo_dki@yahoo.com"
                                    class="site-footer__link">inkindo_dki@yahoo.com</a>
                            </span>
                        </div>
                        <div class="site-footer__contact-item site-footer__hours">
                            <span class="material-symbols-outlined site-footer__icon">schedule</span>
                            <span>Senin - Jumat: 08.00 - 16.30 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="site-footer__bottom">
                <p>© 2026 DPP INKINDO DKI Jakarta. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="js/script.js?v=cerah15"></script>
</body>

</html>