<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Detail agenda kegiatan, rilis berita, dan publikasi resmi DPP INKINDO DKI Jakarta.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=cerah15">
    <style>


        .detail-page {
            background: #ffffff;
            min-height: 100vh;
        }

        /* Pita atas (mengikuti pre-landing BCA News) */
        .detail-top {
            position: relative;
            padding: calc(var(--header-h) + 36px) 0 36px;
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            overflow: hidden;
        }

        .detail-top::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('assets/jakarta2.jpg') center/cover;
            z-index: 1;
        }

        .detail-top::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(8, 14, 40, 0.45) 0%, rgba(8, 14, 40, 0.2) 35%, rgba(8, 14, 40, 0.7) 100%),
                linear-gradient(90deg, rgba(8, 14, 40, 0.35) 0%, transparent 60%);
            z-index: 2;
        }

        .detail-top .container {
            position: relative;
            z-index: 3;
        }

        .detail-top__label {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #93c5fd;
            margin-bottom: 6px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
        }

        .detail-top__title {
            font-size: 40px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 20px;
            line-height: 1.2;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .detail-tabs {
            display: flex;
            gap: 28px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .detail-tabs::-webkit-scrollbar {
            display: none;
        }

        .detail-tabs a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 18px;
            padding-bottom: 10px;
            position: relative;
            white-space: nowrap;
            transition: color .2s;
        }

        .detail-tabs a:hover {
            color: #ffffff;
        }

        .detail-tabs a.is-active {
            color: #ffffff;
            font-weight: 600;
        }

        .detail-tabs a.is-active::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            background: #ffffff;
            border-radius: 2px;
        }

        /* Artikel */
        .article {
            padding: 56px 20px 0;
        }

        .article__wrap {
            max-width: 770px;
            margin: 0 auto;
        }

        .article__meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px 14px;
            font-size: 16px;
            color: #8a8a8a;
        }

        .article__meta .material-symbols-outlined {
            font-size: 18px;
            vertical-align: -3px;
        }

        .article__title {
            margin: 16px 0 0;
            font-size: 32px;
            line-height: 1.25;
            color: #1c324e;
            font-weight: 700;
        }

        .article__cats {
            margin-top: 14px;
        }

        .article__cats a {
            display: inline-block;
            height: 40px;
            line-height: 40px;
            font-size: 16px;
            color: #8a8a8a;
            text-decoration: underline;
            margin-right: 15px;
        }

        .article__cats a:hover {
            color: #0B62A2;
        }

        .share {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px 12px;
            margin-top: 8px;
        }

        .share p {
            margin: 0;
            font-size: 16px;
            color: #334155;
        }

        .share ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .share a,
        .share button {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border: 0;
            background: transparent;
            cursor: pointer;
            color: #0B62A2;
            border-radius: 50%;
            transition: background .2s, transform .2s;
            position: relative;
        }

        .share a:hover,
        .share button:hover {
            background: rgba(11, 98, 162, 0.08);
            transform: translateY(-2px);
        }

        .share svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .share .material-symbols-outlined {
            font-size: 22px;
        }

        .share .copied {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, .75);
            color: #fff;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s;
            z-index: 2;
        }

        .share .copied.is-show {
            opacity: 1;
        }

        .article__img {
            max-width: 770px;
            margin: 34px auto 40px;
            text-align: center;
        }

        .article__img img {
            display: block;
            width: auto;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .12);
        }

        .article__lead {
            font-size: 19px;
            line-height: 1.6;
            color: #334155;
            font-weight: 500;
            margin: 0 0 24px;
            padding-left: 16px;
            border-left: 4px solid #0B62A2;
        }

        /* Kotak informasi agenda / publikasi */
        .info-card {
            background: #f1f5f8;
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 28px;
        }

        .info-card__title {
            margin: 0 0 14px;
            font-size: 17px;
            font-weight: 700;
            color: #1c324e;
        }

        .info-card dl {
            margin: 0;
            display: grid;
            gap: 12px;
        }

        .info-card__row {
            display: grid;
            grid-template-columns: 24px 110px 1fr;
            gap: 10px;
            align-items: start;
            font-size: 15px;
        }

        .info-card__row .material-symbols-outlined {
            color: #0B62A2;
            font-size: 22px;
        }

        .info-card dt {
            color: #64748b;
        }

        .info-card dd {
            margin: 0;
            color: #0f172a;
            font-weight: 500;
        }

        .download-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            background: linear-gradient(135deg, #005088 0%, #0B62A2 100%);
            color: #fff;
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 28px;
        }

        .download-card__info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .download-card__icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .15);
            display: grid;
            place-items: center;
        }

        .download-card__icon span {
            font-size: 32px;
            color: #38bdf8;
        }

        .download-card h2 {
            margin: 0 0 4px;
            font-size: 17px;
            color: #fff;
        }

        .download-card small {
            color: #cbd5e1;
            font-size: 13px;
        }

        .download-card__btn {
            background: #fff;
            color: #0B62A2;
            font-weight: 700;
            padding: 11px 22px;
            border-radius: 24px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: .2s;
        }

        .download-card__btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .3);
        }

        /* Isi artikel (RTE) */
        .article-body {
            font-size: 16px;
            line-height: 25px;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .article-body p {
            margin: 0 0 16px;
        }

        .article-body h2 {
            font-size: 22px;
            color: #1c324e;
            margin: 28px 0 12px;
            line-height: 1.3;
        }

        .article-body ul,
        .article-body ol {
            margin: 0 0 18px;
            padding-left: 24px;
        }

        .article-body li {
            margin-bottom: 8px;
        }

        .article-body ul li::marker {
            color: #0B62A2;
        }

        .article-body blockquote {
            margin: 24px 0;
            padding: 18px 22px;
            background: rgba(11, 98, 162, 0.06);
            border-left: 4px solid #0B62A2;
            border-radius: 0 12px 12px 0;
            font-size: 18px;
            font-style: italic;
            color: #0B62A2;
        }

        .article__source {
            font-size: 14px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .article__source .material-symbols-outlined {
            font-size: 18px;
            color: #0B62A2;
        }

        .article__back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 24px 0 0;
            color: #0B62A2;
            font-weight: 600;
            text-decoration: none;
        }

        .article__back:hover {
            text-decoration: underline;
        }

        /* Terkait */
        .related {
            background: #f1f5f8;
            margin-top: 56px;
            padding: 56px 20px 64px;
        }

        .related__inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .related h2 {
            font-size: 28px;
            margin: 0 0 24px;
            color: #1c324e;
        }

        .related__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .rel-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
            transition: .3s;
            display: flex;
            flex-direction: column;
        }

        .rel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, .14);
        }

        .rel-card__img {
            width: 100%;
            background: #f8fafc;
            overflow: hidden;
        }
        .rel-card__img img {
            width: 100%;
            height: auto;
            display: block;
        }
        .rel-card__img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .rel-card__body {
            padding: 16px 18px 20px;
        }

        .rel-card__date {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .rel-card__title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.4;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .rel-card:hover .rel-card__title {
            color: #0B62A2;
        }

        .notfound {
            text-align: center;
            padding: 80px 20px;
        }

        .notfound .material-symbols-outlined {
            font-size: 56px;
            color: #94a3b8;
        }

        @media (max-width: 900px) {
            .related__grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .detail-top__title {
                font-size: 30px;
            }

            .detail-tabs a {
                font-size: 16px;
            }

            .article {
                padding-top: 36px;
            }

            .article__title {
                font-size: 24px;
            }

            .article__meta {
                font-size: 13px;
            }

            .article__img img {
                height: auto;
                border-radius: 12px;
            }

            .article-body {
                font-size: 14px;
                line-height: 22px;
            }

            .info-card__row {
                grid-template-columns: 24px 1fr;
            }

            .info-card dt {
                grid-column: 2;
                font-size: 12px;
            }

            .info-card dd {
                grid-column: 2;
            }

            .related__grid {
                grid-template-columns: 1fr;
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
                    <li><a href="tentang.html" class="main-nav__link" id="nav-tentang">Tentang Kami</a></li>
                    <li><a href="regulasi.html" class="main-nav__link" id="nav-regulasi">Regulasi</a></li>
                    <li><a href="berita.html" class="main-nav__link is-active" id="nav-berita">Berita &amp;
                            Informasi</a></li>
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

        <div class="side-panel__content" data-content="lelang">
            <h3 class="side-panel__title">Info Lelang</h3>
            <p class="side-panel__desc">Pantau paket pengadaan jasa konsultansi pemerintah melalui kanal resmi berikut.
            </p>
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
        </div>

        <div class="side-panel__content" data-content="klinik">
            <h3 class="side-panel__title">Klinik Konsultasi</h3>
            <p class="side-panel__desc">Pendampingan gratis bagi anggota terkait regulasi, sertifikasi, dan pengadaan
                jasa konsultansi.</p>
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
                        <span><strong>Sekretariat DPP</strong><small>Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta
                                Selatan 12760</small></span>
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
    <main class="detail-page">
        <section class="detail-top">
            <div class="container">
                <p class="detail-top__label">DPP INKINDO DKI Jakarta</p>
                <h1 class="detail-top__title" id="detail-section-title">Berita &amp; Informasi</h1>
                <nav class="detail-tabs" aria-label="Kategori berita">
                    <a href="berita.html?tab=agenda" data-type="agenda">Agenda Kegiatan</a>
                    <a href="berita.html?tab=rilis" data-type="rilis">Rilis Berita</a>
                    <a href="berita.html?tab=publikasi" data-type="publikasi">Publikasi</a>
                    <a href="berita.html?tab=galeri" data-type="galeri">Galeri</a>
                    <a href="berita.html?tab=emagazine" data-type="emagazine">e-Magazine</a>
                    <a href="berita.html?tab=karya" data-type="karya">Karya Anggota</a>
                </nav>
            </div>
        </section>

        <div id="detail-root"></div>

        <section class="related" id="related-section" hidden>
            <div class="related__inner">
                <h2 id="related-title">Berita Lainnya</h2>
                <div class="related__grid" id="related-grid"></div>
            </div>
        </section>
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer" id="kontak">
        <div class="site-footer__container">
            <div class="site-footer__grid">
                <div class="site-footer__brand">
                    <div class="site-footer__logo">
                        <img alt="Logo INKINDO DKI Jakarta" src="assets/logo-inkindo.png">
                    </div>
                    <p class="site-footer__bio">
                        Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta merupakan wadah asosiasi
                        perusahaan jasa konsultansi independen yang profesional dan berintegritas.
                    </p>
                </div>
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
                            <span><a href="mailto:sekretariat@inkindo-dki.org"
                                    class="site-footer__link">sekretariat@inkindo-dki.org</a></span>
                        </div>
                        <div class="site-footer__contact-item site-footer__hours">
                            <span class="material-symbols-outlined site-footer__icon">schedule</span>
                            <span>Senin - Jumat: 08.00 - 16.30 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <p>© 2026 DPP INKINDO DKI Jakarta. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>


    <script>
        (function () {
            var params = new URLSearchParams(location.search);
            var typeParam = params.get('type') || 'rilis';
            var slug = params.get('id') || '';
            var root = document.getElementById('detail-root');

            var labelMap = {
                agenda: 'Agenda Kegiatan',
                rilis: 'Rilis Berita',
                publikasi: 'Publikasi',
                galeri: 'Galeri',
                emagazine: 'e-Magazine',
                karya: 'Karya Anggota'
            };

            function esc(s) {
                return String(s || '').replace(/[&<>"]/g, function (c) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
                });
            }

            function renderNotFound() {
                document.title = 'Berita tidak ditemukan - DPP INKINDO DKI Jakarta';
                root.innerHTML = '<div class="notfound"><span class="material-symbols-outlined">search_off</span>' +
                    '<h2>Berita tidak ditemukan</h2><p>Halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>' +
                    '<a class="article__back" href="berita.html"><span class="material-symbols-outlined">arrow_back</span> Kembali ke Berita &amp; Informasi</a></div>';
            }

            if (!slug) {
                renderNotFound();
                return;
            }

            fetch('/api/cms/berita/' + encodeURIComponent(slug))
                .then(function (r) {
                    if (!r.ok) throw new Error('Not found');
                    return r.json();
                })
                .then(function (res) {
                    var item = res.item;
                    var related = res.related || [];
                    if (!item) {
                        renderNotFound();
                        return;
                    }

                    var type = item.tipe || typeParam;
                    var sectionLabel = labelMap[type] || 'Berita & Informasi';

                    document.querySelectorAll('.detail-tabs a').forEach(function (a) {
                        a.classList.toggle('is-active', a.dataset.type === type);
                    });

                    document.title = item.judul + ' - DPP INKINDO DKI Jakarta';
                    var md = document.querySelector('meta[name="description"]');
                    if (md) md.setAttribute('content', item.ringkasan || item.judul);
                    document.getElementById('detail-section-title').textContent = sectionLabel;

                    var rawBody = (item.konten || item.ringkasan || '').trim();
                    var body = '';
                    if (rawBody.indexOf('<p>') !== -1 || rawBody.indexOf('<h2>') !== -1 || rawBody.indexOf('<ul>') !== -1) {
                        body = rawBody;
                    } else {
                        body = rawBody.split(/\n\s*\n|\r?\n/).filter(function (p) { return p.trim() !== ''; }).map(function (p) {
                            return '<p>' + esc(p.trim()) + '</p>';
                        }).join('');
                    }

                    var dateIcon = type === 'agenda' ? 'event' : 'calendar_today';
                    var info = '';

                    if (type === 'agenda') {
                        var facts = [];
                        if (item.tanggal_label) facts.push(['event', 'Tanggal', item.tanggal_label]);
                        if (item.waktu_kegiatan) facts.push(['schedule', 'Waktu', item.waktu_kegiatan]);
                        if (item.lokasi_meta) facts.push(['location_on', 'Lokasi', item.lokasi_meta]);
                        if (item.biaya_kegiatan) facts.push(['payments', 'Biaya', item.biaya_kegiatan]);
                        if (item.kuota_kegiatan) facts.push(['groups', 'Kuota', item.kuota_kegiatan]);

                        if (facts.length) {
                            info = '<div class="info-card"><h2 class="info-card__title">Informasi Kegiatan</h2><dl>' +
                                facts.map(function (f) {
                                    return '<div class="info-card__row"><span class="material-symbols-outlined">' + f[0] +
                                        '</span><dt>' + esc(f[1]) + '</dt><dd>' + esc(f[2]) + '</dd></div>';
                                }).join('') + '</dl></div>';
                        }
                    }

                    var source = item.penulis ?
                        '<div class="article__source"><span class="material-symbols-outlined">verified</span> Sumber: ' + esc(item.penulis) + '</div>' : '';

                    var shareUrl = encodeURIComponent(location.href);
                    var shareTxt = encodeURIComponent(item.judul);
                    var share = '<div class="share"><p>Bagikan informasi ini</p><ul>' +
                        '<li><button type="button" id="copy-link" aria-label="Salin tautan"><span class="material-symbols-outlined">link</span><span class="copied" id="copied-tip">Berhasil disalin</span></button></li>' +
                        '<li><a target="_blank" rel="noopener" aria-label="Bagikan ke X" href="https://twitter.com/intent/tweet?text=' + shareTxt + '&url=' + shareUrl + '"><svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a></li>' +
                        '<li><a target="_blank" rel="noopener" aria-label="Bagikan ke Facebook" href="https://www.facebook.com/sharer/sharer.php?u=' + shareUrl + '"><svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a></li>' +
                        '<li><a target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp" href="https://wa.me/?text=' + shareTxt + '%20' + shareUrl + '"><svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a></li>' +
                        '</ul></div>';

                    root.innerHTML =
                        '<article class="article" id="detail-article"><div class="article__wrap">' +
                        '<div class="article__meta"><span class="material-symbols-outlined">' + dateIcon + '</span>' +
                        '<span>' + esc(item.tanggal_label) + '</span><span>|</span><span>' + esc(sectionLabel) + '</span></div>' +
                        '<h1 class="article__title">' + esc(item.judul) + '</h1>' +
                        '<div class="article__cats"><a href="berita.html?tab=' + encodeURIComponent(type) + '">' + esc(item.kategori_label) + '</a></div>' +
                        share + '</div>' +
                        '<div class="article__img"><img src="' + esc(item.gambar) + '" alt="' + esc(item.judul) + '"></div>' +
                        '<div class="article__wrap">' +
                        (item.ringkasan ? '<p class="article__lead">' + esc(item.ringkasan) + '</p>' : '') + info +
                        '<div class="article-body">' + body + '</div>' + source + share.replace('id="copy-link"', 'id="copy-link-2"').replace('id="copied-tip"', 'id="copied-tip-2"') +
                        '<a class="article__back" href="berita.html?tab=' + encodeURIComponent(type) + '"><span class="material-symbols-outlined">arrow_back</span> Kembali ke ' + esc(sectionLabel) + '</a>' +
                        '</div></article>';

                    [['copy-link', 'copied-tip'], ['copy-link-2', 'copied-tip-2']].forEach(function (p) {
                        var btn = document.getElementById(p[0]), tip = document.getElementById(p[1]);
                        if (!btn) return;
                        btn.addEventListener('click', function () {
                            var done = function () {
                                tip.classList.add('is-show');
                                setTimeout(function () { tip.classList.remove('is-show'); }, 1600);
                            };
                            if (navigator.clipboard) navigator.clipboard.writeText(location.href).then(done, done);
                            else done();
                        });
                    });

                    if (related.length) {
                        var grid = document.getElementById('related-grid');
                        grid.innerHTML = related.slice(0, 3).map(function (o) {
                            return '<a class="rel-card" href="' + esc(o.target_url) + '"><div class="rel-card__img"><img src="' + esc(o.gambar) + '" alt="' + esc(o.judul) + '"></div>' +
                                '<div class="rel-card__body"><div class="rel-card__date">' + esc(o.tanggal_label) + ' • ' + esc(o.kategori_label) + '</div>' +
                                '<h3 class="rel-card__title">' + esc(o.judul) + '</h3></div></a>';
                        }).join('');
                        document.getElementById('related-title').textContent = sectionLabel + ' Lainnya';
                        document.getElementById('related-section').hidden = false;
                    }
                })
                .catch(function () {
                    renderNotFound();
                });
        })();
    </script>
    <script src="js/script.js?v=cerah15"></script>
</body>

</html>