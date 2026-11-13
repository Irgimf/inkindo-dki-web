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

    <style>
        .regulasi-page {
            padding: 0;
            min-height: 100vh;
            background: #f8fafc;
        }

        .page-hero {
            position: relative;
            height: 380px;
            display: flex;
            align-items: center;
            padding-top: var(--header-h);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .page-hero__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .page-hero__shade {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(8, 14, 40, 0.45) 0%, rgba(8, 14, 40, 0.18) 35%, rgba(8, 14, 40, 0.65) 100%),
                linear-gradient(90deg, rgba(8, 14, 40, 0.35) 0%, transparent 60%);
            z-index: 2;
        }

        .page-hero__container {
            position: relative;
            z-index: 3;
            text-align: left;
            width: 100%;
        }

        .page-hero__title {
            font-size: 52px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            line-height: 1.2;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .page-hero__subtitle {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.92);
            font-weight: 400;
            line-height: 1.6;
            max-width: 600px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        }

        .regulasi-page-content {
            position: relative;
            z-index: 10;
            padding-bottom: 60px;
            min-height: 50vh;
        }

        .regulasi-top-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .tab-menu {
            display: flex;
            gap: 32px;
        }

        .tab-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            padding: 16px 0;
            cursor: pointer;
            position: relative;
            font-weight: 400;
            transition: 0.3s;
        }

        .tab-btn.is-active {
            color: #0B62A2;
        }

        .tab-btn.is-active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #0B62A2;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 24px;
            padding-bottom: 12px;
        }

        .search-box {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 4px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            padding: 4px 8px;
            font-size: 14px;
            width: 200px;
            color: #334155;
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .search-box span {
            color: #0B62A2;
            font-size: 20px;
            cursor: pointer;
        }

        .filter-box select {
            appearance: none;
            background: transparent;
            border: 1px solid #0B62A2;
            color: #0B62A2;
            padding: 6px 36px 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
            cursor: pointer;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M10%2018h4v-2h-4v2zM3%206v2h18V6H3zm3%207h12v-2H6v2z%22%20fill%3D%22%230A1247%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
        }

        .regulasi-subheader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .regulasi-subheader h2 {
            font-size: 24px;
            font-weight: 400;
            color: #0f172a;
            margin: 0;
        }

        .sub-category-menu {
            display: flex;
            gap: 12px;
            flex: 1;
            margin-left: 24px;
        }

        .sub-tab-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sub-tab-btn:hover {
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            border-color: #0B62A2;
        }

        .sub-tab-btn.is-active {
            background: #0B62A2;
            color: white;
            border-color: #0B62A2;
        }

        .view-toggle {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .view-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
        }

        .view-btn span {
            font-size: 22px;
        }

        .view-btn.is-active {
            color: #0B62A2;
        }

        .regulasi-content {
            display: none;
        }

        .regulasi-content.is-active {
            display: block;
        }

        .view-container.is-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(3, 1fr);
        }

        .view-container.is-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .reg-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
            border-radius: 12px;
            padding: 20px 22px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
            min-height: 135px;
        }

        .reg-card:hover {
            box-shadow: 0 8px 20px -4px rgba(14, 165, 233, 0.12), 0 4px 6px -2px rgba(14, 165, 233, 0.04);
            border-color: #7dd3fc;
            transform: translateY(-2px);
        }

        .reg-card__body {
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .reg-card__title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.45;
            margin: 0 0 12px 0;
            letter-spacing: -0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Description is hidden in grid mode for a clean, minimalist look */
        .reg-card__desc {
            display: none;
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 16px 0;
            flex-grow: 1;
        }

        .reg-card__actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-download-pdf {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 15px;
            background: rgba(11, 98, 162, 0.06);
            color: #0B62A2;
            border: 1px solid rgba(11, 98, 162, 0.2);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            text-decoration: none;
        }

        .btn-download-pdf:hover {
            background: #0B62A2;
            color: #ffffff;
            border-color: #0B62A2;
            box-shadow: 0 3px 8px rgba(11, 98, 162, 0.25);
        }

        .btn-download-pdf .material-symbols-outlined {
            font-size: 18px;
            transition: transform 0.2s ease;
        }

        .btn-download-pdf:hover .material-symbols-outlined {
            transform: translateY(1px);
        }

        /* List View: Reveals description and arranges layout horizontally */
        .view-container.is-list .reg-card {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            padding: 18px 24px;
            min-height: unset;
        }

        .view-container.is-list .reg-card:hover {
            transform: translateY(-1px);
        }

        .view-container.is-list .reg-card__body {
            margin-bottom: 0;
            flex: 1;
        }

        .view-container.is-list .reg-card__title {
            font-size: 16px;
            margin-bottom: 6px;
            -webkit-line-clamp: 1;
        }

        .view-container.is-list .reg-card__desc {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
            line-height: 1.55;
        }

        .view-container.is-list .reg-card__actions {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
            flex-shrink: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 48px;
        }

        .page-item {
            display: grid;
            place-items: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: #334155;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .page-item.is-active {
            background: #0B62A2;
            color: white;
        }

        .page-item:hover:not(.is-active) {
            background: #f1f5f9;
        }

        @media (max-width: 1024px) {
            .view-container.is-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-hero {
                height: 300px;
                margin-bottom: 24px;
            }

            .page-hero__title {
                font-size: 36px;
                margin-bottom: 12px;
            }

            .page-hero__subtitle {
                font-size: 16px;
            }

            .regulasi-page-content {
                padding-bottom: 60px;
            }

            .view-container.is-grid {
                grid-template-columns: 1fr;
            }

            .view-container.is-list .reg-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .view-container.is-list .reg-card__actions {
                width: 100%;
                padding-top: 14px;
                border-top: 1px solid #f1f5f9;
            }

            .view-container.is-list .btn-download-pdf,
            .view-container.is-grid .btn-download-pdf {
                width: 100%;
                justify-content: center;
            }

            .regulasi-top-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-actions {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 12px;
            }

            .tab-menu {
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
                gap: 18px;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding-bottom: 4px;
            }

            .tab-menu::-webkit-scrollbar {
                display: none;
            }

            .tab-btn {
                font-size: 16px;
                padding: 10px 0;
                flex-shrink: 0;
            }

            .search-box {
                width: 100%;
            }

            .search-box input {
                width: 100%;
            }

            .regulasi-subheader {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .sub-category-menu {
                margin-left: 0;
                width: 100%;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 4px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= HEADER (transparan di atas hero, solid saat scroll) ================= -->
    <header class="main-header" id="main-header">
        <div class="container main-header__inner">
            <a href="index.html" class="main-header__logo" id="logo-link" aria-label="Beranda DPP INKINDO DKI Jakarta">
                <img src="assets/logo-inkindo.webp" alt="Logo DPP INKINDO DKI Jakarta">
            </a>

            <nav class="main-nav" id="main-nav" aria-label="Navigasi utama">
                <ul class="main-nav__menu">
                    <li><a href="index.html" class="main-nav__link" id="nav-home">Home</a></li>
                    <li>
                        <a href="tentang.html" class="main-nav__link" id="nav-tentang">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="regulasi.html" class="main-nav__link is-active" id="nav-regulasi">Regulasi</a>
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

    <!-- Panel geser di kiri -->
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

    <main class="regulasi-page">
        <!-- New Hero Section -->
        <section class="page-hero">
            <div class="page-hero__bg" style="background-image: url('{{ \App\Support\PageBackgroundHelper::get('regulasi_hero', 'assets/jakarta.webp') }}');"></div>
            <div class="page-hero__shade"></div>
            <div class="container page-hero__container">
                <h1 class="page-hero__title">Regulasi & Kebijakan</h1>
                <p class="page-hero__subtitle">Temukan semua dokumen regulasi, undang-undang, dan kebijakan terkait
                    secara cepat dan mudah.</p>
            </div>
        </section>

        <div class="container regulasi-page-content">

            <div class="regulasi-top-row">
                <div class="tab-menu" id="reg-tabs">
                    <button type="button" class="tab-btn is-active" data-target="reg-inkindo"
                        data-title="Regulasi INKINDO">Regulasi INKINDO</button>
                    <button type="button" class="tab-btn" data-target="reg-jasa"
                        data-title="Regulasi Jasa Konsultasi">Regulasi Jasa Konsultasi</button>
                    <button type="button" class="tab-btn" data-target="reg-terkait"
                        data-title="Regulasi Terkait">Regulasi Terkait</button>
                </div>

                <div class="top-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Cari Regulasi & Kebijakan" aria-label="Cari Regulasi">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                </div>
            </div>

            <div class="regulasi-subheader">
                <h2 id="active-category-title">Regulasi INKINDO</h2>
                <div class="sub-category-menu" id="sub-menu-jasa-inline" style="display: none;">
                    <button type="button" class="sub-tab-btn is-active" data-filter="all">Semua</button>
                    <button type="button" class="sub-tab-btn" data-filter="kontruksi">Konstruksi</button>
                    <button type="button" class="sub-tab-btn" data-filter="non-kontruksi">Non Konstruksi</button>
                    <button type="button" class="sub-tab-btn" data-filter="umum">Umum</button>
                </div>
                <div class="view-toggle">
                    <button type="button" class="view-btn is-active" data-view="grid" aria-label="Grid View">
                        Grid <span class="material-symbols-outlined">grid_view</span>
                    </button>
                    <button type="button" class="view-btn" data-view="list" aria-label="List View">
                        List <span class="material-symbols-outlined">format_list_bulleted</span>
                    </button>
                </div>
            </div>

            @php
                $regInkindo = $regulasiByKategori['inkindo'] ?? [];
                $regJasa    = $regulasiByKategori['jasa'] ?? [];
                $regTerkait = $regulasiByKategori['terkait'] ?? [];
            @endphp

            <!-- Regulasi INKINDO -->
            <div class="regulasi-content is-active" id="reg-inkindo">
                <div class="view-container is-grid">
                    @foreach ($regInkindo as $item)
                        <div class="reg-card">
                            <div class="reg-card__body">
                                <h3 class="reg-card__title">{{ $item->judul }}</h3>
                                <p class="reg-card__desc">{{ $item->deskripsi }}</p>
                            </div>
                            <div class="reg-card__actions">
                                @if (!empty($item->file_pdf))
                                    <a href="{{ '/' . ltrim((string) $item->file_pdf, '/') }}" target="_blank"
                                        rel="noopener noreferrer" class="btn-download-pdf" aria-label="Unduh PDF">
                                        <span class="material-symbols-outlined">download</span>
                                        <span>Unduh PDF</span>
                                    </a>
                                @else
                                    <button type="button" class="btn-download-pdf" disabled
                                        style="opacity: 0.55; cursor: not-allowed;" title="File PDF belum tersedia">
                                        <span class="material-symbols-outlined">description</span>
                                        <span>PDF Belum Tersedia</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Regulasi Jasa Konsultasi -->
            <div class="regulasi-content" id="reg-jasa">
                <div class="view-container is-grid" id="container-jasa">
                    @foreach ($regJasa as $item)
                        <div class="reg-card" data-category="{{ $item->sub_kategori ?: 'umum' }}">
                            <div class="reg-card__body">
                                <h3 class="reg-card__title">{{ $item->judul }}</h3>
                                <p class="reg-card__desc">{{ $item->deskripsi }}</p>
                            </div>
                            <div class="reg-card__actions">
                                @if (!empty($item->file_pdf))
                                    <a href="{{ '/' . ltrim((string) $item->file_pdf, '/') }}" target="_blank"
                                        rel="noopener noreferrer" class="btn-download-pdf" aria-label="Unduh PDF">
                                        <span class="material-symbols-outlined">download</span>
                                        <span>Unduh PDF</span>
                                    </a>
                                @else
                                    <button type="button" class="btn-download-pdf" disabled
                                        style="opacity: 0.55; cursor: not-allowed;" title="File PDF belum tersedia">
                                        <span class="material-symbols-outlined">description</span>
                                        <span>PDF Belum Tersedia</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Regulasi Terkait -->
            <div class="regulasi-content" id="reg-terkait">
                <div class="view-container is-grid">
                    @foreach ($regTerkait as $item)
                        <div class="reg-card">
                            <div class="reg-card__body">
                                <h3 class="reg-card__title">{{ $item->judul }}</h3>
                                <p class="reg-card__desc">{{ $item->deskripsi }}</p>
                            </div>
                            <div class="reg-card__actions">
                                @if (!empty($item->file_pdf))
                                    <a href="{{ '/' . ltrim((string) $item->file_pdf, '/') }}" target="_blank"
                                        rel="noopener noreferrer" class="btn-download-pdf" aria-label="Unduh PDF">
                                        <span class="material-symbols-outlined">download</span>
                                        <span>Unduh PDF</span>
                                    </a>
                                @else
                                    <button type="button" class="btn-download-pdf" disabled
                                        style="opacity: 0.55; cursor: not-allowed;" title="File PDF belum tersedia">
                                        <span class="material-symbols-outlined">description</span>
                                        <span>PDF Belum Tersedia</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="reg-empty-state"
                style="display: none; text-align: center; padding: 40px 16px; color: #64748b; font-size: 0.95rem;">
                Belum ada dokumen regulasi pada kategori ini.
            </div>

            <!-- Pagination (Dynamic max 6 items/page) -->
            <div class="pagination" id="regulasi-pagination"></div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const PER_PAGE = 6;
            let currentPage = 1;
            let currentSubFilter = 'all';

            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.regulasi-content');
            const subMenuInline = document.getElementById('sub-menu-jasa-inline');
            const activeCategoryTitle = document.getElementById('active-category-title');
            const viewBtns = document.querySelectorAll('.view-btn');
            const viewContainers = document.querySelectorAll('.view-container');
            const subTabBtns = document.querySelectorAll('.sub-tab-btn');
            const searchInput = document.querySelector('.search-box input');
            const paginationEl = document.getElementById('regulasi-pagination');
            const emptyStateEl = document.getElementById('reg-empty-state');

            function renderPagination(totalPages) {
                if (!paginationEl) return;
                if (totalPages <= 1) {
                    paginationEl.innerHTML = '';
                    paginationEl.style.display = 'none';
                    return;
                }

                paginationEl.style.display = '';
                let html = '';

                html += `<a href="#" class="page-item ${currentPage === 1 ? 'is-disabled' : ''}" data-page="${currentPage - 1}" aria-label="Halaman sebelumnya"><span class="material-symbols-outlined" style="font-size:18px">chevron_left</span></a>`;

                const pages = [];
                if (totalPages <= 7) {
                    for (let i = 1; i <= totalPages; i++) pages.push(i);
                } else {
                    pages.push(1);
                    if (currentPage > 3) pages.push('...');
                    const start = Math.max(2, currentPage - 1);
                    const end = Math.min(totalPages - 1, currentPage + 1);
                    for (let i = start; i <= end; i++) pages.push(i);
                    if (currentPage < totalPages - 2) pages.push('...');
                    pages.push(totalPages);
                }

                pages.forEach(p => {
                    if (p === '...') {
                        html += '<span class="page-item" style="cursor:default">...</span>';
                    } else {
                        html += `<a href="#" class="page-item ${p === currentPage ? 'is-active' : ''}" data-page="${p}">${p}</a>`;
                    }
                });

                html += `<a href="#" class="page-item ${currentPage === totalPages ? 'is-disabled' : ''}" data-page="${currentPage + 1}" aria-label="Halaman berikutnya"><span class="material-symbols-outlined" style="font-size:18px">chevron_right</span></a>`;

                paginationEl.innerHTML = html;

                paginationEl.querySelectorAll('a.page-item[data-page]').forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const targetPage = parseInt(link.getAttribute('data-page'), 10);
                        if (Number.isNaN(targetPage) || targetPage < 1 || targetPage > totalPages || targetPage === currentPage) {
                            return;
                        }
                        currentPage = targetPage;
                        renderRegulasi();
                        const navWrapper = document.querySelector('.regulasi-nav-wrapper');
                        if (navWrapper) {
                            navWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                });
            }

            function renderRegulasi() {
                const activeContent = document.querySelector('.regulasi-content.is-active');
                if (!activeContent) return;

                const isJasaTab = activeContent.id === 'reg-jasa';
                const query = String(searchInput ? searchInput.value : '').toLowerCase().trim();
                const allCards = Array.from(activeContent.querySelectorAll('.reg-card'));

                const matchedCards = allCards.filter(card => {
                    const cardCat = card.getAttribute('data-category') || '';
                    if (isJasaTab && currentSubFilter !== 'all' && cardCat !== currentSubFilter) {
                        return false;
                    }
                    if (query) {
                        const title = card.querySelector('.reg-card__title')?.textContent.toLowerCase() || '';
                        const desc = card.querySelector('.reg-card__desc')?.textContent.toLowerCase() || '';
                        if (!title.includes(query) && !desc.includes(query)) {
                            return false;
                        }
                    }
                    return true;
                });

                const totalPages = Math.max(1, Math.ceil(matchedCards.length / PER_PAGE));
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIdx = (currentPage - 1) * PER_PAGE;
                const endIdx = startIdx + PER_PAGE;
                const visibleSet = new Set(matchedCards.slice(startIdx, endIdx));

                allCards.forEach(card => {
                    card.style.display = visibleSet.has(card) ? '' : 'none';
                });

                if (emptyStateEl) {
                    emptyStateEl.style.display = matchedCards.length === 0 ? 'block' : 'none';
                }

                renderPagination(matchedCards.length === 0 ? 0 : totalPages);
            }

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabBtns.forEach(b => b.classList.remove('is-active'));
                    tabContents.forEach(c => c.classList.remove('is-active'));

                    btn.classList.add('is-active');
                    const targetId = btn.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) targetContent.classList.add('is-active');

                    if (activeCategoryTitle) {
                        activeCategoryTitle.textContent = btn.getAttribute('data-title') || '';
                    }

                    if (subMenuInline) {
                        subMenuInline.style.display = targetId === 'reg-jasa' ? 'flex' : 'none';
                    }

                    currentPage = 1;
                    renderRegulasi();
                });
            });

            viewBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    viewBtns.forEach(b => b.classList.remove('is-active'));
                    btn.classList.add('is-active');

                    const viewType = btn.getAttribute('data-view');
                    viewContainers.forEach(container => {
                        if (viewType === 'list') {
                            container.classList.remove('is-grid');
                            container.classList.add('is-list');
                        } else {
                            container.classList.remove('is-list');
                            container.classList.add('is-grid');
                        }
                    });
                });
            });

            subTabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    subTabBtns.forEach(b => b.classList.remove('is-active'));
                    btn.classList.add('is-active');
                    currentSubFilter = btn.getAttribute('data-filter') || 'all';
                    currentPage = 1;
                    renderRegulasi();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    currentPage = 1;
                    renderRegulasi();
                });
            }

            // Deep-link dari Pencarian Global (?tab=...&q=...)
            const urlParams = new URLSearchParams(window.location.search);
            const targetTab = urlParams.get('tab');
            const targetQuery = urlParams.get('q');
            if (targetTab) {
                const matchingBtn = document.querySelector(`.tab-btn[data-target="${targetTab}"]`);
                if (matchingBtn) matchingBtn.click();
            }
            if (targetQuery && searchInput) {
                searchInput.value = targetQuery;
                currentPage = 1;
                const navWrapper = document.querySelector('.regulasi-nav-wrapper');
                if (navWrapper) {
                    setTimeout(() => navWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' }), 150);
                }
            }

            renderRegulasi();
        });
    </script>

    <!-- ================= FOOTER ================= -->
@include('partials.footer')

    <script src="js/script.js?v=cerah15"></script>
</body>

</html>