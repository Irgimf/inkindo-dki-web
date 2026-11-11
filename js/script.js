(function () {
    'use strict';

    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

    /* ---------- Header: solid saat scroll ---------- */
    const header = $('#main-header');
    const onScroll = () => {
        const alwaysSolid = Boolean(header && header.hasAttribute('data-solid-header'));
        const scrolled = alwaysSolid || window.scrollY > 40;
        if (header) header.classList.toggle('is-scrolled', scrolled);
        document.body.classList.toggle('is-scrolled', scrolled);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* ---------- Klik Logo (Header & Footer) -> Redirect ke Halaman Utama ---------- */
    $$('.main-header__logo, .site-footer__logo').forEach((logoEl) => {
        logoEl.style.cursor = 'pointer';
        if (logoEl.tagName.toLowerCase() === 'a') {
            logoEl.setAttribute('href', 'index.html');
        }
        logoEl.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = 'index.html';
        });
    });

    /* ---------- Menu mobile ---------- */
    const mobileToggle = $('#mobile-toggle');
    const setMenu = (open) => {
        document.body.classList.toggle('menu-open', open);
        mobileToggle.querySelector('span').textContent = open ? 'close' : 'menu';
        document.body.style.overflow = open ? 'hidden' : '';
    };
    mobileToggle.addEventListener('click', () => setMenu(!document.body.classList.contains('menu-open')));
    $$('.main-nav__link').forEach((link) => {
        link.addEventListener('click', (e) => {
            const parent = link.parentElement;

            if (parent.classList.contains('has-dropdown')) {
                e.preventDefault();
                const wasOpen = parent.classList.contains('is-open');

                $$('.has-dropdown').forEach((d) => d.classList.remove('is-open'));
                if (!wasOpen) {
                    parent.classList.add('is-open');
                }
                return;
            }

            $$('.main-nav__link').forEach((l) => l.classList.remove('is-active'));
            link.classList.add('is-active');
            setMenu(false);
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.has-dropdown')) {
            $$('.has-dropdown').forEach((d) => d.classList.remove('is-open'));
        }
    });

    /* ---------- Search header & Live Search Engine ---------- */
    const headerSearch = $('#header-search');
    const headerSearchForm = $('#header-search-form');
    const headerSearchInput = $('#header-search-input');
    const headerSearchToggle = $('#header-search-toggle');

    const BULAN_MAP = {
        januari: 0, jan: 0,
        februari: 1, feb: 1,
        maret: 2, mar: 2,
        april: 3, apr: 3,
        mei: 4, may: 4,
        juni: 5, jun: 5,
        juli: 6, jul: 6,
        agustus: 7, agu: 7, aug: 7,
        september: 8, sep: 8, okt: 9,
        oktober: 9, oct: 9,
        november: 10, nov: 10,
        desember: 11, des: 11, dec: 11
    };

    function parseSearchDateTimestamp(isoDate, labelDate, fallbackOrder = 0) {
        if (isoDate && /^\d{4}-\d{2}-\d{2}/.test(String(isoDate))) {
            const t = Date.parse(String(isoDate).slice(0, 10) + 'T12:00:00');
            if (!Number.isNaN(t)) return t + fallbackOrder;
        }
        if (labelDate) {
            const clean = String(labelDate).toLowerCase().trim();
            const dmy = clean.match(/(\d{1,2})\s+([a-z]+)\s+(\d{4})/);
            if (dmy) {
                const day = parseInt(dmy[1], 10);
                const mon = BULAN_MAP[dmy[2]] ?? 0;
                const yr = parseInt(dmy[3], 10);
                return new Date(yr, mon, day, 12, 0, 0).getTime() + fallbackOrder;
            }
            const my = clean.match(/([a-z]+)\s+(\d{4})/);
            if (my && BULAN_MAP[my[1]] !== undefined) {
                return new Date(parseInt(my[2], 10), BULAN_MAP[my[1]], 15, 12, 0, 0).getTime() + fallbackOrder;
            }
            const yrOnly = clean.match(/\b(20\d{2})\b/);
            if (yrOnly) {
                return new Date(parseInt(yrOnly[1], 10), 5, 15, 12, 0, 0).getTime() + fallbackOrder;
            }
        }
        return fallbackOrder;
    }

    const TIPE_LABELS = {
        rilis: 'Rilis Berita',
        agenda: 'Agenda Kegiatan',
        publikasi: 'Publikasi',
        emagazine: 'e-Magazine',
        galeri: 'Galeri Foto',
        karya: 'Karya Anggota',
        mitra: 'Mitra Kerja',
        'reg-inkindo': 'Regulasi INKINDO',
        'reg-jasa': 'Regulasi Jasa Konsultasi',
        'reg-terkait': 'Regulasi Terkait',
        anggota: 'Anggota Terdaftar'
    };

    const REGULASI_DATA = [
        {
            id: 'ad-art-inkindo',
            tipe: 'reg-inkindo',
            kategoriLabel: 'Regulasi INKINDO',
            badge: 'Dokumen Utama',
            judul: 'Anggaran Dasar / Anggaran Rumah Tangga (AD/ART) INKINDO',
            ringkasan: 'Landasan konstitusional organisasi yang mengatur tujuan, struktur kepengurusan, hak dan kewajiban anggota, serta mekanisme musyawarah nasional dan provinsi INKINDO.',
            metaInfo: 'Dokumen Organisasi • PDF',
            tanggal: '2026-01-15',
            tanggalLabel: 'Pembaruan 2026',
            fileUrl: 'assets/files/regulasi/ad-art-inkindo.pdf',
            tabId: 'reg-inkindo'
        },
        {
            id: 'kode-etik-inkindo',
            tipe: 'reg-inkindo',
            kategoriLabel: 'Regulasi INKINDO',
            badge: 'Etika Profesi',
            judul: 'Kode Etik Anggota INKINDO',
            ringkasan: 'Pedoman moral, integritas, dan tata perilaku profesional yang wajib dipatuhi seluruh badan usaha anggota INKINDO dalam menjalankan praktik layanan jasa konsultansi.',
            metaInfo: 'Pedoman Etika • PDF',
            tanggal: '2026-01-12',
            tanggalLabel: 'Pembaruan 2026',
            fileUrl: 'assets/files/regulasi/kode-etik-inkindo.pdf',
            tabId: 'reg-inkindo'
        },
        {
            id: 'po-provinsi-dki',
            tipe: 'reg-inkindo',
            kategoriLabel: 'Regulasi INKINDO',
            badge: 'Tata Kelola',
            judul: 'Pedoman Organisasi Provinsi INKINDO DKI Jakarta',
            ringkasan: 'Aturan teknis penyelenggaraan tata kelola organisasi, pelayanan keanggotaan, dan koordinasi program kerja di lingkungan DPP INKINDO Provinsi DKI Jakarta.',
            metaInfo: 'DPP DKI Jakarta • PDF',
            tanggal: '2026-01-10',
            tanggalLabel: 'Pembaruan 2026',
            fileUrl: 'assets/files/regulasi/po-inkindo-dki.pdf',
            tabId: 'reg-inkindo'
        },
        {
            id: 'uu-no-2-tahun-2017',
            tipe: 'reg-jasa',
            kategoriLabel: 'Regulasi Jasa Konsultasi',
            badge: 'Konstruksi',
            judul: 'UU No. 2 Tahun 2017 tentang Jasa Konstruksi',
            ringkasan: 'Payung hukum penyelenggaraan jasa konstruksi nasional, mencakup kualifikasi usaha, sertifikasi badan usaha (SBU), tanggung jawab penyedia jasa, dan pembinaan konstruksi.',
            metaInfo: 'Undang-Undang RI • Konstruksi',
            tanggal: '2026-02-05',
            tanggalLabel: 'Regulasi Nasional',
            fileUrl: 'assets/files/regulasi/uu-no-2-tahun-2017.pdf',
            tabId: 'reg-jasa'
        },
        {
            id: 'pedoman-non-konstruksi',
            tipe: 'reg-jasa',
            kategoriLabel: 'Regulasi Jasa Konsultasi',
            badge: 'Non-Konstruksi',
            judul: 'Pedoman Pengadaan Jasa Konsultansi Non Konstruksi',
            ringkasan: 'Ketentuan teknis pelaksanaan seleksi, penyusunan KAK/TOR, serta evaluasi teknis dan biaya untuk pekerjaan jasa konsultansi bidang studi, manajemen, dan teknologi informasi.',
            metaInfo: 'Pedoman Teknis • Non-Konstruksi',
            tanggal: '2026-02-03',
            tanggalLabel: 'Pedoman Nasional',
            fileUrl: 'assets/files/regulasi/pedoman-non-konstruksi.pdf',
            tabId: 'reg-jasa'
        },
        {
            id: 'billing-rate-2026',
            tipe: 'reg-jasa',
            kategoriLabel: 'Regulasi Jasa Konsultasi',
            badge: 'Standar Biaya',
            judul: 'Standar Remunerasi (Billing Rate) Jasa Konsultansi 2026',
            ringkasan: 'Acuan resmi perhitungan biaya langsung personil (tenaga ahli dan pendukung) jasa konsultansi konstruksi dan non-konstruksi berdasarkan indeks provinsi tahun 2026.',
            metaInfo: 'INKINDO Nasional • Tahun 2026',
            tanggal: '2026-02-20',
            tanggalLabel: 'Edisi 2026',
            fileUrl: 'assets/files/regulasi/billing-rate-2026.pdf',
            tabId: 'reg-jasa'
        },
        {
            id: 'pp-no-22-tahun-2020',
            tipe: 'reg-jasa',
            kategoriLabel: 'Regulasi Jasa Konsultasi',
            badge: 'Konstruksi',
            judul: 'PP No. 22 Tahun 2020 tentang Peraturan Pelaksanaan UU Jasa Konstruksi',
            ringkasan: 'Peraturan pemerintah mengenai struktur usaha, perizinan berusaha berbasis risiko, pengembangan jasa konstruksi berkelanjutan, dan sanksi administratif.',
            metaInfo: 'Peraturan Pemerintah • Konstruksi',
            tanggal: '2026-01-25',
            tanggalLabel: 'Regulasi Nasional',
            fileUrl: 'assets/files/regulasi/pp-no-22-tahun-2020.pdf',
            tabId: 'reg-jasa'
        },
        {
            id: 'standar-biaya-2026',
            tipe: 'reg-jasa',
            kategoriLabel: 'Regulasi Jasa Konsultasi',
            badge: 'Standar Biaya',
            judul: 'Standar Biaya Langsung Personil & Non Personil 2026',
            ringkasan: 'Pedoman penyusunan Rencana Anggaran Biaya (RAB) dan Harga Perkiraan Sendiri (HPS) pekerjaan konsultansi meliputi komponen remunerasi dan biaya operasional langsung.',
            metaInfo: 'Pedoman Biaya • Tahun 2026',
            tanggal: '2026-02-18',
            tanggalLabel: 'Edisi 2026',
            fileUrl: 'assets/files/regulasi/standar-biaya-2026.pdf',
            tabId: 'reg-jasa'
        },
        {
            id: 'perlem-lkpp-12-2021',
            tipe: 'reg-terkait',
            kategoriLabel: 'Regulasi Terkait',
            badge: 'Pengadaan',
            judul: 'Peraturan LKPP No. 12 Tahun 2021 tentang Pedoman Pengadaan Barang/Jasa Pemerintah',
            ringkasan: 'Aturan pelaksanaan pengadaan jasa konsultansi melalui penyedia, tahapan persiapan pemilihan, kualifikasi, hingga pelaksanaan kontrak pengadaan pemerintah.',
            metaInfo: 'Peraturan LKPP • Pengadaan',
            tanggal: '2026-01-20',
            tanggalLabel: 'Regulasi Pengadaan',
            fileUrl: 'assets/files/regulasi/perlem-lkpp-12-2021.pdf',
            tabId: 'reg-terkait'
        },
        {
            id: 'permen-pupr-10-2021',
            tipe: 'reg-terkait',
            kategoriLabel: 'Regulasi Terkait',
            badge: 'K3 Konstruksi',
            judul: 'Peraturan Menteri PUPR No. 10 Tahun 2021 tentang Pedoman SMKK',
            ringkasan: 'Pedoman Sistem Manajemen Keselamatan Konstruksi (SMKK) yang wajib diterapkan dalam setiap tahapan konsultansi perencanaan, perancangan, dan pengawasan konstruksi.',
            metaInfo: 'Permen PUPR • SMKK',
            tanggal: '2026-01-18',
            tanggalLabel: 'Regulasi PUPR',
            fileUrl: 'assets/files/regulasi/permen-pupr-10-2021.pdf',
            tabId: 'reg-terkait'
        }
    ];

    let cachedSearchItems = null;
    let searchLoadPromise = null;

    async function loadAllSearchableItems() {
        if (cachedSearchItems) return cachedSearchItems;
        if (searchLoadPromise) return searchLoadPromise;

        searchLoadPromise = (async () => {
            const items = [];
            const [beritaRes, mitraRes] = await Promise.allSettled([
                fetch('/api/cms/berita', { headers: { 'Accept': 'application/json' } }),
                fetch('/api/mitra', { headers: { 'Accept': 'application/json' } })
            ]);

            // 1. Berita & Informasi
            if (beritaRes.status === 'fulfilled' && beritaRes.value.ok) {
                try {
                    const bData = await beritaRes.value.json();
                    let allBerita = [];
                    if (Array.isArray(bData.items)) {
                        allBerita = bData.items;
                    } else if (Array.isArray(bData.all)) {
                        allBerita = bData.all;
                    } else if (bData.grouped && typeof bData.grouped === 'object') {
                        Object.values(bData.grouped).forEach((arr) => {
                            if (Array.isArray(arr)) allBerita.push(...arr);
                        });
                    }

                    allBerita.forEach((b, idx) => {
                        const tipe = String(b.tipe || 'rilis').toLowerCase();
                        const tipeName = TIPE_LABELS[tipe] || 'Berita & Informasi';
                        const ts = parseSearchDateTimestamp(b.tanggal, b.tanggal_label || b.badge, (2000 - idx));
                        items.push({
                            uid: 'berita-' + (b.id || idx),
                            source: 'berita',
                            tipe: tipe,
                            tipeLabel: tipeName,
                            kategoriLabel: b.kategori_label || tipeName,
                            badge: b.badge || '',
                            judul: String(b.judul || ''),
                            ringkasan: String(b.ringkasan || ''),
                            metaInfo: String(b.lokasi_meta || b.penulis || tipeName),
                            tanggal: String(b.tanggal || ''),
                            tanggalLabel: String(b.tanggal_label || b.badge || 'Terbaru'),
                            timestamp: ts,
                            gambar: String(b.gambar || 'assets/gambar.png'),
                            targetUrl: String(b.target_url || 'berita.html'),
                            searchText: [
                                'berita informasi',
                                b.judul,
                                b.kategori_label,
                                tipeName,
                                b.badge,
                                b.ringkasan,
                                b.konten,
                                b.penulis,
                                b.lokasi_meta,
                                b.tanggal_label
                            ].filter(Boolean).join(' ').toLowerCase()
                        });
                    });
                } catch (err) {
                    console.error('Gagal memproses data pencarian berita:', err);
                }
            }

            // 2. Mitra Kerja
            if (mitraRes.status === 'fulfilled' && mitraRes.value.ok) {
                try {
                    const mData = await mitraRes.value.json();
                    const allMitra = Array.isArray(mData.mitra) ? mData.mitra : [];
                    allMitra.forEach((m, idx) => {
                        const prodNames = Array.isArray(m.products)
                            ? m.products.map(p => [p.nama_produk, p.kategori_produk, p.deskripsi_produk].filter(Boolean).join(' ')).join(' ')
                            : '';
                        const prodPreview = Array.isArray(m.products) && m.products.length > 0
                            ? 'Produk: ' + m.products.map(p => p.nama_produk).filter(Boolean).slice(0, 3).join(', ')
                            : '';
                        const desc = (m.deskripsi && m.deskripsi !== '-')
                            ? m.deskripsi
                            : (prodPreview || m.kategori_bisnis || 'Mitra Kerja Resmi DPP INKINDO DKI Jakarta');
                        const ts = parseSearchDateTimestamp(m.tanggal, m.tanggal_label, (1200 - idx));

                        items.push({
                            uid: 'mitra-' + (m.id || idx),
                            source: 'mitra',
                            tipe: 'mitra',
                            tipeLabel: 'Mitra Kerja',
                            kategoriLabel: m.kategori_bisnis || 'Mitra Kerja',
                            badge: 'Mitra Kerja',
                            judul: String(m.nama_perusahaan || ''),
                            ringkasan: String(desc),
                            metaInfo: String(m.kategori_bisnis || 'Mitra Strategis INKINDO'),
                            tanggal: String(m.tanggal || ''),
                            tanggalLabel: String(m.tanggal_label || 'Mitra Resmi'),
                            timestamp: ts,
                            gambar: String(m.logo || 'assets/logo-inkindo.png'),
                            targetUrl: String(m.target_url || ('/mitra-kerja/' + encodeURIComponent(m.slug || m.id))),
                            products: Array.isArray(m.products) ? m.products : [],
                            searchText: [
                                'mitra kerja',
                                m.nama_perusahaan,
                                m.kategori_bisnis,
                                m.deskripsi,
                                m.alamat,
                                prodNames
                            ].filter(Boolean).join(' ').toLowerCase()
                        });
                    });
                } catch (err) {
                    console.error('Gagal memproses data pencarian mitra:', err);
                }
            }

            // 3. Regulasi (INKINDO, Jasa Konsultasi, Regulasi Terkait)
            REGULASI_DATA.forEach((reg, idx) => {
                const ts = parseSearchDateTimestamp(reg.tanggal, reg.tanggalLabel, (900 - idx));
                items.push({
                    uid: 'regulasi-' + reg.id,
                    source: 'regulasi',
                    tipe: reg.tipe,
                    tipeLabel: reg.kategoriLabel,
                    kategoriLabel: reg.kategoriLabel,
                    badge: reg.badge,
                    judul: reg.judul,
                    ringkasan: reg.ringkasan,
                    metaInfo: reg.metaInfo,
                    tanggal: reg.tanggal,
                    tanggalLabel: reg.tanggalLabel,
                    timestamp: ts,
                    gambar: '',
                    fileUrl: reg.fileUrl,
                    targetUrl: 'regulasi.html?tab=' + encodeURIComponent(reg.tabId) + '&q=' + encodeURIComponent(reg.judul),
                    searchText: [
                        'regulasi peraturan hukum pedoman standar',
                        reg.judul,
                        reg.kategoriLabel,
                        reg.badge,
                        reg.ringkasan,
                        reg.metaInfo
                    ].filter(Boolean).join(' ').toLowerCase()
                });
            });

            // Urutkan berdasarkan tanggal terbaru berurutan (descending)
            items.sort((a, b) => b.timestamp - a.timestamp);
            cachedSearchItems = items;
            return items;
        })();

        return searchLoadPromise;
    }

    function escapeHtmlStr(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function highlightSearchTerm(text, query) {
        const safeText = escapeHtmlStr(text);
        const cleanQ = String(query ?? '').trim();
        if (!cleanQ) return safeText;
        const escapedRegex = cleanQ.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        try {
            const re = new RegExp(`(${escapedRegex})`, 'gi');
            return safeText.replace(re, '<mark class="header-search__highlight">$1</mark>');
        } catch (_) {
            return safeText;
        }
    }

    function filterAndSortSearchItems(items, rawQuery, sourceFilter = 'all', tipeFilter = 'all') {
        const q = String(rawQuery ?? '').toLowerCase().trim();
        const tokens = q ? q.split(/\s+/).filter(Boolean) : [];

        const matched = items.filter((item) => {
            if (sourceFilter !== 'all' && item.source !== sourceFilter) return false;
            if (tipeFilter !== 'all' && item.tipe !== tipeFilter) return false;
            if (tokens.length === 0) return true;
            return tokens.every((tok) => item.searchText.includes(tok));
        });

        // Pastikan berurutan sesuai tanggal terbaru (descending)
        matched.sort((a, b) => b.timestamp - a.timestamp);
        return matched;
    }

    window.InkindoSearchEngine = {
        loadAllItems: loadAllSearchableItems,
        filterAndSort: filterAndSortSearchItems,
        highlight: highlightSearchTerm,
        escapeHtml: escapeHtmlStr
    };

    // Inisialisasi UI Search Bar (Desain Original Underline Pendek) & Dropdown Max 6 Hasil
    let searchDropdownEl = null;

    if (headerSearchForm && headerSearchInput) {
        searchDropdownEl = document.createElement('div');
        searchDropdownEl.className = 'header-search__dropdown';
        searchDropdownEl.id = 'header-search-dropdown';
        headerSearchForm.appendChild(searchDropdownEl);

        const renderHeaderDropdown = async () => {
            const rawVal = headerSearchInput.value;
            const q = rawVal.trim();

            if (!q) {
                searchDropdownEl.classList.remove('is-visible');
                searchDropdownEl.innerHTML = '';
                return;
            }

            const allItems = await loadAllSearchableItems();
            const matched = filterAndSortSearchItems(allItems, q);
            const totalMatched = matched.length;
            const topSix = matched.slice(0, 6);
            const shownCount = topSix.length;
            const searchPageUrl = 'pencarian.html?q=' + encodeURIComponent(q);

            if (totalMatched === 0) {
                searchDropdownEl.innerHTML = `
                    <div class="header-search__meta">
                        <span>Menampilkan <strong>0</strong> dari <strong>0</strong> pencarian yang sesuai</span>
                    </div>
                    <div class="header-search__empty">
                        <span class="material-symbols-outlined">search_off</span>
                        Tidak ditemukan hasil untuk kata kunci <strong>"${escapeHtmlStr(q)}"</strong>
                    </div>
                    <div class="header-search__footer">
                        <a href="${searchPageUrl}" class="header-search__all-btn">
                            Buka Halaman Pencarian Lengkap
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                    </div>
                `;
                searchDropdownEl.classList.add('is-visible');
                return;
            }

            const listHtml = topSix.map((item) => {
                let badgeClass = 'header-search__badge';
                let badgeText = item.tipeLabel || 'Berita & Informasi';
                let mediaHtml = '';

                if (item.source === 'mitra') {
                    badgeClass = 'header-search__badge header-search__badge--mitra';
                    badgeText = 'Mitra Kerja';
                    mediaHtml = `<img src="${escapeHtmlStr(item.gambar)}" alt="${escapeHtmlStr(item.judul)}" class="header-search__thumb header-search__thumb--mitra">`;
                } else if (item.source === 'regulasi') {
                    badgeClass = 'header-search__badge header-search__badge--regulasi';
                    badgeText = item.kategoriLabel || 'Regulasi';
                    mediaHtml = `<div class="header-search__icon-box header-search__icon-box--regulasi"><span class="material-symbols-outlined">gavel</span></div>`;
                } else {
                    mediaHtml = `<img src="${escapeHtmlStr(item.gambar)}" alt="${escapeHtmlStr(item.judul)}" class="header-search__thumb">`;
                }

                return `
                    <a href="${escapeHtmlStr(item.targetUrl)}" class="header-search__item">
                        ${mediaHtml}
                        <div class="header-search__info">
                            <div class="header-search__top-row">
                                <span class="${badgeClass}">${escapeHtmlStr(badgeText)}</span>
                                <span class="header-search__date">
                                    <span class="material-symbols-outlined" style="font-size: 12px;">schedule</span>
                                    ${escapeHtmlStr(item.tanggalLabel)}
                                </span>
                            </div>
                            <h4 class="header-search__title">${highlightSearchTerm(item.judul, q)}</h4>
                            <p class="header-search__desc">${highlightSearchTerm(item.ringkasan, q)}</p>
                        </div>
                        <span class="material-symbols-outlined header-search__arrow">chevron_right</span>
                    </a>
                `;
            }).join('');

            searchDropdownEl.innerHTML = `
                <div class="header-search__meta">
                    <span>Menampilkan <strong>${shownCount}</strong> dari <strong>${totalMatched}</strong> pencarian yang sesuai</span>
                </div>
                <div class="header-search__list">
                    ${listHtml}
                </div>
                <div class="header-search__footer">
                    <a href="${searchPageUrl}" class="header-search__all-btn">
                        Lihat Semua Hasil Pencarian (${totalMatched})
                        <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                    </a>
                </div>
            `;
            searchDropdownEl.classList.add('is-visible');
        };

        headerSearchInput.addEventListener('input', renderHeaderDropdown);
        headerSearchInput.addEventListener('focus', () => {
            loadAllSearchableItems();
            if (headerSearchInput.value.trim()) {
                renderHeaderDropdown();
            }
        });
    }

    if (headerSearchToggle && headerSearch) {
        headerSearchToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            setMenu(false);
            headerSearch.classList.toggle('is-open');
            if (headerSearch.classList.contains('is-open')) {
                header.classList.add('is-scrolled');
                loadAllSearchableItems();
                setTimeout(() => {
                    if (headerSearchInput) headerSearchInput.focus();
                }, 220);
            } else {
                if (searchDropdownEl) searchDropdownEl.classList.remove('is-visible');
                onScroll();
            }
        });
    }

    document.addEventListener('click', (e) => {
        if (headerSearch && headerSearch.classList.contains('is-open')) {
            if (!e.target.closest('#header-search') && !e.target.closest('#header-search-toggle') && !e.target.closest('#hero-search-btn')) {
                headerSearch.classList.remove('is-open');
                if (searchDropdownEl) searchDropdownEl.classList.remove('is-visible');
                onScroll();
            }
        }
    });

    /* ---------- Language switch (visual) ---------- */
    $$('.lang-switch__btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            $$('.lang-switch__btn').forEach((b) => b.classList.remove('is-active'));
            btn.classList.add('is-active');
        });
    });

    /* ---------- Side nav + panel ---------- */
    const panel = $('#side-panel');
    const overlay = $('#overlay');
    const sideLinks = $$('.side-nav__link');
    let currentPanel = null;

    const openPanel = (name) => {
        if (currentPanel === name) return closePanel();
        currentPanel = name;
        sideLinks.forEach((l) => l.classList.toggle('is-active', l.dataset.panel === name));
        $$('.side-panel__content', panel).forEach((c) =>
            c.classList.toggle('is-active', c.dataset.content === name));
        panel.classList.add('is-open');
        document.body.classList.add('panel-open');
        panel.setAttribute('aria-hidden', 'false');
        overlay.classList.add('is-visible');
        if (name === 'chat') initChat();
    };

    const closePanel = () => {
        currentPanel = null;
        sideLinks.forEach((l) => l.classList.remove('is-active'));
        panel.classList.remove('is-open');
        document.body.classList.remove('panel-open');
        panel.setAttribute('aria-hidden', 'true');
        overlay.classList.remove('is-visible');
    };

    sideLinks.forEach((link) => link.addEventListener('click', () => openPanel(link.dataset.panel)));
    $$('[data-open-panel]').forEach((el) =>
        el.addEventListener('click', (e) => {
            e.preventDefault();
            openPanel(el.dataset.openPanel);
        }));
    $('#side-panel-close').addEventListener('click', closePanel);
    overlay.addEventListener('click', closePanel);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closePanel();
            setMenu(false);
            headerSearch.classList.remove('is-open');
            if (window.closeDaftarMitraModal) window.closeDaftarMitraModal();
            if (window.closeKlinikKonsultasiModal) window.closeKlinikKonsultasiModal();
        }
    });

    /* ---------- Hero: Efek Mengetik Teks Animasi (Sesuai referensi gambar) ---------- */
    const heroTextEl = $('#hero-type-text');
    if (heroTextEl) {
        const phrases = [
            'Selamat Datang',
            'DPP INKINDO DKI Jakarta',
            'Ekosistem Konsultansi Digital',
            'Solusi Jasa Konsultansi Terpercaya',
            'Integritas, Inovasi & Profesionalisme'
        ];
        let pIndex = 0;
        let cIndex = phrases[0].length; // Mulai langsung dari 'Selamat Datang' penuh
        let deleting = false;

        const typeLoop = () => {
            const word = phrases[pIndex];
            heroTextEl.textContent = word.slice(0, cIndex);

            let delay = deleting ? 45 : 85;

            if (!deleting && cIndex === word.length) {
                delay = 2400; // Tahan lama saat teks lengkap
                deleting = true;
            } else if (deleting && cIndex === 0) {
                deleting = false;
                pIndex = (pIndex + 1) % phrases.length;
                delay = 450;
            } else {
                cIndex += deleting ? -1 : 1;
            }

            setTimeout(typeLoop, delay);
        };

        // Mulai animasi menghapus dan mengetik frase berikutnya setelah jeda pembuka
        setTimeout(() => {
            deleting = true;
            typeLoop();
        }, 2200);
    }

    /* Tombol pencarian hero: memicu pencarian header (jika tombol ada) */
    const heroSearchBtn = $('#hero-search-btn');
    if (heroSearchBtn) {
        heroSearchBtn.addEventListener('click', () => {
            const headerToggle = $('#header-search-toggle');
            if (headerToggle) {
                headerToggle.click();
            } else {
                const headerSearch = $('#header-search');
                if (headerSearch) headerSearch.classList.add('is-open');
            }
        });
    }

    /* ---------- Hero Background: Random on Load & Auto-Rotate Tiap 5 Menit (index.html) ---------- */
    const heroBgA = $('#hero-bg-a');
    const heroBgB = $('#hero-bg-b');
    if (heroBgA && heroBgB) {
        const jakartaImages = Array.isArray(window.__JAKARTA_HERO_IMAGES) && window.__JAKARTA_HERO_IMAGES.length > 0
            ? window.__JAKARTA_HERO_IMAGES
            : [
                'assets/jakartahome1.jpg',
                'assets/jakartahome3.jpg'
            ];

        let currentIndex = typeof window.__currentJakartaBgIndex === 'number'
            ? window.__currentJakartaBgIndex
            : Math.floor(Math.random() * jakartaImages.length);

        if (!heroBgA.style.backgroundImage) {
            heroBgA.style.backgroundImage = `url('${jakartaImages[currentIndex]}')`;
        }

        let activeLayer = 'a';

        const changeHeroBg = () => {
            // Pilih acak gambar berikutnya dari daftar jakarta*.jpg yang berbeda dari saat ini
            let nextIndex = Math.floor(Math.random() * (jakartaImages.length - 1));
            if (nextIndex >= currentIndex) nextIndex++;
            currentIndex = nextIndex;

            const nextSrc = jakartaImages[currentIndex];

            // Preload gambar terlebih dahulu sebelum cross-fade agar transisi mulus
            const imgLoader = new Image();
            imgLoader.onload = () => {
                if (activeLayer === 'a') {
                    heroBgB.style.backgroundImage = `url('${nextSrc}')`;
                    heroBgB.style.opacity = '1';
                    heroBgA.style.opacity = '0';
                    activeLayer = 'b';
                } else {
                    heroBgA.style.backgroundImage = `url('${nextSrc}')`;
                    heroBgA.style.opacity = '1';
                    heroBgB.style.opacity = '0';
                    activeLayer = 'a';
                }
            };
            imgLoader.src = nextSrc;
        };

        // Ganti background otomatis setiap 5 menit (5 * 60 * 1000 milidetik = 300.000 ms)
        const ROTATE_INTERVAL_MS = 5 * 60 * 1000;
        setInterval(changeHeroBg, ROTATE_INTERVAL_MS);

        // Helper global untuk verifikasi & testing
        window.changeJakartaHeroBg = changeHeroBg;

        // Preload seluruh gambar jakarta lainnya secara bertahap di background
        setTimeout(() => {
            jakartaImages.forEach((src) => {
                const img = new Image();
                img.src = src;
            });
        }, 2000);
    }

    /* Submit form pencarian header (Enter / Klik tombol cari) -> Pindah ke halaman khusus pencarian.html */
    if (headerSearchForm) {
        headerSearchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const q = headerSearchInput ? headerSearchInput.value.trim() : '';
            window.location.href = q ? ('pencarian.html?q=' + encodeURIComponent(q)) : 'pencarian.html';
        });
    }

    /* ---------- Hero carousel ---------- */
    const carousel = $('#hero-carousel');
    if (carousel) {
        const track = $('.carousel__track', carousel);
        const slides = $$('.carousel__slide', carousel);
        const dotsWrap = $('#carousel-dots');
        let slideIndex = 0;
        let autoTimer;

        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'carousel__dot' + (i === 0 ? ' is-active' : '');
            dot.setAttribute('aria-label', 'Slide ' + (i + 1));
            dot.addEventListener('click', () => goTo(i, true));
            dotsWrap.appendChild(dot);
        });
        const dots = $$('.carousel__dot', dotsWrap);

        const goTo = (i, user = false) => {
            slideIndex = (i + slides.length) % slides.length;
            track.style.transform = `translateX(-${slideIndex * 100}%)`;
            dots.forEach((d, n) => d.classList.toggle('is-active', n === slideIndex));
            if (user) restartAuto();
        };
        const restartAuto = () => {
            clearInterval(autoTimer);
            autoTimer = setInterval(() => goTo(slideIndex + 1), 5000);
        };

        $('#carousel-prev').addEventListener('click', () => goTo(slideIndex - 1, true));
        $('#carousel-next').addEventListener('click', () => goTo(slideIndex + 1, true));
        carousel.addEventListener('mouseenter', () => clearInterval(autoTimer));
        carousel.addEventListener('mouseleave', restartAuto);

        // Swipe untuk layar sentuh
        let touchX = null;
        carousel.addEventListener('touchstart', (e) => { touchX = e.touches[0].clientX; }, { passive: true });
        carousel.addEventListener('touchend', (e) => {
            if (touchX === null) return;
            const dx = e.changedTouches[0].clientX - touchX;
            if (Math.abs(dx) > 40) goTo(slideIndex + (dx < 0 ? 1 : -1), true);
            touchX = null;
        });
        restartAuto();
    }

    /* ---------- Ticker statistik ---------- */
    const tickerItems = $$('.ticker__item');
    if (tickerItems.length > 0 && $('#ticker-prev') && $('#ticker-next')) {
        let tickIndex = 0;
        let tickTimer;

        const showTick = (i) => {
            const prev = tickerItems[tickIndex];
            tickIndex = (i + tickerItems.length) % tickerItems.length;
            if (prev === tickerItems[tickIndex]) return;
            prev.classList.remove('is-active');
            prev.classList.add('is-leaving');
            setTimeout(() => prev.classList.remove('is-leaving'), 450);
            tickerItems[tickIndex].classList.add('is-active');
        };
        const restartTicker = () => {
            clearInterval(tickTimer);
            tickTimer = setInterval(() => showTick(tickIndex + 1), 3500);
        };
        $('#ticker-prev').addEventListener('click', () => { showTick(tickIndex - 1); restartTicker(); });
        $('#ticker-next').addEventListener('click', () => { showTick(tickIndex + 1); restartTicker(); });
        restartTicker();
    }

    /* ---------- Reveal saat scroll ---------- */
    const reveals = $$('.reveal');
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        reveals.forEach((el, i) => {
            el.style.transitionDelay = (i * 0.1) + 's';
            io.observe(el);
        });
    } else {
        reveals.forEach((el) => el.classList.add('is-visible'));
    }

    /* ---------- Chat sederhana ---------- */
    const chatBody = $('#chat-body');
    const chatForm = $('#chat-form');
    const chatInput = $('#chat-input');
    let chatStarted = false;

    const replies = [
        {
            keys: ['daftar', 'anggota', 'registrasi', 'kta'],
            text: 'Untuk menjadi anggota, siapkan akta pendirian, NIB, dan NPWP badan usaha, lalu lakukan registrasi melalui Portal KTA. Tim sekretariat akan memverifikasi berkas Anda.'
        },
        {
            keys: ['sbu', 'sertifikat', 'lpjk'],
            text: 'Untuk informasi dan pendampingan pengurusan Sertifikat Badan Usaha (SBU) serta regulasi LPJK, anggota dapat mengajukan jadwal melalui menu Klinik Konsultasi atau menghubungi sekretariat di +62217942940.'
        },
        {
            keys: ['jam', 'operasional', 'buka'],
            text: 'Sekretariat DPP INKINDO DKI Jakarta buka Senin - Jumat pukul 08.00 - 16.30 WIB.'
        },
        {
            keys: ['alamat', 'lokasi', 'kantor'],
            text: 'Sekretariat kami berada di Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760.'
        },
        {
            keys: ['lelang', 'tender'],
            text: 'Informasi lelang dapat dipantau melalui menu Info Lelang di sisi kanan, termasuk LPSE DKI Jakarta dan SPSE LKPP.'
        },
        {
            keys: ['konsultasi', 'klinik'],
            text: 'Klinik Konsultasi tersedia gratis untuk anggota. Silakan buka menu Klinik Konsultasi untuk mengajukan jadwal.'
        }
    ];

    const addMsg = (text, who) => {
        const el = document.createElement('div');
        el.className = 'chat-msg chat-msg--' + who;
        el.textContent = text;
        chatBody.appendChild(el);
        chatBody.scrollTop = chatBody.scrollHeight;
        return el;
    };

    const botReply = (text) => {
        const typing = document.createElement('div');
        typing.className = 'chat-msg chat-msg--bot chat-msg--typing';
        typing.innerHTML = '<i></i><i></i><i></i>';
        chatBody.appendChild(typing);
        chatBody.scrollTop = chatBody.scrollHeight;
        setTimeout(() => {
            typing.remove();
            addMsg(text, 'bot');
        }, 800);
    };

    const answer = (q) => {
        const lower = q.toLowerCase();
        const hit = replies.find((r) => r.keys.some((k) => lower.includes(k)));
        return hit
            ? hit.text
            : 'Terima kasih atas pertanyaannya. Untuk informasi lebih lanjut, hubungi sekretariat di +62217942940 atau email sekretariat@inkindo-dki.org.';
    };

    const sendUser = (text) => {
        if (!text.trim()) return;
        addMsg(text, 'user');
        botReply(answer(text));
    };

    function initChat() {
        if (chatStarted) return;
        chatStarted = true;
        botReply('Halo! Saya Asisten INKINDO DKI Jakarta. Ada yang bisa saya bantu hari ini?');
        setTimeout(() => chatInput.focus(), 450);
    }

    if (chatForm && chatInput) {
        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            sendUser(chatInput.value);
            chatInput.value = '';
        });
    }
    $$('.chat-quick__btn').forEach((btn) =>
        btn.addEventListener('click', () => sendUser(btn.textContent)));

    /* ---------- Modal Daftar Mitra Kerja ---------- */
    function ensureMitraModal() {
        let modalEl = document.getElementById('daftar-mitra-modal');
        if (!modalEl) {
            modalEl = document.createElement('div');
            modalEl.id = 'daftar-mitra-modal';
            modalEl.className = 'daftar-mitra-modal-overlay';
            modalEl.setAttribute('role', 'dialog');
            modalEl.setAttribute('aria-modal', 'true');
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.innerHTML = `
                <div class="daftar-mitra-modal-card">
                    <div class="daftar-mitra-modal-header">
                        <div class="daftar-mitra-header-left">
                            <div class="daftar-mitra-header-icon">
                                <span class="material-symbols-outlined">how_to_reg</span>
                            </div>
                            <div>
                                <h3 class="daftar-mitra-modal-title">Formulir Pendaftaran Mitra Kerja</h3>
                                <p class="daftar-mitra-modal-subtitle">Bergabung sebagai mitra strategis DPP INKINDO DKI Jakarta</p>
                            </div>
                        </div>
                        <button type="button" class="daftar-mitra-modal-close" onclick="closeDaftarMitraModal()" aria-label="Tutup modal">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <form id="form-daftar-mitra-inner" onsubmit="handleDaftarMitraSubmit(event)">
                        <div class="daftar-mitra-modal-body" id="mitra-modal-form-body">
                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="mitra-perusahaan">Nama Perusahaan <span class="req">*</span></label>
                                <div class="mitra-input-wrapper">
                                    <span class="material-symbols-outlined mitra-input-icon">apartment</span>
                                    <input type="text" id="mitra-perusahaan" class="mitra-form-input" placeholder="Contoh: PT Bangun Rekayasa Mandiri" required>
                                </div>
                            </div>

                            <div class="mitra-form-row">
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="mitra-email">Email Perusahaan <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">mail</span>
                                        <input type="email" id="mitra-email" class="mitra-form-input" placeholder="info@perusahaan.co.id" required>
                                    </div>
                                </div>
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="mitra-telp">No. Telp Perusahaan <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">call</span>
                                        <input type="tel" id="mitra-telp" class="mitra-form-input" placeholder="(021) 1234567 / 0812..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="mitra-pic">Nama PIC (Person in Charge) <span class="req">*</span></label>
                                <div class="mitra-input-wrapper">
                                    <span class="material-symbols-outlined mitra-input-icon">person</span>
                                    <input type="text" id="mitra-pic" class="mitra-form-input" placeholder="Contoh: Budi Santoso, S.T." required>
                                </div>
                            </div>

                            <div class="mitra-checkbox-group">
                                <label class="mitra-checkbox-label">
                                    <input type="checkbox" id="mitra-terms-check" required>
                                    <span>
                                        Saya telah membaca dan menyetujui <a href="ketentuan-mitra-kerja.html" class="mitra-terms-link" onclick="handleTermsLinkClick(event)" title="Buka Ketentuan Mitra Kerja">Syarat &amp; Ketentuan Mitra Kerja</a> yang berlaku di DPP INKINDO DKI Jakarta <span class="req">*</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="daftar-mitra-modal-footer" id="mitra-modal-footer">
                            <button type="button" class="btn-mitra-cancel" onclick="closeDaftarMitraModal()">Batal</button>
                            <button type="submit" class="btn-mitra-submit" id="btn-submit-mitra">Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modalEl);

            modalEl.addEventListener('click', (e) => {
                if (e.target === modalEl) window.closeDaftarMitraModal();
            });
        }
        return modalEl;
    }

    window.openDaftarMitraModal = function (e) {
        if (e && e.preventDefault) e.preventDefault();
        closePanel();
        window.open('http://localhost:8080/mitra/register', '_blank', 'noopener');
    };

    window.closeDaftarMitraModal = function () {
        const modalEl = document.getElementById('daftar-mitra-modal');
        if (modalEl) {
            modalEl.classList.remove('is-active');
            modalEl.setAttribute('aria-hidden', 'true');
        }
        document.body.style.overflow = '';
    };

    window.handleTermsLinkClick = function (e) {
        if (window.location.pathname.endsWith('ketentuan-mitra-kerja.html') || window.location.href.includes('ketentuan-mitra-kerja.html')) {
            if (e && e.preventDefault) e.preventDefault();
            window.closeDaftarMitraModal();
            const target = document.getElementById('ketentuan') || document.getElementById('syarat');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        } else {
            // Navigate to ketentuan-mitra-kerja.html
            window.location.href = 'ketentuan-mitra-kerja.html#ketentuan';
        }
    };

    window.handleDaftarMitraSubmit = function (e) {
        e.preventDefault();
        const namaPerusahaan = document.getElementById('mitra-perusahaan')?.value || 'Perusahaan Anda';
        const bodyEl = document.getElementById('mitra-modal-form-body');
        const footerEl = document.getElementById('mitra-modal-footer');

        if (bodyEl && footerEl) {
            bodyEl.innerHTML = `
                <div class="mitra-success-box">
                    <div class="mitra-success-icon">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <h4 class="mitra-success-title">Pendaftaran Berhasil Dikirim!</h4>
                    <p class="mitra-success-desc">
                        Terima kasih <strong>${namaPerusahaan}</strong> telah mendaftar sebagai Mitra Kerja DPP INKINDO DKI Jakarta. Tim Sekretariat kami akan segera memverifikasi data dan menghubungi PIC Anda untuk proses selanjutnya.
                    </p>
                    <button type="button" class="btn-mitra-submit" onclick="closeDaftarMitraModal()" style="margin: 0 auto;">
                        Tutup
                    </button>
                </div>
            `;
            footerEl.style.display = 'none';
        }
    };

    // Auto-open modal if URL has hash or parameter
    if (window.location.hash === '#daftar-mitra' || window.location.search.includes('action=daftar')) {
        setTimeout(() => {
            window.openDaftarMitraModal();
        }, 300);
    }

    /* ---------- Modal Klinik Konsultasi ---------- */
    function ensureKlinikModal() {
        let modalEl = document.getElementById('klinik-konsultasi-modal');
        if (!modalEl) {
            modalEl = document.createElement('div');
            modalEl.id = 'klinik-konsultasi-modal';
            modalEl.className = 'daftar-mitra-modal-overlay';
            modalEl.setAttribute('role', 'dialog');
            modalEl.setAttribute('aria-modal', 'true');
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.innerHTML = `
                <div class="daftar-mitra-modal-card" style="max-width: 620px;">
                    <div class="daftar-mitra-modal-header">
                        <div class="daftar-mitra-header-left">
                            <div class="daftar-mitra-header-icon" style="background: rgba(11, 98, 162, 0.08); color: #0B62A2;">
                                <span class="material-symbols-outlined">support_agent</span>
                            </div>
                            <div>
                                <h3 class="daftar-mitra-modal-title">Formulir Klinik Konsultasi</h3>
                                <p class="daftar-mitra-modal-subtitle">Pendampingan &amp; konsultasi gratis anggota DPP INKINDO DKI Jakarta</p>
                            </div>
                        </div>
                        <button type="button" class="daftar-mitra-modal-close" onclick="closeKlinikKonsultasiModal()" aria-label="Tutup modal">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <form id="form-klinik-konsultasi" onsubmit="handleKlinikKonsultasiSubmit(event)">
                        <div class="daftar-mitra-modal-body" id="klinik-modal-form-body">
                            <!-- Kategori Dropdown -->
                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="konsultasi-kategori">Category <span class="req">*</span></label>
                                <div class="mitra-input-wrapper">
                                    <span class="material-symbols-outlined mitra-input-icon">category</span>
                                    <select id="konsultasi-kategori" class="mitra-form-select" required>
                                        <option value="" disabled selected>-- Pilih Category --</option>
                                        <option value="Advokasi & Mediasi">Advokasi &amp; Mediasi</option>
                                        <option value="Regulasi">Regulasi</option>
                                        <option value="Perpajakan">Perpajakan</option>
                                        <option value="Pelayanan(Perbankan, Notariat, Akuntan Publik, Asuransi, KTA, SBU, OSS)">Pelayanan(Perbankan, Notariat, Akuntan Publik, Asuransi, KTA, SBU, OSS)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Name & Company -->
                            <div class="mitra-form-row">
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="konsultasi-name">Your Name <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">person</span>
                                        <input type="text" id="konsultasi-name" class="mitra-form-input" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="konsultasi-company">Company Name <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">apartment</span>
                                        <input type="text" id="konsultasi-company" class="mitra-form-input" placeholder="Company Name" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone & Email -->
                            <div class="mitra-form-row">
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="konsultasi-phone">Contact / No Phone <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">call</span>
                                        <input type="tel" id="konsultasi-phone" class="mitra-form-input" placeholder="Contact / No Phone" required>
                                    </div>
                                </div>
                                <div class="mitra-form-group">
                                    <label class="mitra-form-label" for="konsultasi-email">Your Email <span class="req">*</span></label>
                                    <div class="mitra-input-wrapper">
                                        <span class="material-symbols-outlined mitra-input-icon">mail</span>
                                        <input type="email" id="konsultasi-email" class="mitra-form-input" placeholder="Your Email" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="konsultasi-subject">Subject <span class="req">*</span></label>
                                <div class="mitra-input-wrapper">
                                    <span class="material-symbols-outlined mitra-input-icon">chat</span>
                                    <input type="text" id="konsultasi-subject" class="mitra-form-input" placeholder="Subject" required>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="konsultasi-message">Message <span class="req">*</span></label>
                                <div class="mitra-input-wrapper mitra-input-wrapper--textarea">
                                    <span class="material-symbols-outlined mitra-input-icon">edit_note</span>
                                    <textarea id="konsultasi-message" class="mitra-form-textarea" rows="3" placeholder="Message" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="daftar-mitra-modal-footer" id="klinik-modal-footer">
                            <button type="button" class="btn-mitra-cancel" onclick="closeKlinikKonsultasiModal()">Batal</button>
                            <button type="submit" class="btn-mitra-submit" id="btn-submit-klinik">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modalEl);

            modalEl.addEventListener('click', (e) => {
                if (e.target === modalEl) window.closeKlinikKonsultasiModal();
            });
        }
        return modalEl;
    }

    window.openKlinikKonsultasiModal = function (e, defaultCategory) {
        if (e && e.preventDefault) e.preventDefault();
        closePanel();

        const modalEl = ensureKlinikModal();
        modalEl.classList.add('is-active');
        modalEl.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        if (defaultCategory) {
            const select = document.getElementById('konsultasi-kategori');
            if (select) {
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].value.toLowerCase().includes(defaultCategory.toLowerCase())) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        setTimeout(() => {
            const select = document.getElementById('konsultasi-kategori');
            if (select && !select.value) select.focus();
            else {
                const name = document.getElementById('konsultasi-name');
                if (name) name.focus();
            }
        }, 150);
    };

    window.closeKlinikKonsultasiModal = function () {
        const modalEl = document.getElementById('klinik-konsultasi-modal');
        if (modalEl) {
            modalEl.classList.remove('is-active');
            modalEl.setAttribute('aria-hidden', 'true');
        }
        document.body.style.overflow = '';
    };

    window.handleKlinikKonsultasiSubmit = function (e) {
        e.preventDefault();
        const nama = document.getElementById('konsultasi-name')?.value || 'Bapak/Ibu';
        const kategori = document.getElementById('konsultasi-kategori')?.value || 'Konsultasi';
        const bodyEl = document.getElementById('klinik-modal-form-body');
        const footerEl = document.getElementById('klinik-modal-footer');

        if (bodyEl && footerEl) {
            bodyEl.innerHTML = `
                <div class="mitra-success-box">
                    <div class="mitra-success-icon" style="background: rgba(11, 98, 162, 0.08); color: #0B62A2;">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <h4 class="mitra-success-title">Permohonan Konsultasi Terkirim!</h4>
                    <p class="mitra-success-desc">
                        Terima kasih <strong>${nama}</strong>. Permohonan Anda untuk topik <strong>${kategori}</strong> telah berhasil dikirimkan. Tim Konsultan Ahli DPP INKINDO DKI Jakarta akan segera menghubungi Anda untuk penjadwalan sesi konsultasi (tatap muka atau daring).
                    </p>
                    <button type="button" class="btn-mitra-submit" onclick="closeKlinikKonsultasiModal()" style="margin: 0 auto;">
                        Selesai &amp; Tutup
                    </button>
                </div>
            `;
            footerEl.style.display = 'none';
        }
    };

    // Attach listeners to #klinik-cta and topic chips
    document.querySelectorAll('#klinik-cta').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            window.openKlinikKonsultasiModal(e);
        });
    });

    // Also support hash #klinik-konsultasi
    if (window.location.hash === '#klinik-konsultasi' || window.location.search.includes('action=konsultasi')) {
        setTimeout(() => {
            window.openKlinikKonsultasiModal();
        }, 300);
    }

    /* ---------- Sinkronisasi Otomatis Logo Mitra Kerja di 3 Tempat (Home Marquee, Side Panel Kiri, & Halaman Mitra Kerja) ---------- */
    async function syncMitraLogosFromDatabase() {
        try {
            const res = await fetch('/api/mitra', {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) return;
            const data = await res.json();
            const mitraList = Array.isArray(data.mitra) ? data.mitra : [];
            if (mitraList.length === 0) return;

            const esc = (s) => String(s ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');

            // 1. Halaman Utama: Marquee Bergerak (.mitra-kerja__marquee)
            const marqueeEl = document.querySelector('.mitra-kerja__marquee');
            if (marqueeEl) {
                const renderTrackItems = (items) => items.map((m) => `
                    <a href="/mitra-kerja/${encodeURIComponent(m.slug)}" class="mitra-card" title="${esc(m.nama_perusahaan)}" style="text-decoration: none; cursor: pointer;">
                        <img src="${esc(m.logo)}" alt="${esc(m.nama_perusahaan)}">
                    </a>
                `).join('');

                // Gunakan 2 track berisi seluruh mitra kerja agar animasi marquee mulus dan semua logo muncul
                const trackHtml = `<div class="mitra-kerja__track">${renderTrackItems(mitraList)}</div>`;
                marqueeEl.innerHTML = trackHtml + trackHtml;
                marqueeEl.style.animationDuration = Math.max(55, mitraList.length * 7) + 's';
            }

            // 2. Menu Navbar Samping Kiri: Side Panel Mitra Kerja (.side-panel__content[data-content="mitra"] .partner-grid)
            const sidePartnerGrids = document.querySelectorAll('.side-panel__content[data-content="mitra"] .partner-grid');
            sidePartnerGrids.forEach((grid) => {
                grid.innerHTML = mitraList.map((m) => `
                    <a href="/mitra-kerja/${encodeURIComponent(m.slug)}" class="partner-card" title="${esc(m.nama_perusahaan)}"
                        style="padding: 12px; align-items: center; justify-content: center; height: 100%; text-decoration: none; display: flex;">
                        <img src="${esc(m.logo)}" alt="${esc(m.nama_perusahaan)}"
                            style="max-height: 35px; width: auto; max-width: 100%; object-fit: contain; mix-blend-mode: multiply;">
                    </a>
                `).join('');
            });

            // 3. Halaman Ketentuan Mitra Kerja Bagian Paling Bawah (.partner-logos-grid)
            const showcaseGrid = document.querySelector('.partner-logos-grid');
            if (showcaseGrid) {
                showcaseGrid.innerHTML = mitraList.map((m) => `
                    <a href="/mitra-kerja/${encodeURIComponent(m.slug)}" class="partner-logo-item" title="Lihat Profil & Produk ${esc(m.nama_perusahaan)}" style="text-decoration: none; cursor: pointer;">
                        <img src="${esc(m.logo)}" alt="${esc(m.nama_perusahaan)}">
                    </a>
                `).join('');
            }
        } catch (err) {
            console.error('Gagal memuat logo Mitra Kerja:', err);
        }
    }

    syncMitraLogosFromDatabase();
})();