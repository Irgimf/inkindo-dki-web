<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKINDO DKI Jakarta</title>
    <meta name="description"
        content="Pusat rilis berita resmi, agenda kegiatan, publikasi, galeri foto, e-magazine, dan karya anggota DPP INKINDO DKI Jakarta.">
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
            max-width: 650px;
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
            gap: 28px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .tab-menu::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            background: none;
            border: none;
            font-size: 19px;
            color: #64748b;
            padding: 16px 0;
            cursor: pointer;
            position: relative;
            font-weight: 500;
            transition: 0.3s;
            white-space: nowrap;
        }

        .tab-btn:hover {
            color: #0B62A2;
        }

        .tab-btn.is-active {
            color: #0B62A2;
            font-weight: 600;
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
            gap: 18px;
            padding-bottom: 12px;
            flex-wrap: wrap;
        }

        /* Digital Library Button */
        .digital-library-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #0B62A2;
            color: #ffffff !important;
            padding: 7px 18px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(11, 98, 162, 0.3);
            transition: all 0.25s ease;
            white-space: nowrap;
            letter-spacing: 0.2px;
        }

        .digital-library-btn:hover {
            background: #0077C8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(11, 98, 162, 0.45);
            color: #ffffff !important;
        }

        .digital-library-btn .material-symbols-outlined {
            font-size: 18px;
        }

        .digital-library-btn__ext {
            font-size: 14px !important;
            opacity: 0.85;
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
            font-weight: 600;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.3px;
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
            flex-direction: row;
            align-items: stretch;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            height: 175px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            text-decoration: none;
            border: 1px solid #f1f5f9;
            position: relative;
        }

        .reg-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .reg-card__img {
            width: 42%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #f1f5f9;
            position: relative;
            flex-shrink: 0;
            overflow: hidden;
        }

        .reg-card__thumb {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
        }

        .reg-card__img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent 70%, rgba(255, 255, 255, 0.15) 100%);
        }

        .reg-card__badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(4px);
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
            z-index: 2;
            letter-spacing: 0.3px;
        }

        .reg-card__body {
            width: 58%;
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-width: 0;
        }

        .reg-card__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-bottom: 8px;
            min-width: 0;
        }

        .reg-card__date {
            font-size: 11px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .reg-card__date span {
            font-size: 13px;
            color: #94a3b8;
        }

        .reg-card__cat-pill {
            font-size: 10.5px;
            font-weight: 600;
            color: #0B62A2;
            background: rgba(11, 98, 162, 0.08);
            padding: 2px 7px;
            border-radius: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }

        .reg-card__title {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.4;
            margin: 0 0 6px 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s;
        }

        .reg-card:hover .reg-card__title {
            color: #0B62A2;
        }

        .reg-card__desc {
            display: none;
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.5;
            margin: 0 0 8px 0;
        }

        .reg-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 4px;
            min-width: 0;
        }

        .reg-card__meta-tag {
            font-size: 11px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .reg-card__meta-tag span {
            font-size: 13px;
        }

        .reg-card__more {
            color: #94a3b8;
            font-size: 20px;
            line-height: 1;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .reg-card:hover .reg-card__more {
            color: #0B62A2;
        }

        /* Callout Banner for Digital Library in Content */
        .library-callout-card {
            background: linear-gradient(135deg, #005088 0%, #0B62A2 100%);
            border-radius: 14px;
            padding: 24px 32px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
            gap: 24px;
            flex-wrap: wrap;
        }

        .library-callout-card__info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .library-callout-card__icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .library-callout-card__icon span {
            font-size: 32px;
            color: #38bdf8;
        }

        .library-callout-card__title {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px 0;
            color: #ffffff;
        }

        .library-callout-card__desc {
            font-size: 14px;
            color: #e2e8f0;
            margin: 0;
            max-width: 580px;
            line-height: 1.5;
        }

        .library-callout-card__btn {
            background: #ffffff;
            color: #0B62A2 !important;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 24px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .library-callout-card__btn:hover {
            background: #f0fdf4;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }

        /* List View Adjustments */
        .view-container.is-list .reg-card {
            height: auto;
            min-height: 140px;
        }

        .view-container.is-list .reg-card__img {
            width: 250px;
            height: auto;
            align-self: stretch;
            background-color: #f8fafc;
        }

        .view-container.is-list .reg-card__thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .view-container.is-list .reg-card__body {
            width: calc(100% - 250px);
            padding: 20px 24px;
            justify-content: flex-start;
        }

        .view-container.is-list .reg-card__cat-pill {
            max-width: none;
        }

        .view-container.is-list .reg-card__meta-tag {
            max-width: none;
        }

        .view-container.is-list .reg-card__title {
            -webkit-line-clamp: 2;
            font-size: 18px;
            margin-bottom: 8px;
            flex: none;
        }

        .view-container.is-list .reg-card__desc {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-top: 0;
            margin-bottom: 12px;
        }

        .view-container.is-list .reg-card__footer {
            margin-top: auto;
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
            transition: 0.2s;
        }

        .page-item.is-active {
            background: #0B62A2;
            color: white;
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
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: #ffffff;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
            display: none;
        }

        .empty-state.is-visible {
            display: block;
        }

        .empty-state span {
            font-size: 48px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #334155;
            margin: 0 0 6px 0;
        }

        .empty-state p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        @media (max-width: 1024px) {
            .view-container.is-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .tab-btn {
                font-size: 17px;
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
            }

            .view-container.is-list .reg-card__img {
                width: 100%;
                height: 160px;
            }

            .view-container.is-list .reg-card__body {
                width: 100%;
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

            .digital-library-btn {
                width: 100%;
                justify-content: center;
            }

            .library-callout-card {
                padding: 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .library-callout-card__btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* ===== GALERI: grid full-gambar ===== */
        #tab-galeri .view-container.is-grid .reg-card {
            display: block;
            height: 280px;
            cursor: pointer;
            border: none;
            background: #0f172a;
        }

        #tab-galeri .view-container.is-grid .reg-card__img {
            position: absolute;
            inset: 0;
            width: 100%;
            transition: transform 0.6s ease;
        }

        #tab-galeri .view-container.is-grid .reg-card__img::after {
            background: linear-gradient(to top, rgba(2, 6, 23, 0.88) 0%, rgba(2, 6, 23, 0.35) 45%, transparent 75%);
        }

        #tab-galeri .view-container.is-grid .reg-card:hover .reg-card__img {
            transform: scale(1.08);
        }

        #tab-galeri .view-container.is-grid .reg-card__badge {
            font-size: 12px;
            padding: 5px 10px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        #tab-galeri .view-container.is-grid .reg-card__body {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            padding: 18px;
            z-index: 3;
            justify-content: flex-end;
        }

        #tab-galeri .view-container.is-grid .reg-card__top {
            margin-bottom: 6px;
        }

        #tab-galeri .view-container.is-grid .reg-card__date,
        #tab-galeri .view-container.is-grid .reg-card__date span,
        #tab-galeri .view-container.is-grid .reg-card__meta-tag,
        #tab-galeri .view-container.is-grid .reg-card__meta-tag span {
            color: #cbd5e1;
        }

        #tab-galeri .view-container.is-grid .reg-card__cat-pill {
            background: rgba(14, 165, 233, 0.9);
            color: #fff;
        }

        #tab-galeri .view-container.is-grid .reg-card__title {
            color: #fff;
            font-size: 16px;
            flex: none;
            -webkit-line-clamp: 2;
        }

        #tab-galeri .view-container.is-grid .reg-card:hover .reg-card__title {
            color: #7dd3fc;
        }

        #tab-galeri .view-container.is-grid .reg-card__footer {
            margin-top: 8px;
            padding-top: 0;
        }

        #tab-galeri .view-container.is-grid .reg-card__more {
            color: #e2e8f0;
        }

        /* ===== LIGHTBOX ===== */
        .lb {
            position: fixed;
            inset: 0;
            z-index: 10000;
            background: rgba(2, 6, 23, 0.96);
            display: flex;
            flex-direction: column;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        .lb.is-open {
            opacity: 1;
            visibility: visible;
        }

        .lb__bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 28px;
        }

        .lb__title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lb__meta {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .lb__count {
            font-size: 14px;
            background: rgba(255, 255, 255, 0.12);
            padding: 6px 14px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .lb__btn {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            display: grid;
            place-items: center;
            transition: background 0.2s, transform 0.2s;
            flex-shrink: 0;
        }

        .lb__btn:hover {
            background: #0B62A2;
            transform: scale(1.08);
        }

        .lb__stage {
            position: relative;
            flex: 1;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 90px;
        }

        .lb__img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: lbIn 0.35s ease;
            user-select: none;
        }

        @keyframes lbIn {
            from {
                opacity: 0;
                transform: scale(0.97);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .lb__nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 56px;
            height: 56px;
        }

        .lb__nav:hover {
            transform: translateY(-50%) scale(1.08);
        }

        .lb__nav--prev {
            left: 20px;
        }

        .lb__nav--next {
            right: 20px;
        }

        .lb__caption {
            text-align: center;
            padding: 12px 24px 6px;
            font-size: 14px;
            color: #e2e8f0;
        }

        .lb__thumbs {
            display: flex;
            gap: 8px;
            padding: 10px 28px 20px;
            overflow-x: auto;
            justify-content: center;
            scrollbar-width: thin;
        }

        .lb__thumb {
            width: 72px;
            height: 50px;
            border-radius: 6px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
            cursor: pointer;
            opacity: 0.5;
            border: 2px solid transparent;
            transition: 0.2s;
        }

        .lb__thumb:hover {
            opacity: 0.85;
        }

        .lb__thumb.is-active {
            opacity: 1;
            border-color: #0B62A2;
        }

        @media (max-width: 768px) {
            .lb__stage {
                padding: 0 12px;
            }

            .lb__nav {
                width: 42px;
                height: 42px;
            }

            .lb__nav--prev {
                left: 8px;
            }

            .lb__nav--next {
                right: 8px;
            }

            .lb__bar {
                padding: 12px 16px;
            }

            .lb__thumbs {
                justify-content: flex-start;
                padding: 8px 16px 16px;
            }
        }

        /* ===== E-MAGAZINE: kartu sampul buku ===== */
        #magazine-grid.is-grid,
        #karya-grid.is-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        #magazine-grid.is-grid .reg-card,

        #karya-grid.is-grid .reg-card {
            flex-direction: column;
            height: auto;
            background: transparent;
            border: none;
            box-shadow: none;
            overflow: visible;
        }

        #magazine-grid.is-grid .reg-card:hover,

        #karya-grid.is-grid .reg-card:hover {
            box-shadow: none;
            transform: translateY(-6px);
        }

        #magazine-grid.is-grid .reg-card__img,

        #karya-grid.is-grid .reg-card__img {
            width: 100%;
            height: auto;
            aspect-ratio: 3 / 4;
            border-radius: 6px 12px 12px 6px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top center;
            box-shadow: -6px 6px 18px rgba(15, 23, 42, 0.25), inset 6px 0 8px -4px rgba(0, 0, 0, 0.35);
            transition: box-shadow 0.3s, transform 0.4s;
            transform-origin: left center;
        }

        #magazine-grid.is-grid .reg-card:hover .reg-card__img,

        #karya-grid.is-grid .reg-card:hover .reg-card__img {
            box-shadow: -10px 12px 28px rgba(15, 23, 42, 0.35), inset 6px 0 8px -4px rgba(0, 0, 0, 0.35);
            transform: perspective(900px) rotateY(-10deg);
        }

        #magazine-grid.is-grid .reg-card__img::after,

        #karya-grid.is-grid .reg-card__img::after {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.18) 0%, transparent 8%, transparent 100%);
        }

        #magazine-grid.is-grid .reg-card__body,

        #karya-grid.is-grid .reg-card__body {
            width: 100%;
            height: auto;
            padding: 14px 4px 0;
        }

        #magazine-grid.is-grid .reg-card__cat-pill,

        #karya-grid.is-grid .reg-card__cat-pill,

        #magazine-grid.is-grid .reg-card__meta-tag,

        #karya-grid.is-grid .reg-card__meta-tag {
            max-width: 160px;
        }

        #magazine-grid.is-grid .reg-card__title,

        #karya-grid.is-grid .reg-card__title {
            -webkit-line-clamp: 2;
            flex: none;
        }

        #magazine-grid.is-grid .reg-card__footer,

        #karya-grid.is-grid .reg-card__footer {
            margin-top: 10px;
        }

        #magazine-grid.is-list .reg-card__img,

        #karya-grid.is-list .reg-card__img {
            width: 130px;
            height: auto;
            aspect-ratio: 3 / 4;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top center;
        }

        #magazine-grid.is-list .reg-card__body,

        #karya-grid.is-list .reg-card__body {
            width: calc(100% - 130px);
        }

        @media (max-width: 1024px) {

            #magazine-grid.is-grid,
            #karya-grid.is-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {

            #magazine-grid.is-grid,
            #karya-grid.is-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        /* ===== KARYA ANGGOTA: modal deskripsi buku ===== */
        .bk {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(11, 30, 51, 0.72);
            backdrop-filter: blur(6px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .bk.is-open {
            opacity: 1;
            visibility: visible;
        }

        .bk__panel {
            position: relative;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 36px;
            width: min(860px, 100%);
            max-height: 90vh;
            overflow-y: auto;
            padding: 36px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(2, 6, 23, 0.45);
            transform: translateY(24px) scale(0.97);
            transition: transform 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        .bk.is-open .bk__panel {
            transform: none;
        }

        .bk__close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: grid;
            place-items: center;
            background: #f1f5f9;
            color: #334155;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }

        .bk__close:hover {
            background: #0B62A2;
            color: #fff;
            transform: rotate(90deg);
        }

        .bk__cover {
            width: 100%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            border-radius: 6px 14px 14px 6px;
            box-shadow: -8px 10px 26px rgba(15, 23, 42, 0.3), inset 6px 0 8px -4px rgba(0, 0, 0, 0.35);
            background: #e2e8f0;
        }

        .bk__info {
            display: flex;
            flex-direction: column;
            gap: 14px;
            min-width: 0;
        }

        .bk__pill {
            align-self: flex-start;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            color: #0B62A2;
            background: rgba(11, 98, 162, 0.08);
        }

        .bk__title {
            margin: 0;
            font-size: 26px;
            line-height: 1.3;
            font-weight: 800;
            color: #0f172a;
            padding-right: 40px;
        }

        .bk__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 20px;
            font-size: 13px;
            color: #64748b;
        }

        .bk__meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .bk__meta .material-symbols-outlined {
            font-size: 18px;
            color: #0B62A2;
        }

        .bk__text {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 14.5px;
            line-height: 1.75;
            color: #475569;
        }

        .bk__text p {
            margin: 0;
        }

        /* Sampul datar (tanpa efek 3D) khusus Karya Anggota */
        #karya-grid.is-grid .reg-card:hover {
            transform: translateY(-4px);
        }

        #karya-grid.is-grid .reg-card__img {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.18);
            transform: none;
        }

        #karya-grid.is-grid .reg-card:hover .reg-card__img {
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.26);
            transform: none;
        }

        #karya-grid.is-grid .reg-card__img::after {
            display: none;
        }

        .bk__cover {
            border-radius: 12px;
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.25);
        }

        @media (max-width: 720px) {
            .bk__panel {
                grid-template-columns: 1fr;
                gap: 22px;
                padding: 24px 20px;
            }

            .bk__cover {
                max-width: 200px;
                margin: 0 auto;
            }

            .bk__title {
                font-size: 21px;
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
                    <li>
                        <a href="berita.html" class="main-nav__link is-active" id="nav-berita">Berita &amp;
                            Informasi</a>
                    </li>
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

    <!-- ================= MAIN CONTENT ================= -->
    <main class="regulasi-page">
        <!-- Hero Section matching Regulasi Page -->
        <section class="page-hero">
            <div class="page-hero__bg" style="background-image: url('{{ \App\Support\PageBackgroundHelper::get('berita_hero', 'assets/jakarta2.jpg') }}');"></div>
            <div class="page-hero__shade"></div>
            <div class="container page-hero__container">
                <h1 class="page-hero__title">Berita &amp; Informasi</h1>
                <p class="page-hero__subtitle">Kanal informasi resmi seputar agenda kegiatan, rilis berita, publikasi
                    teknis, majalah digital, galeri dokumentasi, dan karya konsultan anggota.</p>
            </div>
        </section>

        <div class="container regulasi-page-content">

            <!-- Top Row: Tabs + Digital Library Button + Search Box -->
            <div class="regulasi-top-row">
                <div class="tab-menu" id="news-tabs">
                    <button type="button" class="tab-btn is-active" data-target="tab-agenda"
                        data-title="Agenda Kegiatan">Agenda Kegiatan</button>
                    <button type="button" class="tab-btn" data-target="tab-rilis" data-title="Rilis Berita">Rilis
                        Berita</button>
                    <button type="button" class="tab-btn" data-target="tab-publikasi"
                        data-title="Publikasi">Publikasi</button>
                    <button type="button" class="tab-btn" data-target="tab-galeri" data-title="Galeri">Galeri</button>
                    <button type="button" class="tab-btn" data-target="tab-emagazine"
                        data-title="e-Magazine">e-Magazine</button>
                    <button type="button" class="tab-btn" data-target="tab-karya" data-title="Karya Anggota">Karya
                        Anggota</button>
                </div>

                <div class="top-actions">
                    <!-- Tombol Digital Library yang redirect ke https://library.inkindo-dki.org/index.php -->
                    <a href="https://library.inkindo-dki.org/index.php" target="_blank" rel="noopener noreferrer"
                        class="digital-library-btn" id="btn-digital-library"
                        title="Kunjungi Perpustakaan Digital INKINDO DKI Jakarta">
                        <span class="material-symbols-outlined">local_library</span>
                        <span>Digital Library</span>
                        <span class="material-symbols-outlined digital-library-btn__ext">open_in_new</span>
                    </a>

                    <div class="search-box">
                        <input type="text" id="news-search-input" placeholder="Cari Berita & Informasi"
                            aria-label="Cari Berita">
                        <span class="material-symbols-outlined" id="search-icon-btn">search</span>
                    </div>
                </div>
            </div>

            <!-- Subheader: Active Category Title + View Toggle -->
            <div class="regulasi-subheader">
                <h2 id="active-category-title">Agenda Kegiatan</h2>

                <!-- View Toggle: Grid vs List (exact match with Regulasi) -->
                <div class="view-toggle">
                    <button type="button" class="view-btn is-active" data-view="grid" aria-label="Grid View">
                        Grid <span class="material-symbols-outlined">grid_view</span>
                    </button>
                    <button type="button" class="view-btn" data-view="list" aria-label="List View">
                        List <span class="material-symbols-outlined">format_list_bulleted</span>
                    </button>
                </div>
            </div>


            <!-- ================= TAB 1: AGENDA KEGIATAN ================= -->
            <div class="regulasi-content is-active" id="tab-agenda">
                <div class="view-container is-grid" id="agenda-grid"></div>
            </div>

            <!-- ================= TAB 2: RILIS BERITA ================= -->
            <div class="regulasi-content" id="tab-rilis">
                <div class="view-container is-grid" id="rilis-grid"></div>
            </div>

            <!-- ================= TAB 3: PUBLIKASI ================= -->
            <div class="regulasi-content" id="tab-publikasi">
                <div class="view-container is-grid" id="publikasi-grid"></div>
            </div>

            <!-- ================= TAB 4: GALERI ================= -->
            <div class="regulasi-content" id="tab-galeri">
                <div class="view-container is-grid" id="galeri-grid"></div>
            </div>

            <!-- ================= TAB 5: E-MAGAZINE ================= -->
            <div class="regulasi-content" id="tab-emagazine">
                <div class="view-container is-grid" id="magazine-grid"></div>
            </div>

            <!-- ================= TAB 6: KARYA ANGGOTA (buku) ================= -->
            <div class="regulasi-content" id="tab-karya">
                <div class="view-container is-grid" id="karya-grid"></div>
            </div>

            <!-- Empty Search State -->
            <div class="empty-state" id="empty-state">
                <span class="material-symbols-outlined">search_off</span>
                <h3>Belum ada konten atau tidak ada informasi yang cocok</h3>
                <p>Silakan tambahkan konten melalui menu Admin CMS atau gunakan kata kunci pencarian lain.</p>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="news-pagination" style="display: none;"></div>

        </div>
    </main>

    <!-- ================= FOOTER ================= -->
@include('partials.footer')

    <!-- Interactive Script terintegrasi Database CMS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.regulasi-content');
            const activeCategoryTitle = document.getElementById('active-category-title');
            const emptyState = document.getElementById('empty-state');
            const paginationEl = document.getElementById('news-pagination');
            const searchInput = document.getElementById('news-search-input');

            const ITEMS_PER_PAGE = 9;
            const currentPages = {};

            const esc = s => String(s || '').replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));

            let galeriItems = [];
            let karyaItems = [];

            // Modal Karya Anggota
            const karyaModal = document.createElement('div');
            karyaModal.className = 'bk';
            karyaModal.setAttribute('role', 'dialog');
            karyaModal.setAttribute('aria-modal', 'true');
            karyaModal.setAttribute('aria-labelledby', 'bk-title');
            karyaModal.id = 'karya-modal';
            karyaModal.innerHTML =
                '<div class="bk__panel"><button type="button" class="bk__close" id="bk-close" aria-label="Tutup"><span class="material-symbols-outlined">close</span></button>' +
                '<img class="bk__cover" id="bk-cover" alt="">' +
                '<div class="bk__info"><span class="bk__pill" id="bk-kind"></span><h2 class="bk__title" id="bk-title"></h2>' +
                '<div class="bk__meta"><span><span class="material-symbols-outlined">person</span><b id="bk-author"></b></span>' +
                '<span><span class="material-symbols-outlined">calendar_month</span><b id="bk-year"></b></span></div>' +
                '<div class="bk__text" id="bk-text"></div>' +
                '</div></div>';
            document.body.appendChild(karyaModal);

            function openBookModal(b) {
                if (!b) return;
                document.getElementById('bk-cover').src = b.gambar || 'assets/gambar.png';
                document.getElementById('bk-cover').alt = 'Sampul buku ' + b.judul;
                document.getElementById('bk-kind').textContent = b.kategori_label || 'Karya Anggota';
                document.getElementById('bk-title').textContent = b.judul || '';
                document.getElementById('bk-author').textContent = b.penulis || 'Anggota INKINDO DKI Jakarta';
                document.getElementById('bk-year').textContent = b.badge || b.tanggal_label || '-';
                const paragraphs = [];
                if (b.ringkasan) paragraphs.push(b.ringkasan);
                if (b.konten) {
                    b.konten.split(/\n\s*\n|\r?\n/).forEach(p => {
                        if (p.trim() && p.trim() !== (b.ringkasan || '').trim()) {
                            paragraphs.push(p.trim());
                        }
                    });
                }
                document.getElementById('bk-text').innerHTML = paragraphs.map(p => '<p>' + esc(p) + '</p>').join('');
                karyaModal.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            }

            function closeBookModal() {
                karyaModal.classList.remove('is-open');
                document.body.style.overflow = '';
            }
            document.getElementById('bk-close').addEventListener('click', closeBookModal);
            karyaModal.addEventListener('click', e => { if (e.target === karyaModal) closeBookModal(); });

            // Lightbox Galeri
            const lb = document.createElement('div');
            lb.className = 'lb';
            lb.setAttribute('role', 'dialog');
            lb.setAttribute('aria-modal', 'true');
            lb.innerHTML =
                '<div class="lb__bar"><div style="min-width:0"><h3 class="lb__title" id="lb-title"></h3>' +
                '<div class="lb__meta" id="lb-meta"></div></div>' +
                '<div style="display:flex;align-items:center;gap:12px"><span class="lb__count" id="lb-count"></span>' +
                '<button type="button" class="lb__btn" id="lb-close" aria-label="Tutup"><span class="material-symbols-outlined">close</span></button></div></div>' +
                '<div class="lb__stage" id="lb-stage">' +
                '<button type="button" class="lb__btn lb__nav lb__nav--prev" id="lb-prev" aria-label="Foto sebelumnya"><span class="material-symbols-outlined">chevron_left</span></button>' +
                '<img class="lb__img" id="lb-img" alt="">' +
                '<button type="button" class="lb__btn lb__nav lb__nav--next" id="lb-next" aria-label="Foto berikutnya"><span class="material-symbols-outlined">chevron_right</span></button></div>' +
                '<div class="lb__caption" id="lb-caption"></div><div class="lb__thumbs" id="lb-thumbs"></div>';
            document.body.appendChild(lb);

            let lbPhotos = [], lbIdx = 0, lbAlbumTitle = '';
            function showLbPhoto(i) {
                if (!lbPhotos.length) return;
                lbIdx = (i + lbPhotos.length) % lbPhotos.length;
                const img = document.getElementById('lb-img');
                img.style.animation = 'none'; void img.offsetWidth; img.style.animation = '';
                img.src = lbPhotos[lbIdx];
                img.alt = lbAlbumTitle + ' - foto ' + (lbIdx + 1);
                document.getElementById('lb-count').textContent = (lbIdx + 1) + ' / ' + lbPhotos.length;
                document.getElementById('lb-caption').textContent = lbAlbumTitle + ' — Foto ' + (lbIdx + 1) + ' dari ' + lbPhotos.length;
                document.getElementById('lb-thumbs').querySelectorAll('.lb__thumb').forEach((t, n) => {
                    t.classList.toggle('is-active', n === lbIdx);
                    if (n === lbIdx) t.scrollIntoView({ block: 'nearest', inline: 'center', behavior: 'smooth' });
                });
            }

            function openGalleryLightbox(item) {
                if (!item) return;
                lbAlbumTitle = item.judul || 'Album Dokumentasi';
                lbPhotos = Array.isArray(item.galeri_photos) && item.galeri_photos.length
                    ? item.galeri_photos
                    : [item.gambar || 'assets/gambar.png'];
                document.getElementById('lb-title').textContent = lbAlbumTitle;
                document.getElementById('lb-meta').textContent = [item.kategori_label, item.tanggal_label].filter(Boolean).join(' • ');
                document.getElementById('lb-thumbs').innerHTML = lbPhotos.map((p, n) =>
                    '<div class="lb__thumb" data-i="' + n + '" style="background-image:url(\'' + esc(p) + '\')"></div>'
                ).join('');
                lb.classList.add('is-open');
                document.body.style.overflow = 'hidden';
                showLbPhoto(0);
            }

            function closeGalleryLightbox() {
                lb.classList.remove('is-open');
                document.body.style.overflow = '';
            }
            document.getElementById('lb-close').addEventListener('click', closeGalleryLightbox);
            document.getElementById('lb-prev').addEventListener('click', () => showLbPhoto(lbIdx - 1));
            document.getElementById('lb-next').addEventListener('click', () => showLbPhoto(lbIdx + 1));
            document.getElementById('lb-thumbs').addEventListener('click', e => {
                const t = e.target.closest('.lb__thumb');
                if (t) showLbPhoto(parseInt(t.dataset.i, 10));
            });
            document.getElementById('lb-stage').addEventListener('click', e => { if (e.target.id === 'lb-stage') closeGalleryLightbox(); });
            document.addEventListener('keydown', e => {
                if (karyaModal.classList.contains('is-open') && e.key === 'Escape') closeBookModal();
                if (!lb.classList.contains('is-open')) return;
                if (e.key === 'Escape') closeGalleryLightbox();
                else if (e.key === 'ArrowLeft') showLbPhoto(lbIdx - 1);
                else if (e.key === 'ArrowRight') showLbPhoto(lbIdx + 1);
            });

            function renderStandardCard(item, dateIcon, defaultMetaIcon, defaultMetaText) {
                const badgeHtml = item.badge ? '<span class="reg-card__badge">' + esc(item.badge) + '</span>' : '';
                const metaText = item.lokasi_meta || item.penulis || defaultMetaText;
                return '<a href="' + esc(item.target_url) + '" class="reg-card" data-slug="' + esc(item.slug) + '">' +
                    '<div class="reg-card__img"><img class="reg-card__thumb" src="' + esc(item.gambar) + '" alt="' + esc(item.judul) + '">' + badgeHtml + '</div>' +
                    '<div class="reg-card__body">' +
                    '<div class="reg-card__top">' +
                    '<div class="reg-card__date"><span class="material-symbols-outlined">' + dateIcon + '</span> ' + esc(item.tanggal_label) + '</div>' +
                    '<span class="reg-card__cat-pill">' + esc(item.kategori_label) + '</span>' +
                    '</div>' +
                    '<h3 class="reg-card__title">' + esc(item.judul) + '</h3>' +
                    '<p class="reg-card__desc">' + esc(item.ringkasan) + '</p>' +
                    '<div class="reg-card__footer">' +
                    '<span class="reg-card__meta-tag"><span class="material-symbols-outlined">' + defaultMetaIcon + '</span> ' + esc(metaText) + '</span>' +
                    '<div class="reg-card__more"><span class="material-symbols-outlined">more_horiz</span></div>' +
                    '</div></div></a>';
            }

            fetch('/api/cms/berita')
                .then(r => r.json())
                .then(data => {
                    const g = (data && data.grouped) ? data.grouped : {};

                    // 1. Agenda Kegiatan
                    const agendaGrid = document.getElementById('agenda-grid');
                    if (agendaGrid) {
                        agendaGrid.innerHTML = (g.agenda || []).map(item =>
                            renderStandardCard(item, 'event', 'location_on', 'Sekretariat DPP INKINDO DKI')
                        ).join('');
                    }

                    // 2. Rilis Berita
                    const rilisGrid = document.getElementById('rilis-grid');
                    if (rilisGrid) {
                        rilisGrid.innerHTML = (g.rilis || []).map(item =>
                            renderStandardCard(item, 'calendar_today', 'verified', 'Biro Komunikasi DPP')
                        ).join('');
                    }

                    // 3. Publikasi
                    const pubGrid = document.getElementById('publikasi-grid');
                    if (pubGrid) {
                        pubGrid.innerHTML = (g.publikasi || []).map(item =>
                            renderStandardCard(item, 'calendar_today', 'article', 'Publikasi Resmi')
                        ).join('');
                    }

                    // 4. Galeri
                    galeriItems = g.galeri || [];
                    const galGrid = document.getElementById('galeri-grid');
                    if (galGrid) {
                        galGrid.innerHTML = galeriItems.map((item, idx) => {
                            const countLabel = item.badge || ((item.galeri_photos ? item.galeri_photos.length : 1) + ' Foto');
                            return '<a href="#" class="reg-card" data-galeri-index="' + idx + '" data-slug="' + esc(item.slug) + '">' +
                                '<div class="reg-card__img" style="background-image: url(\'' + esc(item.gambar) + '\');">' +
                                '<span class="reg-card__badge">' + esc(countLabel) + '</span></div>' +
                                '<div class="reg-card__body"><div class="reg-card__top">' +
                                '<div class="reg-card__date"><span class="material-symbols-outlined">photo_camera</span> ' + esc(item.tanggal_label) + '</div>' +
                                '<span class="reg-card__cat-pill">' + esc(item.kategori_label) + '</span></div>' +
                                '<h3 class="reg-card__title">' + esc(item.judul) + '</h3>' +
                                '<p class="reg-card__desc">' + esc(item.ringkasan) + '</p>' +
                                '<div class="reg-card__footer"><span class="reg-card__meta-tag"><span class="material-symbols-outlined">collections</span> ' + esc(item.lokasi_meta || 'Album Dokumentasi') + '</span>' +
                                '<div class="reg-card__more"><span class="material-symbols-outlined">more_horiz</span></div></div></div></a>';
                        }).join('');

                        galGrid.addEventListener('click', e => {
                            const card = e.target.closest('.reg-card');
                            if (!card) return;
                            e.preventDefault();
                            const idx = parseInt(card.getAttribute('data-galeri-index'), 10);
                            openGalleryLightbox(galeriItems[idx]);
                        });
                    }

                    // 5. e-Magazine
                    const magGrid = document.getElementById('magazine-grid');
                    if (magGrid) {
                        magGrid.innerHTML = (g.emagazine || []).map(m =>
                            '<a href="read-magazine.html?id=' + encodeURIComponent(m.slug) + '" class="reg-card" data-slug="' + esc(m.slug) + '">' +
                            '<div class="reg-card__img" style="background-image: url(\'' + esc(m.gambar) + '\');"><span class="reg-card__badge">' + esc(m.badge || m.kategori_label) + '</span></div>' +
                            '<div class="reg-card__body"><div class="reg-card__top"><div class="reg-card__date"><span class="material-symbols-outlined">auto_stories</span> ' + esc(m.tanggal_label) + '</div>' +
                            '<span class="reg-card__cat-pill">' + esc(m.kategori_label) + '</span></div>' +
                            '<h3 class="reg-card__title">' + esc(m.judul) + '</h3><p class="reg-card__desc">' + esc(m.ringkasan) + '</p>' +
                            '<div class="reg-card__footer"><span class="reg-card__meta-tag"><span class="material-symbols-outlined">menu_book</span> ' + esc(m.lokasi_meta || 'Baca Online') + '</span>' +
                            '<div class="reg-card__more"><span class="material-symbols-outlined">more_horiz</span></div></div></div></a>'
                        ).join('');
                    }

                    // 6. Karya Anggota
                    karyaItems = g.karya || [];
                    const karyaGrid = document.getElementById('karya-grid');
                    if (karyaGrid) {
                        karyaGrid.innerHTML = karyaItems.map((b, i) =>
                            '<a href="#" class="reg-card" data-karya-index="' + i + '" data-slug="' + esc(b.slug) + '" aria-label="Lihat deskripsi ' + esc(b.judul) + '">' +
                            '<div class="reg-card__img" style="background-image: url(\'' + esc(b.gambar) + '\');"><span class="reg-card__badge">' + esc(b.badge || b.tanggal_label) + '</span></div>' +
                            '<div class="reg-card__body"><div class="reg-card__top"><div class="reg-card__date"><span class="material-symbols-outlined">person</span> ' + esc(b.penulis || 'Anggota INKINDO DKI') + '</div>' +
                            '<span class="reg-card__cat-pill">' + esc(b.kategori_label) + '</span></div>' +
                            '<h3 class="reg-card__title">' + esc(b.judul) + '</h3><p class="reg-card__desc">' + esc(b.ringkasan) + '</p>' +
                            '<div class="reg-card__footer"><span class="reg-card__meta-tag"><span class="material-symbols-outlined">menu_book</span> ' + esc(b.lokasi_meta || 'Lihat Deskripsi') + '</span>' +
                            '<div class="reg-card__more"><span class="material-symbols-outlined">more_horiz</span></div></div></div></a>'
                        ).join('');

                        karyaGrid.addEventListener('click', e => {
                            const card = e.target.closest('.reg-card');
                            if (!card) return;
                            e.preventDefault();
                            openBookModal(karyaItems[parseInt(card.getAttribute('data-karya-index'), 10)]);
                        });
                    }

                    // Buka tab sesuai parameter ?tab=
                    const urlParams = new URLSearchParams(location.search);
                    const tabParam = urlParams.get('tab');
                    const openSlug = urlParams.get('open');
                    if (tabParam) {
                        const target = document.querySelector('.tab-btn[data-target="tab-' + tabParam + '"]');
                        if (target) target.click();
                    } else {
                        applyFilters();
                    }

                    if (openSlug) {
                        if (tabParam === 'galeri') {
                            const foundGal = galeriItems.find(x => x.slug === openSlug);
                            if (foundGal) openGalleryLightbox(foundGal);
                        } else if (tabParam === 'karya') {
                            const foundKarya = karyaItems.find(x => x.slug === openSlug);
                            if (foundKarya) openBookModal(foundKarya);
                        }
                    }
                })
                .catch(() => {
                    applyFilters();
                });

            // Switch Tab logic
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabBtns.forEach(b => b.classList.remove('is-active'));
                    tabContents.forEach(c => c.classList.remove('is-active'));

                    btn.classList.add('is-active');
                    const targetId = btn.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.add('is-active');
                    }

                    activeCategoryTitle.textContent = btn.getAttribute('data-title');

                    if (targetId) {
                        currentPages[targetId] = 1;
                    }
                    if (searchInput) {
                        searchInput.value = '';
                    }
                    applyFilters();
                });
            });

            // Grid & List View Toggle
            const viewBtns = document.querySelectorAll('.view-btn');
            const viewContainers = document.querySelectorAll('.view-container');

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

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    const activeTab = document.querySelector('.regulasi-content.is-active');
                    if (activeTab) {
                        currentPages[activeTab.id] = 1;
                    }
                    applyFilters();
                });
            }

            if (paginationEl) {
                paginationEl.addEventListener('click', e => {
                    const btn = e.target.closest('.page-item[data-page]');
                    if (!btn) return;
                    e.preventDefault();
                    if (btn.classList.contains('is-disabled') || btn.classList.contains('is-active')) return;
                    const targetPage = parseInt(btn.getAttribute('data-page'), 10);
                    const activeTab = document.querySelector('.regulasi-content.is-active');
                    if (!activeTab || isNaN(targetPage) || targetPage < 1) return;
                    currentPages[activeTab.id] = targetPage;
                    applyFilters();
                    const topRow = document.querySelector('.regulasi-top-row');
                    if (topRow) {
                        topRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            }

            function renderPagination(currentPage, totalPages, totalItems) {
                if (!paginationEl) return;
                if (totalItems === 0) {
                    paginationEl.style.display = 'none';
                    paginationEl.innerHTML = '';
                    return;
                }

                paginationEl.style.display = 'flex';
                let html = '';

                const prevDisabled = currentPage <= 1 ? ' is-disabled' : '';
                html += '<a href="#" class="page-item' + prevDisabled + '" data-page="' + (currentPage - 1) + '" aria-label="Halaman Sebelumnya">' +
                    '<span class="material-symbols-outlined" style="font-size:18px">chevron_left</span></a>';

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
                        const activeClass = p === currentPage ? ' is-active' : '';
                        html += '<a href="#" class="page-item' + activeClass + '" data-page="' + p + '">' + p + '</a>';
                    }
                });

                const nextDisabled = currentPage >= totalPages ? ' is-disabled' : '';
                html += '<a href="#" class="page-item' + nextDisabled + '" data-page="' + (currentPage + 1) + '" aria-label="Halaman Berikutnya">' +
                    '<span class="material-symbols-outlined" style="font-size:18px">chevron_right</span></a>';

                paginationEl.innerHTML = html;
            }

            function applyFilters() {
                const activeTab = document.querySelector('.regulasi-content.is-active');
                if (!activeTab) return;

                const tabId = activeTab.id;
                const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
                const cards = Array.from(activeTab.querySelectorAll('.reg-card'));
                const matchedCards = [];

                cards.forEach(card => {
                    const title = (card.querySelector('.reg-card__title')?.textContent || '').toLowerCase();
                    const desc = (card.querySelector('.reg-card__desc')?.textContent || '').toLowerCase();
                    const pill = (card.querySelector('.reg-card__cat-pill')?.textContent || '').toLowerCase();

                    const matchesQuery = (!query || title.includes(query) || desc.includes(query) || pill.includes(query));

                    if (matchesQuery) {
                        matchedCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                const itemsPerPage = (tabId === 'tab-emagazine' || tabId === 'tab-karya') ? 8 : ITEMS_PER_PAGE;
                const totalItems = matchedCards.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));
                if (!currentPages[tabId] || currentPages[tabId] > totalPages) {
                    currentPages[tabId] = 1;
                }
                const currentPage = currentPages[tabId];
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;

                matchedCards.forEach((card, idx) => {
                    if (idx >= startIdx && idx < endIdx) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (emptyState) {
                    if (totalItems === 0) {
                        emptyState.classList.add('is-visible');
                    } else {
                        emptyState.classList.remove('is-visible');
                    }
                }

                renderPagination(currentPage, totalPages, totalItems);
            }
        });
    </script>

    <script src="js/script.js?v=cerah15"></script>
</body>

</html>