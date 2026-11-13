<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Direktori resmi badan usaha jasa konsultansi yang terdaftar dan terverifikasi sebagai anggota aktif DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>
        /* Animasi Hero Persis tentang.html */
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-top: -60px;
            position: relative;
            z-index: 10;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12);
            border-color: #cbd5e1;
        }

        .stat-card__icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .stat-card__icon--blue {
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
        }

        .stat-card__icon--amber {
            background: #fffbeb;
            color: #d97706;
        }

        .stat-card__icon--emerald {
            background: #ecfdf5;
            color: #059669;
        }

        .stat-card__icon--indigo {
            background: #eef2ff;
            color: #4f46e5;
        }

        .stat-card__number {
            font-size: 26px;
            font-weight: 800;
            color: var(--slate-900);
            line-height: 1.2;
            margin: 0;
        }

        .stat-card__label {
            font-size: 13px;
            color: var(--slate-600);
            margin: 4px 0 0;
            font-weight: 500;
        }

        /* Filter & Search Box */
        .directory-filter-box {
            background: var(--white);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 32px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1.7fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: flex-end;
        }

        @media (max-width: 991px) {
            .filter-row {
                grid-template-columns: 1fr;
            }
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--slate-700);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-input-wrap {
            position: relative;
        }

        .filter-input-wrap span {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
            font-size: 20px;
            pointer-events: none;
        }

        .filter-input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: var(--slate-800);
            font-family: inherit;
            background: #f8fafc;
            transition: all 0.2s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11, 98, 162, 0.15);
        }

        .filter-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            color: var(--slate-800);
            font-family: inherit;
            background: #f8fafc;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .filter-select:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11, 98, 162, 0.15);
        }

        .btn-reset-filter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 20px;
            background: #f1f5f9;
            color: var(--slate-700);
            border: 1px solid #cbd5e1;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 36px;
            white-space: nowrap;
        }

        .btn-reset-filter:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fca5a5;
        }

        /* Bottom Project Filter & Reset Row */
        .filter-pills {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
        }

        .filter-pills-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--slate-600);
            white-space: nowrap;
        }

        .filter-price-range {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            flex-wrap: wrap;
        }

        .project-search-group {
            position: relative;
            display: inline-flex;
            align-items: center;
            flex: 1;
            min-width: 200px;
        }

        .project-search-icon {
            position: absolute;
            left: 12px;
            font-size: 16px;
            color: var(--slate-400);
            pointer-events: none;
        }

        .project-search-input {
            width: 100%;
            height: 36px;
            padding: 6px 14px 6px 34px;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--slate-800);
            font-family: inherit;
            background: #f8fafc;
            transition: all 0.2s ease;
        }

        .project-search-input:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11, 98, 162, 0.12);
        }

        .price-input-group {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .price-prefix {
            position: absolute;
            left: 12px;
            font-size: 12px;
            font-weight: 700;
            color: var(--slate-500);
            pointer-events: none;
        }

        .price-range-input {
            width: 190px;
            height: 36px;
            padding: 6px 12px 6px 34px;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--slate-800);
            font-family: inherit;
            background: #f8fafc;
            transition: all 0.2s ease;
        }

        .price-range-input:focus {
            outline: none;
            border-color: #0B62A2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(11, 98, 162, 0.12);
        }

        .filter-inline-divider {
            width: 1px;
            height: 22px;
            background: #e2e8f0;
            margin: 0 6px;
        }

        @media (max-width: 991px) {
            .filter-inline-divider {
                display: none;
            }
            .project-search-group,
            .price-input-group,
            .price-range-input,
            .btn-reset-filter {
                width: 100%;
            }
        }

        .price-separator {
            color: var(--slate-400);
            font-weight: 700;
            font-size: 14px;
        }

        /* Directory Table Card */
        .directory-table-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .directory-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 28px;
            border-bottom: 1px solid #f1f5f9;
            background: #fafbfd;
            flex-wrap: wrap;
            gap: 12px;
        }

        .directory-table-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--slate-900);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .record-counter {
            font-size: 14px;
            color: var(--slate-600);
            font-weight: 500;
        }

        .record-counter strong {
            color: var(--royal, #0B62A2);
            font-weight: 700;
        }

        /* Table Design */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .directory-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        .directory-table th {
            background: #f8fafc;
            color: var(--slate-700);
            font-weight: 700;
            padding: 16px 20px;
            border-bottom: 2px solid #e2e8f0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .directory-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--slate-800);
            vertical-align: middle;
            transition: background 0.15s ease;
        }

        .directory-table tbody tr:hover td {
            background: #f8fafc;
        }

        .company-name-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--slate-900);
            cursor: pointer;
            transition: color 0.2s;
            display: inline-block;
        }

        .company-name-text:hover {
            color: #0B62A2;
            text-decoration: underline;
        }

        .npa-cell {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: var(--slate-600);
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
        }

        /* Status & Kualifikasi Badges */
        .badge-keanggotaan {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            background: #ecfdf5;
            color: #059669;
        }

        .badge-kualifikasi {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-kualifikasi--besar {
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            border: 1px solid rgba(11, 98, 162, 0.2);
        }

        .badge-kualifikasi--menengah {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-kualifikasi--kecil {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .wilayah-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            color: var(--slate-600);
            font-weight: 500;
        }

        .btn-view-detail {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 8px;
            background: rgba(11, 98, 162, 0.08);
            color: #0B62A2;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-view-detail:hover {
            background: #0B62A2;
            color: #ffffff;
        }

        /* Pagination Controls */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 28px;
            border-top: 1px solid #f1f5f9;
            background: #fafbfd;
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            font-size: 14px;
            color: var(--slate-600);
        }

        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: var(--slate-700);
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .page-btn:hover:not(:disabled) {
            background: #f1f5f9;
            color: var(--slate-900);
            border-color: #94a3b8;
        }

        .page-btn.is-active {
            background: var(--royal, #0B62A2);
            color: #ffffff;
            border-color: var(--royal, #0B62A2);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Detail Modal Popup */
        .member-modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .member-modal.is-open {
            display: flex;
        }

        .member-modal__card {
            background: #ffffff;
            border-radius: 16px;
            max-width: 780px;
            width: 100%;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: heroFadeUp 0.3s ease-out forwards;
        }

        .member-modal__header {
            background: #0B62A2;
            color: #ffffff;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .member-modal__title-bar {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .member-modal__close {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #ffffff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .member-modal__close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .member-modal__body {
            padding: 32px;
            overflow-y: auto;
        }

        .modal-company-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--slate-900);
            text-align: center;
            margin: 0 0 24px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Info Profil Anggota Table */
        .detail-table-wrap {
            margin-bottom: 28px;
        }

        .detail-table-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--slate-900);
            margin: 0 0 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid #e2e8f0;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .detail-table td {
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            color: var(--slate-800);
            line-height: 1.5;
        }

        .detail-table td:first-child {
            width: 220px;
            font-weight: 600;
            color: var(--slate-700);
            background: #f8fafc;
        }

        /* Info SBU Section */
        .sbu-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px 24px;
        }

        .sbu-category-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--royal, #0B62A2);
            margin: 0 0 14px;
        }

        .sbu-list {
            padding-left: 20px;
            margin: 0;
        }

        .sbu-list>li {
            margin-bottom: 14px;
            font-size: 14px;
            color: var(--slate-900);
            line-height: 1.6;
        }

        .sbu-sublist {
            list-style-type: circle;
            padding-left: 24px;
            margin-top: 6px;
            color: var(--slate-600);
            font-size: 13.5px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .member-modal__footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: center;
        }

        .btn-kembali {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--royal, #0B62A2);
            color: #ffffff;
            border: none;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-kembali:hover {
            background: #0077C8;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--slate-500);
        }

        .empty-state span {
            font-size: 48px;
            color: var(--slate-400);
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            .stats-grid {
                margin-top: -30px;
                gap: 12px;
                grid-template-columns: 1fr;
            }

            .directory-filter-box {
                padding: 16px;
                border-radius: 12px;
                margin-bottom: 24px;
            }

            .filter-row {
                gap: 12px;
            }

            .filter-pills {
                gap: 8px;
            }

            .pill-btn {
                font-size: 12px;
                padding: 5px 10px;
            }

            .directory-table-card {
                border-radius: 12px;
                margin-bottom: 24px;
            }

            .directory-table-header {
                padding: 14px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            /* Mode Mobile: Tabel Direktori Anggota yang Kompak & Nyaman */
            .directory-table {
                min-width: 100%;
                width: 100%;
            }

            .directory-table th,
            .directory-table td {
                padding: 10px 8px;
            }

            .directory-table th {
                font-size: 11px;
                letter-spacing: 0.3px;
                padding: 10px 8px;
            }

            /* Sembunyikan kolom Keanggotaan, Kualifikasi, dan Wilayah di mode mobile */
            .col-hide-mobile {
                display: none !important;
            }

            .col-number {
                width: 36px !important;
                padding-left: 8px !important;
                padding-right: 4px !important;
                text-align: center;
                font-size: 12px;
            }

            .col-nama {
                min-width: 120px;
            }

            .col-nama .company-name-text {
                font-size: 13px;
                line-height: 1.35;
                word-break: break-word;
            }

            .col-npa {
                white-space: nowrap;
                width: auto;
            }

            .col-npa .npa-cell {
                font-size: 11px;
                padding: 3px 6px;
                letter-spacing: -0.2px;
            }

            .col-detail {
                width: 44px !important;
                padding-left: 4px !important;
                padding-right: 8px !important;
                text-align: center;
            }

            /* Tombol detail di mode mobile: Hanya ikon mata tanpa tulisan 'Detail' */
            .btn-view-detail {
                padding: 0;
                width: 34px;
                height: 34px;
                min-width: 34px;
                border-radius: 8px;
                justify-content: center;
                gap: 0;
            }

            .btn-view-detail .material-symbols-outlined {
                font-size: 18px !important;
            }

            .btn-view-detail__text {
                display: none !important;
            }

            .hide-mobile-sub {
                display: none !important;
            }

            .pagination-container {
                flex-direction: column;
                gap: 12px;
                align-items: center;
                padding: 16px;
            }

            .member-modal {
                padding: 12px;
            }

            .member-modal__body {
                padding: 16px;
            }

            .modal-company-title {
                font-size: 18px;
                margin-bottom: 16px;
            }

            .detail-table td:first-child {
                width: 120px;
                font-size: 13px;
                padding: 8px 10px;
            }

            .detail-table td {
                padding: 8px 10px;
                font-size: 13px;
            }

            .sbu-section {
                padding: 14px 16px;
            }
        }
    </style>
</head>

<body>
    <!-- ================= HEADER ================= -->
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
                        <span><strong>Anggota INKINDO</strong><small>Login Sistem Informasi Anggota (SIA)</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="http://localhost:8080/mitra/login" target="_blank" rel="noopener noreferrer"
                        class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">handshake</span>
                        <span><strong>Mitra Kerja</strong><small>Login Portal Rekanan &amp; Mitra
                                Terdaftar</small></span>
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
                        <span class="material-symbols-outlined panel-link__icon">public</span>
                        <span><strong>LKPP (SPSE)</strong><small>Portal Pengadaan Nasional LKPP</small></span>
                        <span class="material-symbols-outlined panel-link__arrow">chevron_right</span>
                    </a></li>
                <li><a href="lelang-lainnya.html" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">domain</span>
                        <span><strong>Info Lelang Lainnya</strong><small>BUMN, Multilateral, &amp; Peluang
                                Proyek</small></span>
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
                <li><a href="anggota-terdaftar.html" class="panel-link is-current"
                        style="background: rgba(11, 98, 162, 0.08); border-left: 3px solid var(--royal, #0B62A2);">
                        <span class="material-symbols-outlined panel-link__icon"
                            style="color: var(--royal, #0B62A2);">fact_check</span>
                        <span><strong style="color: var(--royal, #0B62A2);">Anggota Terdaftar</strong><small>Direktori
                                badan usaha terverifikasi</small></span>
                        <span class="material-symbols-outlined panel-link__arrow"
                            style="color: var(--royal, #0B62A2);">chevron_right</span>
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

    <!-- ================= MAIN CONTENT ================= -->
    <main class="anggota-content">

        <!-- 1. Hero Section (Desain Identik tentang.html: Full Screen 100vh & Background Foto Jakarta) -->
        <section
            style="position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #0F172A; background: url('{{ \App\Support\PageBackgroundHelper::get('anggota_hero', 'assets/jakarta8.webp') }}') center/cover no-repeat;">
            <div
                style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(8, 14, 40, 0.45) 0%, rgba(8, 14, 40, 0.18) 35%, rgba(8, 14, 40, 0.65) 100%), linear-gradient(90deg, rgba(8, 14, 40, 0.35) 0%, transparent 60%);">
            </div>
            <div class="container" style="position: relative; z-index: 2; text-align: left; width: 100%;">
                <h1 class="hero-anim-title"
                    style="font-size: clamp(40px, 5vw, 56px); font-weight: 800; margin-bottom: 16px; letter-spacing: -1px; color: #ffffff; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);">
                    Direktori Anggota Terdaftar</h1>
                <div class="hero-anim-line"
                    style="width: 70px; height: 5px; background: #ffffff; margin: 0 0 24px; border-radius: 4px;">
                </div>
                <p class="hero-anim-desc"
                    style="font-size: clamp(16px, 1.8vw, 20px); max-width: 740px; line-height: 1.7; color: rgba(255, 255, 255, 0.92); font-weight: 400; text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);">
                    Direktori resmi badan usaha jasa konsultansi yang terverifikasi dan berstatus aktif di lingkungan
                    <strong style="color: #ffffff;">DPP INKINDO DKI Jakarta</strong>. Menghubungkan pengguna jasa
                    konstruksi dan non-konstruksi
                    dengan konsultan berintegritas.
                </p>
            </div>
        </section>

        <!-- 2. Bagian Direktori & Tabel (White Background) -->
        <section style="padding: 40px 0 80px; background: #f8fafc;">
            <div class="container" style="max-width: 1240px; margin: 0 auto; text-align: left;">

                <!-- Stats Overview Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card__icon stat-card__icon--blue">
                            <span class="material-symbols-outlined">corporate_fare</span>
                        </div>
                        <div>
                            <h3 class="stat-card__number" id="stat-total">0</h3>
                            <p class="stat-card__label">Total Perusahaan Anggota</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card__icon stat-card__icon--indigo">
                            <span class="material-symbols-outlined">business_center</span>
                        </div>
                        <div>
                            <h3 class="stat-card__number" id="stat-besar">0%</h3>
                            <p class="stat-card__label">Kualifikasi Besar</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card__icon stat-card__icon--amber">
                            <span class="material-symbols-outlined">apartment</span>
                        </div>
                        <div>
                            <h3 class="stat-card__number" id="stat-menengah">0%</h3>
                            <p class="stat-card__label">Kualifikasi Menengah</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card__icon stat-card__icon--emerald">
                            <span class="material-symbols-outlined">store</span>
                        </div>
                        <div>
                            <h3 class="stat-card__number" id="stat-kecil">0%</h3>
                            <p class="stat-card__label">Kualifikasi Kecil</p>
                        </div>
                    </div>
                </div>

                <!-- Filter & Pencarian Box -->
                <div class="directory-filter-box">
                    <div class="filter-row">
                        <!-- Search input -->
                        <div class="filter-group">
                            <label for="search-input">
                                <span class="material-symbols-outlined"
                                    style="font-size: 18px; color: var(--royal);">search</span>
                                Cari Perusahaan / Subklasifikasi / No. Anggota
                            </label>
                            <div class="filter-input-wrap">
                                <span class="material-symbols-outlined">search</span>
                                <input type="text" id="search-input" class="filter-input"
                                    placeholder="Contoh: Mega Trustlink, PR101, 14642...">
                            </div>
                        </div>

                        <!-- SBU Dropdown -->
                        <div class="filter-group">
                            <label for="sbu-select">
                                <span class="material-symbols-outlined"
                                    style="font-size: 18px; color: var(--royal);">verified</span>
                                SBU
                            </label>
                            <select id="sbu-select" class="filter-select">
                                <option value="">Semua SBU</option>
                                <option value="Jasa Konstruksi">Jasa Konstruksi</option>
                                <option value="Non Jasa Konstruksi">Non Jasa Konstruksi</option>
                                <option value="Jasa Konstruksi dan Non Jasa Konstruksi">Jasa Konstruksi dan Non Jasa Konstruksi</option>
                                <option value="Tidak Punya Keduanya">Tidak Punya Keduanya</option>
                            </select>
                        </div>

                        <!-- Wilayah Dropdown -->
                        <div class="filter-group">
                            <label for="wilayah-select">
                                <span class="material-symbols-outlined"
                                    style="font-size: 18px; color: var(--royal);">location_on</span>
                                Wilayah DKI Jakarta
                            </label>
                            <select id="wilayah-select" class="filter-select">
                                <option value="">Semua Wilayah</option>
                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                <option value="Jakarta Barat">Jakarta Barat</option>
                                <option value="Jakarta Timur">Jakarta Timur</option>
                                <option value="Jakarta Utara">Jakarta Utara</option>
                            </select>
                        </div>

                        <!-- Kualifikasi Dropdown (menggantikan posisi tombol Reset di atas) -->
                        <div class="filter-group">
                            <label for="kualifikasi-select">
                                <span class="material-symbols-outlined"
                                    style="font-size: 18px; color: var(--royal);">workspace_premium</span>
                                Kualifikasi
                            </label>
                            <select id="kualifikasi-select" class="filter-select">
                                <option value="">Semua Kualifikasi</option>
                                <option value="Besar">Kualifikasi Besar</option>
                                <option value="Menengah">Kualifikasi Menengah</option>
                                <option value="Kecil">Kualifikasi Kecil</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris Bawah: Cari Proyek, Rentang Nilai Proyek, dan Tombol Reset di Kanan -->
                    <div class="filter-pills">
                        <div class="filter-price-range">
                            <span class="filter-pills-label" style="display: inline-flex; align-items: center; gap: 5px;">
                                <span class="material-symbols-outlined" style="font-size: 17px; color: var(--royal);">work_history</span>
                                Cari Proyek:
                            </span>
                            <div class="project-search-group">
                                <span class="material-symbols-outlined project-search-icon">search</span>
                                <input type="text" id="project-search-input" class="project-search-input" placeholder="Ketik proyek (cth: Gedung)...">
                            </div>

                            <span class="filter-inline-divider"></span>

                            <span class="filter-pills-label" style="display: inline-flex; align-items: center; gap: 5px;">
                                <span class="material-symbols-outlined" style="font-size: 17px; color: var(--royal);">payments</span>
                                Nilai Proyek:
                            </span>
                            <div class="price-input-group">
                                <span class="price-prefix">Rp</span>
                                <input type="text" id="project-min-input" class="price-range-input" placeholder="Min (cth: 100.000.000)" inputmode="numeric">
                            </div>
                            <span class="price-separator">-</span>
                            <div class="price-input-group">
                                <span class="price-prefix">Rp</span>
                                <input type="text" id="project-max-input" class="price-range-input" placeholder="Max (cth: 5.000.000.000)" inputmode="numeric">
                            </div>

                            <span class="filter-inline-divider"></span>

                            <button type="button" id="btn-reset" class="btn-reset-filter" title="Reset semua filter">
                                <span class="material-symbols-outlined" style="font-size: 17px;">refresh</span>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Directory Table Container -->
                <div class="directory-table-card">
                    <div class="directory-table-header">
                        <h2>
                            <span class="material-symbols-outlined"
                                style="color: var(--royal); font-size: 24px;">view_list</span>
                            Daftar Badan Usaha Konsultan
                        </h2>
                        <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                            <div class="record-counter">
                                Menampilkan <strong id="record-showing-start">0</strong> - <strong
                                    id="record-showing-end">0</strong> dari <strong id="record-total-count">0</strong>
                                Perusahaan
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="directory-table" id="directory-table">
                            <thead>
                                <tr>
                                    <th class="col-number" style="width: 60px; text-align: center;">No.</th>
                                    <th class="col-nama">Nama Perusahaan</th>
                                    <th class="col-npa">No. Anggota <span class="hide-mobile-sub">(NPA)</span></th>
                                    <th class="col-hide-mobile">Keanggotaan</th>
                                    <th class="col-hide-mobile">Kualifikasi</th>
                                    <th class="col-hide-mobile">Wilayah</th>
                                    <th class="col-detail" id="th-col-action" style="text-align: center;">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="directory-tbody">
                                <!-- Generated by JavaScript from Database -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container" id="pagination-wrapper">
                        <div class="pagination-info" id="pagination-info">
                            Halaman 0 dari 0
                        </div>
                        <div class="pagination-nav" id="pagination-controls">
                            <!-- Page buttons -->
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- ================= MODAL DETAIL ANGGOTA ================= -->
    <div class="member-modal" id="member-modal" role="dialog" aria-hidden="true" aria-labelledby="modal-company-name">
        <div class="member-modal__card">
            <div class="member-modal__header">
                <h3 class="member-modal__title-bar">
                    <span class="material-symbols-outlined" style="font-size: 20px;">badge</span>
                    Detail Profil Anggota
                </h3>
                <button type="button" class="member-modal__close" id="modal-close-btn" aria-label="Tutup">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="member-modal__body">
                <!-- Nama Perusahaan -->
                <h2 class="modal-company-title" id="modal-company-name">-</h2>

                <!-- Info Profil Anggota Table -->
                <div class="detail-table-wrap">
                    <h4 class="detail-table-title">Info Profil Anggota</h4>
                    <table class="detail-table">
                        <tbody>
                            <tr>
                                <td>No. Anggota :</td>
                                <td id="modal-npa">-</td>
                            </tr>
                            <tr>
                                <td>Keanggotaan :</td>
                                <td id="modal-keanggotaan">-</td>
                            </tr>
                            <tr>
                                <td>Kualifikasi :</td>
                                <td id="modal-kualifikasi">-</td>
                            </tr>
                            <tr>
                                <td>Alamat Domisili :</td>
                                <td id="modal-alamat-domisili">-</td>
                            </tr>
                            <tr>
                                <td>Wilayah :</td>
                                <td id="modal-wilayah">-</td>
                            </tr>
                            <tr>
                                <td>Alamat Surat-menyurat :</td>
                                <td id="modal-alamat-surat">-</td>
                            </tr>
                            <tr>
                                <td>No. Telepon :</td>
                                <td id="modal-telepon">-</td>
                            </tr>
                            <tr>
                                <td>No. Fax :</td>
                                <td id="modal-fax">-</td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td id="modal-email"><a href="#" id="modal-email-link">-</a></td>
                            </tr>
                            <tr>
                                <td>Website :</td>
                                <td id="modal-website">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Info Sertifikat Badan Usaha (SBU) -->
                <div>
                    <h4 class="detail-table-title">Info Sertifikat Badan Usaha (SBU)</h4>
                    <div id="modal-sbu-wrapper">
                        <div class="sbu-section">
                            <h4 class="sbu-category-title" id="modal-sbu-category">Jasa Konstruksi</h4>
                            <ol class="sbu-list" id="modal-sbu-list">
                                <!-- Populated by JS -->
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Info Proyek / Pekerjaan -->
                <div style="margin-top: 22px;">
                    <h4 class="detail-table-title">Info Proyek / Pekerjaan</h4>
                    <div class="sbu-section" id="modal-projects-container" style="padding: 16px;">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
            <div class="member-modal__footer" style="gap: 10px; flex-wrap: wrap;">
                <button type="button" class="btn-kembali" id="modal-close-btn-bottom">Kembali</button>
            </div>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
@include('partials.footer')

    <!-- ================= JAVASCRIPT LOGIC (TERINTEGRASI DATABASE MYSQL LARAVEL) ================= -->
    <script>
        // Data Anggota Terdaftar dikosongkan dari HTML statis dan dimuat langsung dari Database MySQL
        let memberData = [];
        let isAdminMode = false;
        let deletingMemberId = null;

        // State variables
        let currentPage = 1;
        const itemsPerPage = 10;
        let selectedKualifikasi = '';
        let filteredMembers = [];

        // Elements
        const searchInput = document.getElementById('search-input');
        const projectSearchInput = document.getElementById('project-search-input');
        const sbuSelect = document.getElementById('sbu-select');
        const wilayahSelect = document.getElementById('wilayah-select');
        const kualifikasiSelect = document.getElementById('kualifikasi-select');
        const projectMinInput = document.getElementById('project-min-input');
        const projectMaxInput = document.getElementById('project-max-input');
        const btnReset = document.getElementById('btn-reset');
        const tbody = document.getElementById('directory-tbody');
        const recordShowingStart = document.getElementById('record-showing-start');
        const recordShowingEnd = document.getElementById('record-showing-end');
        const recordTotalCount = document.getElementById('record-total-count');
        const paginationInfo = document.getElementById('pagination-info');
        const paginationControls = document.getElementById('pagination-controls');
        const btnAddMember = document.getElementById('btn-add-member');
        const thColAction = document.getElementById('th-col-action');

        // Stats Elements
        const statTotal = document.getElementById('stat-total');
        const statBesar = document.getElementById('stat-besar');
        const statMenengah = document.getElementById('stat-menengah');
        const statKecil = document.getElementById('stat-kecil');

        // Detail Modal Elements
        const modal = document.getElementById('member-modal');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        const modalCloseBtnBottom = document.getElementById('modal-close-btn-bottom');
        const modalCompanyName = document.getElementById('modal-company-name');
        const modalNpa = document.getElementById('modal-npa');
        const modalKeanggotaan = document.getElementById('modal-keanggotaan');
        const modalKualifikasi = document.getElementById('modal-kualifikasi');
        const modalAlamatDomisili = document.getElementById('modal-alamat-domisili');
        const modalWilayah = document.getElementById('modal-wilayah');
        const modalAlamatSurat = document.getElementById('modal-alamat-surat');
        const modalTelepon = document.getElementById('modal-telepon');
        const modalFax = document.getElementById('modal-fax');
        const modalEmailLink = document.getElementById('modal-email-link');
        const modalWebsite = document.getElementById('modal-website');
        const modalSbuCategory = document.getElementById('modal-sbu-category');
        const modalSbuList = document.getElementById('modal-sbu-list');

        function escapeHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function updateStatsCards() {
            const total = memberData.length;
            const besar = memberData.filter(m => m.kualifikasi === 'Besar').length;
            const menengah = memberData.filter(m => m.kualifikasi === 'Menengah').length;
            const kecil = memberData.filter(m => m.kualifikasi === 'Kecil').length;

            if (statTotal) statTotal.textContent = total;
            if (statBesar) statBesar.textContent = (total > 0 ? Math.round((besar / total) * 100) : 0) + '%';
            if (statMenengah) statMenengah.textContent = (total > 0 ? Math.round((menengah / total) * 100) : 0) + '%';
            if (statKecil) statKecil.textContent = (total > 0 ? Math.round((kecil / total) * 100) : 0) + '%';
        }

        // Load data from MySQL via Laravel API
        async function fetchMembersFromDatabase() {
            try {
                const res = await fetch('/api/members', {
                    headers: { 'Accept': 'application/json' },
                    credentials: 'same-origin'
                });
                if (res.ok) {
                    const data = await res.json();
                    memberData = Array.isArray(data.members) ? data.members : [];
                    if (false) {
                        isAdminMode = data.is_admin;
                    }
                }
            } catch (err) {
                console.error('Gagal mengambil data anggota:', err);
            }
            syncAdminControlsVisibility();
            updateStatsCards();

            const urlParams = new URLSearchParams(window.location.search);
            const urlQuery = urlParams.get('q');
            const urlMemberId = urlParams.get('member');
            if (urlQuery && searchInput) {
                searchInput.value = urlQuery;
            }

            applyFilter();

            if (urlMemberId) {
                const parsedId = parseInt(urlMemberId, 10);
                if (!Number.isNaN(parsedId)) {
                    setTimeout(() => {
                        if (typeof window.openModal === 'function') {
                            window.openModal(parsedId);
                        }
                    }, 150);
                }
            }
        }

        function syncAdminControlsVisibility() {
            if (false) {
                isAdminMode = window.__INKINDO_AUTH.authenticated;
            }
            if (btnAddMember) {
                btnAddMember.style.display = isAdminMode ? 'inline-flex' : 'none';
            }
            if (thColAction) {
                thColAction.textContent = isAdminMode ? 'Detail & Aksi' : 'Detail';
            }
        }

        window.addEventListener('inkindo:auth-changed', (e) => {
            isAdminMode = Boolean(e.detail && e.detail.authenticated);
            syncAdminControlsVisibility();
            renderTable();
        });

        function parseNumericRupiah(val) {
            const cleaned = String(val ?? '').replace(/[^0-9]/g, '');
            return cleaned === '' ? null : Number(cleaned);
        }

        function formatRupiahInput(inputEl) {
            const digits = inputEl.value.replace(/[^0-9]/g, '');
            if (!digits) {
                inputEl.value = '';
                return;
            }
            inputEl.value = Number(digits).toLocaleString('id-ID');
        }

        // Filter Function
        function applyFilter() {
            const query = searchInput.value.toLowerCase().trim();
            const projectQuery = projectSearchInput ? projectSearchInput.value.toLowerCase().trim() : '';
            const sbuVal = sbuSelect.value;
            const wilayahVal = wilayahSelect.value;
            const kualifikasiVal = kualifikasiSelect ? kualifikasiSelect.value : '';
            const minPrice = projectMinInput ? parseNumericRupiah(projectMinInput.value) : null;
            const maxPrice = projectMaxInput ? parseNumericRupiah(projectMaxInput.value) : null;

            filteredMembers = memberData.filter(item => {
                // Pencarian utama hanya mencakup 3 hal: Nama Perusahaan, Subklasifikasi, dan No. Anggota (NPA)
                const matchBasic =
                    (item.name && item.name.toLowerCase().includes(query)) ||
                    (item.npa && item.npa.toLowerCase().includes(query));

                const matchSubklasifikasi = Array.isArray(item.sbuItems) && item.sbuItems.some(sbuItem =>
                    (sbuItem.code && sbuItem.code.toLowerCase().includes(query)) ||
                    (Array.isArray(sbuItem.subbidang) && sbuItem.subbidang.some(sub => String(sub).toLowerCase().includes(query)))
                );

                const matchQuery = !query || matchBasic || matchSubklasifikasi;

                const matchSbu = !sbuVal || item.sbu === sbuVal;
                const matchWilayah = !wilayahVal || item.wilayah === wilayahVal;
                const matchKualifikasi = !kualifikasiVal || item.kualifikasi === kualifikasiVal;

                // Pencarian khusus Proyek (Nama Pekerjaan / KBLI) & Nilai Proyek
                let matchProject = true;
                if (projectQuery !== '' || minPrice !== null || maxPrice !== null) {
                    matchProject = Array.isArray(item.projects) && item.projects.some(proj => {
                        if (projectQuery !== '') {
                            const matchName =
                                (proj.nama_pekerjaan && String(proj.nama_pekerjaan).toLowerCase().includes(projectQuery)) ||
                                (proj.kode_kbli && String(proj.kode_kbli).toLowerCase().includes(projectQuery)) ||
                                (proj.judul_kbli && String(proj.judul_kbli).toLowerCase().includes(projectQuery));
                            if (!matchName) return false;
                        }
                        if (minPrice !== null || maxPrice !== null) {
                            const projVal = parseNumericRupiah(proj.nilai_proyek);
                            if (projVal === null) return false;
                            if (minPrice !== null && projVal < minPrice) return false;
                            if (maxPrice !== null && projVal > maxPrice) return false;
                        }
                        return true;
                    });
                }

                return matchQuery && matchSbu && matchWilayah && matchKualifikasi && matchProject;
            });

            currentPage = 1;
            renderTable();
        }

        // Render Table Rows
        function renderTable() {
            const total = filteredMembers.length;
            recordTotalCount.textContent = total;

            if (total === 0) {
                const isDbEmpty = memberData.length === 0;
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <span class="material-symbols-outlined">${isDbEmpty ? 'database' : 'search_off'}</span>
                                <h4 style="margin: 0 0 8px; color: var(--slate-800);">
                                    ${isDbEmpty ? 'Belum Ada Data Anggota Terdaftar di Database' : 'Tidak Ada Anggota Ditemukan'}
                                </h4>
                                <p style="margin: 0 0 16px; font-size: 14px;">
                                    ${isDbEmpty
                                        ? (isAdminMode ? 'Silakan klik tombol "+ Tambah Anggota" untuk menambahkan data anggota baru ke database.' : 'Data direktori anggota terdaftar saat ini masih kosong.')
                                        : 'Silakan sesuaikan kata kunci atau bersihkan pilihan filter pencarian Anda.'}
                                </p>
                                ${isDbEmpty && isAdminMode ? `
                                    <button type="button" onclick="openMemberCrudModal()" style="display: inline-flex; align-items: center; gap: 6px; background: #0B62A2; color: #ffffff; border: none; padding: 10px 20px; border-radius: 10px; font-size: 13.5px; font-weight: 700; cursor: pointer;">
                                        
                                        + Tambah Anggota Pertama
                                    </button>
                                ` : ''}
                            </div>
                        </td>
                    </tr>
                `;
                recordShowingStart.textContent = '0';
                recordShowingEnd.textContent = '0';
                paginationInfo.textContent = 'Halaman 0 dari 0';
                paginationControls.innerHTML = '';
                return;
            }

            const totalPages = Math.ceil(total / itemsPerPage);
            if (currentPage > totalPages) currentPage = totalPages;

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, total);

            recordShowingStart.textContent = startIndex + 1;
            recordShowingEnd.textContent = endIndex;

            const currentItems = filteredMembers.slice(startIndex, endIndex);

            tbody.innerHTML = currentItems.map((item, index) => {
                const kualifikasiClass = item.kualifikasi.toLowerCase() === 'besar' ? 'badge-kualifikasi--besar' :
                    (item.kualifikasi.toLowerCase() === 'menengah' ? 'badge-kualifikasi--menengah' : 'badge-kualifikasi--kecil');

                const adminActionButtons = isAdminMode ? `
                    <button type="button" class="btn-view-detail" onclick="openMemberCrudModal(${item.id})" style="background: #fffbeb; color: #d97706;" title="Edit Anggota">
                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                        <span class="btn-view-detail__text">Edit</span>
                    </button>
                    <button type="button" class="btn-view-detail" onclick="openMemberDeleteModal(${item.id})" style="background: #fef2f2; color: #dc2626;" title="Hapus Anggota">
                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                        <span class="btn-view-detail__text">Hapus</span>
                    </button>
                ` : '';

                return `
                    <tr>
                        <td class="col-number" style="text-align: center; font-weight: 600; color: var(--slate-500);">${startIndex + index + 1}</td>
                        <td class="col-nama">
                            <span class="company-name-text" onclick="openMemberModalById(${item.id})">${escapeHtml(item.name)}</span>
                        </td>
                        <td class="col-npa">
                            <span class="npa-cell">${escapeHtml(item.npa)}</span>
                        </td>
                        <td class="col-hide-mobile">
                            <span class="badge-keanggotaan">
                                <span class="material-symbols-outlined" style="font-size: 14px;">verified</span>
                                ${escapeHtml(item.status)}
                            </span>
                        </td>
                        <td class="col-hide-mobile">
                            <span class="badge-kualifikasi ${kualifikasiClass}">${escapeHtml(item.kualifikasi)}</span>
                        </td>
                        <td class="col-hide-mobile">
                            <span class="wilayah-tag">
                                <span class="material-symbols-outlined" style="font-size: 16px; color: #0B62A2;">location_on</span>
                                ${escapeHtml(item.wilayah)}
                            </span>
                        </td>
                        <td class="col-detail" style="text-align: center; white-space: nowrap;">
                            <div style="display: inline-flex; align-items: center; gap: 6px; justify-content: center;">
                                <button type="button" class="btn-view-detail" onclick="openMemberModalById(${item.id})" title="Lihat Detail Profil">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                    <span class="btn-view-detail__text">Detail</span>
                                </button>
                                ${adminActionButtons}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');

            renderPagination(totalPages);
        }

        // Render Pagination
        function renderPagination(totalPages) {
            paginationInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;

            let btnsHtml = `
                <button type="button" class="page-btn" onclick="goToPage(1)" ${currentPage === 1 ? 'disabled' : ''} title="Halaman Pertama">
                    <span class="material-symbols-outlined" style="font-size: 18px;">first_page</span>
                </button>
                <button type="button" class="page-btn" onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} title="Halaman Sebelumnya">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_left</span>
                </button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    btnsHtml += `
                        <button type="button" class="page-btn ${i === currentPage ? 'is-active' : ''}" onclick="goToPage(${i})">
                            ${i}
                        </button>
                    `;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    btnsHtml += `<span style="padding: 0 4px; color: var(--slate-400);">...</span>`;
                }
            }

            btnsHtml += `
                <button type="button" class="page-btn" onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} title="Halaman Berikutnya">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span>
                </button>
                <button type="button" class="page-btn" onclick="goToPage(${totalPages})" ${currentPage === totalPages ? 'disabled' : ''} title="Halaman Terakhir">
                    <span class="material-symbols-outlined" style="font-size: 18px;">last_page</span>
                </button>
            `;

            paginationControls.innerHTML = btnsHtml;
        }

        function goToPage(page) {
            currentPage = page;
            renderTable();
            document.querySelector('.directory-table-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Open Detail Modal by ID
        function openMemberModalById(memberId) {
            const member = memberData.find(m => Number(m.id) === Number(memberId));
            if (!member) return;

            modalCompanyName.textContent = member.name;
            modalNpa.textContent = member.npa;
            modalKeanggotaan.textContent = member.status;
            modalKualifikasi.textContent = member.kualifikasi;
            modalAlamatDomisili.textContent = member.alamatDomisili || '-';
            modalWilayah.textContent = member.wilayah || '-';
            modalAlamatSurat.textContent = member.alamatSurat || member.alamatDomisili || '-';
            modalTelepon.textContent = member.telepon || '-';
            modalFax.textContent = member.fax || '-';

            if (member.email && member.email !== '-') {
                modalEmailLink.textContent = member.email;
                modalEmailLink.href = 'mailto:' + member.email;
            } else {
                modalEmailLink.textContent = '-';
                modalEmailLink.removeAttribute('href');
            }

            if (member.website && member.website !== '-') {
                const href = member.website.startsWith('http') ? member.website : 'https://' + member.website;
                modalWebsite.innerHTML = `<a href="${escapeHtml(href)}" target="_blank" rel="noopener noreferrer">${escapeHtml(member.website)}</a>`;
            } else {
                modalWebsite.textContent = '-';
            }

            const renderSbuItemHtml = (item) => `
                <li>
                    <strong>${escapeHtml(item.code)}</strong> (Kelas: <strong>${escapeHtml(item.kelas || member.kualifikasi)}</strong>, Masa berlaku s/d : <em>${escapeHtml(item.masaBerlaku || '-')}</em>)
                    ${item.subbidang && item.subbidang.length > 0 ? `
                        <ul class="sbu-sublist">
                            ${item.subbidang.map(sub => `<li>${escapeHtml(sub)}</li>`).join('')}
                        </ul>
                    ` : ''}
                </li>
            `;

            const inferItemJenis = (item) => {
                if (item && (item.jenis === 'Non Jasa Konstruksi' || item.jenis === 'Jasa Konstruksi')) {
                    return item.jenis;
                }
                const codeStr = String((item && item.code) || '').trim().toUpperCase();
                if (/^[0-9]/.test(codeStr) || codeStr.startsWith('NJK') || codeStr.startsWith('SC') || codeStr.startsWith('MS')) {
                    return 'Non Jasa Konstruksi';
                }
                return 'Jasa Konstruksi';
            };

            const sbuCatLabel = (member.sbu || 'Jasa Konstruksi').trim();
            const isBothJkNjk = (sbuCatLabel === 'Jasa Konstruksi dan Non Jasa Konstruksi' || sbuCatLabel === 'NJK dan JK');
            const sbuWrapper = document.getElementById('modal-sbu-wrapper');
            const allSbuItems = Array.isArray(member.sbuItems) ? member.sbuItems : [];

            if (sbuWrapper) {
                if (isBothJkNjk) {
                    const jkItems = allSbuItems.filter(it => inferItemJenis(it) === 'Jasa Konstruksi');
                    const njkItems = allSbuItems.filter(it => inferItemJenis(it) === 'Non Jasa Konstruksi');

                    sbuWrapper.innerHTML = `
                        <div class="sbu-section" style="margin-bottom: 14px;">
                            <h4 class="sbu-category-title">Jasa Konstruksi</h4>
                            <ol class="sbu-list">
                                ${jkItems.length > 0
                                    ? jkItems.map(renderSbuItemHtml).join('')
                                    : '<li><em>Tidak ada rincian subklasifikasi SBU Jasa Konstruksi tercatat.</em></li>'}
                            </ol>
                        </div>
                        <div class="sbu-section">
                            <h4 class="sbu-category-title">Non Jasa Konstruksi</h4>
                            <ol class="sbu-list">
                                ${njkItems.length > 0
                                    ? njkItems.map(renderSbuItemHtml).join('')
                                    : '<li><em>Tidak ada rincian subklasifikasi SBU Non Jasa Konstruksi tercatat.</em></li>'}
                            </ol>
                        </div>
                    `;
                } else {
                    sbuWrapper.innerHTML = `
                        <div class="sbu-section">
                            <h4 class="sbu-category-title" id="modal-sbu-category">${escapeHtml(sbuCatLabel)}</h4>
                            <ol class="sbu-list" id="modal-sbu-list">
                                ${allSbuItems.length > 0
                                    ? allSbuItems.map(renderSbuItemHtml).join('')
                                    : '<li><em>Tidak ada rincian sub-bidang SBU tercatat.</em></li>'}
                            </ol>
                        </div>
                    `;
                }
            }

            const modalProjectsContainer = document.getElementById('modal-projects-container');
            if (modalProjectsContainer) {
                if (Array.isArray(member.projects) && member.projects.length > 0) {
                    modalProjectsContainer.innerHTML = `
                        <div style="overflow-x: auto;">
                            <table class="detail-table" style="width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="background: #0B62A2; color: #ffffff; font-size: 13px; text-align: left;">
                                        <th style="padding: 10px 12px; width: 45px; text-align: center;">No</th>
                                        <th style="padding: 10px 12px;">Pekerjaan</th>
                                        <th style="padding: 10px 12px; text-align: center;">Subklasifikasi</th>
                                        <th style="padding: 10px 12px; text-align: right;">Nilai Proyek</th>
                                        <th style="padding: 10px 12px; text-align: center;">Tahun</th>
                                        <th style="padding: 10px 12px; text-align: center;">Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${member.projects.map((p, idx) => `
                                        <tr style="border-bottom: 1px solid #e2e8f0; font-size: 13.5px;">
                                            <td style="padding: 10px 12px; text-align: center; width: auto; background: transparent; font-weight: 600; color: #64748b;">${idx + 1}</td>
                                            <td style="padding: 10px 12px; font-weight: 600; color: #0f172a;">${escapeHtml(p.nama_pekerjaan)}</td>
                                            <td style="padding: 10px 12px; text-align: center;">
                                                <span style="background: #1e293b; color: #ffffff; padding: 3px 9px; border-radius: 6px; font-size: 12px; font-weight: 700;">${escapeHtml(p.kode_kbli)}</span>
                                            </td>
                                            <td style="padding: 10px 12px; text-align: right; font-weight: 600; color: #0f172a; white-space: nowrap;">${escapeHtml(p.nilai_proyek)}</td>
                                            <td style="padding: 10px 12px; text-align: center; color: #334155;">${escapeHtml(p.tahun_proyek)}</td>
                                            <td style="padding: 10px 12px; text-align: center; color: #334155;">${escapeHtml(p.lama_proyek)}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    `;
                } else {
                    modalProjectsContainer.innerHTML = `<p style="margin: 0; font-size: 13.5px; color: #64748b;"><em>Tidak ada riwayat proyek / pekerjaan tercatat.</em></p>`;
                }
            }

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeMemberModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        // Event Listeners
        searchInput.addEventListener('input', applyFilter);
        if (projectSearchInput) {
            projectSearchInput.addEventListener('input', applyFilter);
        }
        sbuSelect.addEventListener('change', applyFilter);
        wilayahSelect.addEventListener('change', applyFilter);
        if (kualifikasiSelect) {
            kualifikasiSelect.addEventListener('change', applyFilter);
        }

        if (projectMinInput) {
            projectMinInput.addEventListener('input', () => {
                formatRupiahInput(projectMinInput);
                applyFilter();
            });
        }
        if (projectMaxInput) {
            projectMaxInput.addEventListener('input', () => {
                formatRupiahInput(projectMaxInput);
                applyFilter();
            });
        }

        btnReset.addEventListener('click', () => {
            searchInput.value = '';
            if (projectSearchInput) projectSearchInput.value = '';
            sbuSelect.value = '';
            wilayahSelect.value = '';
            if (kualifikasiSelect) kualifikasiSelect.value = '';
            if (projectMinInput) projectMinInput.value = '';
            if (projectMaxInput) projectMaxInput.value = '';
            selectedKualifikasi = '';
            applyFilter();
        });

        // Modal close events
        modalCloseBtn.addEventListener('click', closeMemberModal);
        modalCloseBtnBottom.addEventListener('click', closeMemberModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeMemberModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (modal.classList.contains('is-open')) closeMemberModal();
                
            }
        });

        // Initialize Table from Database
        fetchMembersFromDatabase();
    </script>
    <script src="js/script.js?v=cerah15"></script>
</body>

</html>
