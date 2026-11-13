<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian – DPP INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Halaman hasil pencarian resmi untuk Berita & Informasi serta Mitra Kerja DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>
        .search-page {
            padding: 0;
            min-height: 100vh;
            background: #f8fafc;
        }

        .search-page-header {
            padding: calc(var(--header-h) + 36px) 0 28px;
            background: linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 32px;
        }

        .search-page-header__breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13.5px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .search-page-header__breadcrumb a {
            color: #0B62A2;
            text-decoration: none;
            font-weight: 600;
        }

        .search-page-header__breadcrumb a:hover {
            text-decoration: underline;
        }

        .search-page-header__title {
            font-size: clamp(28px, 3.6vw, 40px);
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 8px;
            line-height: 1.25;
            letter-spacing: -0.5px;
        }

        .search-page-header__subtitle {
            font-size: 15.5px;
            color: #475569;
            font-weight: 400;
            line-height: 1.6;
            max-width: 760px;
            margin: 0;
        }

        .search-page-content {
            position: relative;
            z-index: 10;
            padding-bottom: 80px;
            min-height: 50vh;
        }

        /* Search Control Box */
        .search-control-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 28px rgba(15, 23, 42, 0.05);
            padding: 24px 28px;
            margin-bottom: 28px;
        }

        .search-bar-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
            min-width: 240px;
        }

        .search-input-wrap .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 21px;
            color: #0B62A2;
            pointer-events: none;
        }

        .search-main-input {
            width: 100%;
            height: 48px;
            padding: 10px 44px 10px 48px;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 500;
            color: #0f172a;
            background: #f8fafc;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .search-main-input:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11, 98, 162, 0.14);
        }

        .search-clear-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: #64748b;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .search-clear-btn.is-visible {
            display: inline-flex;
        }

        .search-clear-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .search-submit-btn {
            height: 48px;
            padding: 0 24px;
            border-radius: 12px;
            background: #0B62A2;
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
            white-space: nowrap;
        }

        .search-submit-btn:hover {
            background: #0077C8;
            transform: translateY(-1px);
        }

        /* Tabs & Type Filter Row */
        .search-filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
        }

        .source-tabs {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .source-tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 99px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .source-tab-btn:hover {
            border-color: #cbd5e1;
            color: #0f172a;
            background: #f1f5f9;
        }

        .source-tab-btn.is-active {
            background: #0B62A2;
            border-color: #0B62A2;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(11, 98, 162, 0.22);
        }

        .source-tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 20px;
            padding: 0 6px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 700;
            background: rgba(15, 23, 42, 0.08);
            color: inherit;
        }

        .source-tab-btn.is-active .source-tab-count {
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .sub-type-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sub-type-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .sub-type-select {
            height: 38px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #1e293b;
            font-size: 13px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
        }

        .sub-type-select:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
        }

        /* Status Info & View Switcher Row */
        .search-status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .search-summary-text {
            font-size: 15px;
            color: #334155;
            margin: 0;
        }

        .search-summary-text strong {
            color: #0B62A2;
            font-weight: 700;
        }

        .search-status-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .sort-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 99px;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 12.5px;
            font-weight: 600;
        }

        .sort-badge .material-symbols-outlined {
            font-size: 16px;
        }

        .view-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .view-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            background: none;
            border: none;
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            transition: 0.2s;
        }

        .view-btn .material-symbols-outlined {
            font-size: 20px;
        }

        .view-btn.is-active,
        .view-btn:hover {
            color: #0B62A2;
        }

        /* Results Grid & Cards (Consistent with berita.html) */
        .view-container.is-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .view-container.is-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .reg-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
            display: flex;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .reg-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(11, 98, 162, 0.12);
            border-color: #cbd5e1;
        }

        .view-container.is-grid .reg-card {
            flex-direction: column;
            height: 365px;
        }

        .reg-card__img {
            position: relative;
            background-color: #e2e8f0;
            overflow: hidden;
            flex-shrink: 0;
        }

        .view-container.is-grid .reg-card__img {
            width: 100%;
            height: 165px;
        }

        .reg-card__thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform 0.5s ease;
        }

        .reg-card:hover .reg-card__thumb {
            transform: scale(1.06);
        }

        /* Khusus Kartu Mitra Kerja */
        .reg-card--mitra .reg-card__img {
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .reg-card--mitra .reg-card__thumb {
            max-width: 78%;
            max-height: 95px;
            width: auto;
            height: auto;
            object-fit: contain;
            mix-blend-mode: multiply;
        }

        /* Khusus Kartu Regulasi & Anggota Terdaftar (Tanpa Gambar Foto) */
        .reg-card--regulasi .reg-card__img {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #fde68a;
        }

        .reg-card--anggota .reg-card__img {
            background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #c7d2fe;
        }

        .reg-card__icon-illustration {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s ease;
        }

        .reg-card:hover .reg-card__icon-illustration {
            transform: scale(1.08);
        }

        .reg-card--regulasi .reg-card__icon-illustration {
            color: #b45309;
        }

        .reg-card--anggota .reg-card__icon-illustration {
            color: #4338ca;
        }

        .reg-card__icon-illustration .material-symbols-outlined {
            font-size: 34px;
        }

        .reg-card__badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(4px);
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .reg-card__badge--mitra {
            background: #15803d;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .reg-card__badge--regulasi {
            background: #b45309;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .reg-card__badge--anggota {
            background: #4338ca;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .reg-card__body {
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
            background: #ffffff;
            min-width: 0;
        }

        .reg-card__top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .reg-card__date {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
            white-space: nowrap;
        }

        .reg-card__date span {
            font-size: 15px;
            color: #0B62A2;
        }

        .reg-card__cat-pill {
            font-size: 11px;
            font-weight: 600;
            color: #0B62A2;
            background: rgba(11, 98, 162, 0.08);
            padding: 3px 9px;
            border-radius: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 145px;
        }

        .reg-card__cat-pill--mitra {
            background: #dcfce7;
            color: #15803d;
        }

        .reg-card__cat-pill--regulasi {
            background: #fef3c7;
            color: #b45309;
        }

        .reg-card__cat-pill--anggota {
            background: #e0e7ff;
            color: #4338ca;
        }

        .reg-card__title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.4;
            margin: 0 0 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s;
        }

        .reg-card:hover .reg-card__title {
            color: #0B62A2;
        }

        .reg-card__desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.55;
            margin: 0 0 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .reg-card__footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
            gap: 8px;
        }

        .reg-card__meta-tag {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 190px;
        }

        .reg-card__meta-tag span {
            font-size: 15px;
            color: #64748b;
        }

        .reg-card__cta {
            font-size: 12.5px;
            font-weight: 700;
            color: #0B62A2;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .reg-card__cta .material-symbols-outlined {
            font-size: 16px;
            transition: transform 0.2s ease;
        }

        .reg-card:hover .reg-card__cta .material-symbols-outlined {
            transform: translateX(3px);
        }

        /* List View Adjustments */
        .view-container.is-list .reg-card {
            height: auto;
            min-height: 145px;
        }

        .view-container.is-list .reg-card__img {
            width: 240px;
            height: auto;
            align-self: stretch;
        }

        .view-container.is-list .reg-card__body {
            width: calc(100% - 240px);
            padding: 20px 24px;
        }

        .view-container.is-list .reg-card__cat-pill,
        .view-container.is-list .reg-card__meta-tag {
            max-width: none;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 44px;
        }

        .page-item {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: #334155;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .page-item.is-active {
            background: #0B62A2;
            border-color: #0B62A2;
            color: #ffffff;
            font-weight: 600;
        }

        .page-item:hover:not(.is-active):not(.is-disabled) {
            background: #f1f5f9;
        }

        .page-item.is-disabled {
            opacity: 0.35;
            cursor: default;
            pointer-events: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 64px 24px;
            background: #ffffff;
            border-radius: 16px;
            border: 1px dashed #cbd5e1;
            display: none;
        }

        .empty-state.is-visible {
            display: block;
        }

        .empty-state .material-symbols-outlined {
            font-size: 52px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            font-size: 19px;
            color: #1e293b;
            margin: 0 0 8px;
        }

        .empty-state p {
            color: #64748b;
            font-size: 14.5px;
            margin: 0;
        }

        @media (max-width: 1024px) {
            .view-container.is-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .view-container.is-grid {
                grid-template-columns: 1fr;
            }

            .view-container.is-list .reg-card {
                flex-direction: column;
            }

            .view-container.is-list .reg-card__img {
                width: 100%;
                height: 165px;
            }

            .view-container.is-list .reg-card__body {
                width: 100%;
            }

            .search-control-card {
                padding: 18px;
            }

            .search-submit-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body class="is-scrolled">

    <!-- ================= HEADER ================= -->
    <header class="main-header is-scrolled" id="main-header" data-solid-header="true">
        <div class="container main-header__inner">
            <a href="index.html" class="main-header__logo" id="logo-link" aria-label="Beranda DPP INKINDO DKI Jakarta">
                <img src="assets/logo-inkindo.png" alt="Logo DPP INKINDO DKI Jakarta">
            </a>

            <nav class="main-nav" id="main-nav" aria-label="Navigasi utama">
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

    <!-- ================= SIDE NAV KANAN ================= -->
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

    <!-- Panel geser -->
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
            <div class="partner-grid" style="margin-top: 12px; grid-template-columns: repeat(3, 1fr);"></div>
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
    <main class="search-page">
        <!-- Header Halaman Pencarian (Tanpa Gambar Background) -->
        <div class="search-page-header">
            <div class="container">
                <div class="search-page-header__breadcrumb">
                    <a href="index.html">Beranda</a>
                    <span class="material-symbols-outlined" style="font-size: 16px;">chevron_right</span>
                    <span>Hasil Pencarian</span>
                </div>
                <h1 class="search-page-header__title">Hasil Pencarian</h1>
                <p class="search-page-header__subtitle">
                    Temukan Berita &amp; Informasi, Mitra Kerja, serta dokumen Regulasi DPP INKINDO DKI Jakarta.
                </p>
            </div>
        </div>

        <div class="container search-page-content">
            <!-- Search Control Card -->
            <div class="search-control-card">
                <form id="page-search-form" class="search-bar-row">
                    <div class="search-input-wrap">
                        <span class="material-symbols-outlined search-icon">search</span>
                        <input type="text" id="page-search-input" class="search-main-input"
                            placeholder="Ketik kata kunci berita, mitra kerja, atau regulasi..."
                            autocomplete="off">
                        <button type="button" id="page-search-clear" class="search-clear-btn" title="Bersihkan">
                            <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                        </button>
                    </div>
                    <button type="submit" class="search-submit-btn">
                        <span class="material-symbols-outlined" style="font-size: 20px;">search</span>
                        Cari Sekarang
                    </button>
                </form>

                <div class="search-filter-bar">
                    <div class="source-tabs" role="tablist">
                        <button type="button" class="source-tab-btn is-active" data-source="all">
                            Semua Hasil
                            <span class="source-tab-count" id="count-all">0</span>
                        </button>
                        <button type="button" class="source-tab-btn" data-source="berita">
                            Berita &amp; Informasi
                            <span class="source-tab-count" id="count-berita">0</span>
                        </button>
                        <button type="button" class="source-tab-btn" data-source="mitra">
                            Mitra Kerja
                            <span class="source-tab-count" id="count-mitra">0</span>
                        </button>
                        <button type="button" class="source-tab-btn" data-source="regulasi">
                            Regulasi
                            <span class="source-tab-count" id="count-regulasi">0</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Status Summary -->
            <div class="search-status-row">
                <p class="search-summary-text" id="search-summary-text">
                    Memuat data pencarian...
                </p>
            </div>

            <!-- Results Container (Otomatis Selalu List) -->
            <div id="search-results-container" class="view-container is-list"></div>

            <!-- Empty State -->
            <div class="empty-state" id="search-empty-state">
                <span class="material-symbols-outlined">search_off</span>
                <h3 id="empty-state-title">Tidak Ada Hasil Pencarian yang Sesuai</h3>
                <p id="empty-state-desc">Silakan gunakan kata kunci lain atau pilih kategori Semua Hasil.</p>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="search-pagination" style="display: none;"></div>
        </div>
    </main>

    @include('partials.footer')

    <script src="js/script.js?v=cerah15"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const pageSearchForm = document.getElementById('page-search-form');
            const pageSearchInput = document.getElementById('page-search-input');
            const pageSearchClear = document.getElementById('page-search-clear');
            const sourceTabBtns = document.querySelectorAll('.source-tab-btn');
            const resultsContainer = document.getElementById('search-results-container');
            const emptyState = document.getElementById('search-empty-state');
            const summaryText = document.getElementById('search-summary-text');
            const paginationEl = document.getElementById('search-pagination');

            const countAllEl = document.getElementById('count-all');
            const countBeritaEl = document.getElementById('count-berita');
            const countMitraEl = document.getElementById('count-mitra');
            const countRegulasiEl = document.getElementById('count-regulasi');

            const ITEMS_PER_PAGE = 9;
            let currentPage = 1;
            let activeSource = 'all';
            let allSearchItems = [];

            const params = new URLSearchParams(window.location.search);
            const initialQuery = params.get('q') || '';
            pageSearchInput.value = initialQuery;
            pageSearchClear.classList.toggle('is-visible', initialQuery.trim().length > 0);

            if (window.InkindoSearchEngine) {
                allSearchItems = await window.InkindoSearchEngine.loadAllItems();
            }

            const esc = (s) => window.InkindoSearchEngine ? window.InkindoSearchEngine.escapeHtml(s) : String(s ?? '');
            const hi = (s, q) => window.InkindoSearchEngine ? window.InkindoSearchEngine.highlight(s, q) : esc(s);

            function updateTabCounts(query) {
                if (!window.InkindoSearchEngine) return;
                const matchedAll = window.InkindoSearchEngine.filterAndSort(allSearchItems, query, 'all', 'all');
                const matchedBerita = matchedAll.filter(i => i.source === 'berita');
                const matchedMitra = matchedAll.filter(i => i.source === 'mitra');
                const matchedRegulasi = matchedAll.filter(i => i.source === 'regulasi');

                countAllEl.textContent = matchedAll.length;
                countBeritaEl.textContent = matchedBerita.length;
                countMitraEl.textContent = matchedMitra.length;
                if (countRegulasiEl) countRegulasiEl.textContent = matchedRegulasi.length;
            }

            function renderPagination(page, totalPages, totalItems) {
                if (!paginationEl) return;
                if (totalItems <= ITEMS_PER_PAGE) {
                    paginationEl.style.display = 'none';
                    paginationEl.innerHTML = '';
                    return;
                }

                paginationEl.style.display = 'flex';
                let html = '';
                const prevDisabled = page <= 1 ? ' is-disabled' : '';
                html += `<a href="#" class="page-item${prevDisabled}" data-page="${page - 1}" aria-label="Sebelumnya"><span class="material-symbols-outlined" style="font-size:18px">chevron_left</span></a>`;

                for (let i = 1; i <= totalPages; i++) {
                    const activeCls = i === page ? ' is-active' : '';
                    html += `<a href="#" class="page-item${activeCls}" data-page="${i}">${i}</a>`;
                }

                const nextDisabled = page >= totalPages ? ' is-disabled' : '';
                html += `<a href="#" class="page-item${nextDisabled}" data-page="${page + 1}" aria-label="Berikutnya"><span class="material-symbols-outlined" style="font-size:18px">chevron_right</span></a>`;
                paginationEl.innerHTML = html;
            }

            function renderResults() {
                if (!window.InkindoSearchEngine) return;
                const q = pageSearchInput.value.trim();
                pageSearchClear.classList.toggle('is-visible', q.length > 0);

                // Sinkronkan URL ?q= tanpa reload
                const url = new URL(window.location.href);
                if (q) url.searchParams.set('q', q);
                else url.searchParams.delete('q');
                window.history.replaceState({}, '', url.toString());

                updateTabCounts(q);

                const matched = window.InkindoSearchEngine.filterAndSort(allSearchItems, q, activeSource, 'all');
                const totalMatched = matched.length;
                const totalPages = Math.max(1, Math.ceil(totalMatched / ITEMS_PER_PAGE));
                if (currentPage > totalPages) currentPage = 1;

                const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
                const pageItems = matched.slice(startIdx, startIdx + ITEMS_PER_PAGE);
                const shownCount = pageItems.length;

                if (q) {
                    summaryText.innerHTML = `Menampilkan <strong>${shownCount}</strong> dari <strong>${totalMatched}</strong> pencarian yang sesuai untuk kata kunci <strong>"${esc(q)}"</strong>`;
                } else {
                    summaryText.innerHTML = `Menampilkan <strong>${shownCount}</strong> dari <strong>${totalMatched}</strong> konten terbaru di Portal Resmi DPP INKINDO DKI Jakarta`;
                }

                if (totalMatched === 0) {
                    resultsContainer.innerHTML = '';
                    emptyState.classList.add('is-visible');
                    renderPagination(1, 1, 0);
                    return;
                }

                emptyState.classList.remove('is-visible');

                resultsContainer.innerHTML = pageItems.map((item) => {
                    let cardClass = 'reg-card';
                    let badgeClass = 'reg-card__badge';
                    let badgeContent = esc(item.badge || item.tipeLabel);
                    let pillClass = 'reg-card__cat-pill';
                    let pillText = item.tipeLabel || 'Berita & Informasi';
                    let dateIcon = 'calendar_today';
                    let metaIcon = 'info';
                    let ctaText = 'Baca Selengkapnya';
                    let mediaContent = `<img class="reg-card__thumb" src="${esc(item.gambar)}" alt="${esc(item.judul)}">`;

                    if (item.source === 'mitra') {
                        cardClass = 'reg-card reg-card--mitra';
                        badgeClass = 'reg-card__badge reg-card__badge--mitra';
                        badgeContent = '<span class="material-symbols-outlined" style="font-size:13px">verified</span> Mitra Kerja Resmi';
                        pillClass = 'reg-card__cat-pill reg-card__cat-pill--mitra';
                        pillText = 'Mitra Kerja';
                        dateIcon = 'handshake';
                        metaIcon = 'domain';
                        ctaText = 'Kunjungi Halaman Mitra';
                    } else if (item.source === 'regulasi') {
                        cardClass = 'reg-card reg-card--regulasi';
                        badgeClass = 'reg-card__badge reg-card__badge--regulasi';
                        badgeContent = '<span class="material-symbols-outlined" style="font-size:13px">gavel</span> ' + esc(item.badge || 'Dokumen Regulasi');
                        pillClass = 'reg-card__cat-pill reg-card__cat-pill--regulasi';
                        pillText = item.kategoriLabel || 'Regulasi';
                        dateIcon = 'description';
                        metaIcon = 'menu_book';
                        ctaText = 'Buka Regulasi';
                        mediaContent = `<div class="reg-card__icon-illustration"><span class="material-symbols-outlined">gavel</span></div>`;
                    }

                    return `
                        <a href="${esc(item.targetUrl)}" class="${cardClass}">
                            <div class="reg-card__img">
                                ${mediaContent}
                                <span class="${badgeClass}">${badgeContent}</span>
                            </div>
                            <div class="reg-card__body">
                                <div>
                                    <div class="reg-card__top">
                                        <div class="reg-card__date">
                                            <span class="material-symbols-outlined">${dateIcon}</span>
                                            ${esc(item.tanggalLabel)}
                                        </div>
                                        <span class="${pillClass}">${esc(pillText)}</span>
                                    </div>
                                    <h3 class="reg-card__title">${hi(item.judul, q)}</h3>
                                    <p class="reg-card__desc">${hi(item.ringkasan, q)}</p>
                                </div>
                                <div class="reg-card__footer">
                                    <span class="reg-card__meta-tag">
                                        <span class="material-symbols-outlined">${metaIcon}</span>
                                        ${esc(item.metaInfo)}
                                    </span>
                                    <span class="reg-card__cta">
                                        ${ctaText}
                                        <span class="material-symbols-outlined">arrow_forward</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    `;
                }).join('');

                renderPagination(currentPage, totalPages, totalMatched);
            }

            pageSearchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                currentPage = 1;
                renderResults();
            });

            pageSearchInput.addEventListener('input', () => {
                currentPage = 1;
                renderResults();
            });

            pageSearchClear.addEventListener('click', () => {
                pageSearchInput.value = '';
                currentPage = 1;
                renderResults();
                pageSearchInput.focus();
            });

            sourceTabBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    sourceTabBtns.forEach(b => b.classList.remove('is-active'));
                    btn.classList.add('is-active');
                    activeSource = btn.getAttribute('data-source') || 'all';
                    currentPage = 1;
                    renderResults();
                });
            });

            paginationEl.addEventListener('click', (e) => {
                const btn = e.target.closest('.page-item[data-page]');
                if (!btn || btn.classList.contains('is-disabled') || btn.classList.contains('is-active')) return;
                e.preventDefault();
                const targetPage = parseInt(btn.getAttribute('data-page'), 10);
                if (!Number.isNaN(targetPage) && targetPage >= 1) {
                    currentPage = targetPage;
                    renderResults();
                    document.querySelector('.search-control-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            renderResults();
        });
    </script>
</body>

</html>

