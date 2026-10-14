/* =========================================================
   DPP INKINDO DKI Jakarta — Interaksi halaman
   ========================================================= */
(function () {
    'use strict';

    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

    /* ---------- Header: solid saat scroll ---------- */
    const header = $('#main-header');
    const onScroll = () => {
        const scrolled = window.scrollY > 40;
        header.classList.toggle('is-scrolled', scrolled);
        document.body.classList.toggle('is-scrolled', scrolled);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

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

    /* ---------- Search header ---------- */
    const headerSearch = $('#header-search');
    $('#header-search-toggle').addEventListener('click', () => {
        setMenu(false);
        headerSearch.classList.toggle('is-open');
        if (headerSearch.classList.contains('is-open')) {
            header.classList.add('is-scrolled');
            setTimeout(() => $('#header-search-input').focus(), 300);
        } else {
            onScroll();
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
        panel.setAttribute('aria-hidden', 'false');
        overlay.classList.add('is-visible');
        if (name === 'chat') initChat();
    };

    const closePanel = () => {
        currentPanel = null;
        sideLinks.forEach((l) => l.classList.remove('is-active'));
        panel.classList.remove('is-open');
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

    /* ---------- Hero search: efek mengetik ---------- */
    const heroInput = $('#hero-search-input');
    if (heroInput) {
        const phrases = [
            'Mau cari apa hari ini?',
            'Selamat Datang',
            'Info Lelang',
            'Registrasi Anggota',
            'Sertifikasi SBU',
            'Klinik Konsultasi',
            'Standar Billing Rate'
        ];
        let pIndex = 0, cIndex = 0, deleting = false;

        const typeLoop = () => {
            const word = phrases[pIndex];
            if (document.activeElement !== heroInput && !heroInput.value) {
                heroInput.placeholder = word.slice(0, cIndex);
            }
            let delay = deleting ? 45 : 90;
            if (!deleting && cIndex === word.length) {
                delay = 1800;
                deleting = true;
            } else if (deleting && cIndex === 0) {
                deleting = false;
                pIndex = (pIndex + 1) % phrases.length;
                delay = 400;
            } else {
                cIndex += deleting ? -1 : 1;
            }
            setTimeout(typeLoop, delay);
        };
        typeLoop();
    }

    /* Pencarian sederhana: arahkan ke panel / bagian terkait */
    const keywordMap = [
        { keys: ['lelang', 'tender', 'lpse', 'spse'], panel: 'lelang' },
        { keys: ['anggota', 'kta', 'registrasi', 'daftar', 'billing'], panel: 'anggota' },
        { keys: ['mitra', 'partner', 'pupr', 'lpjk', 'lkpp'], panel: 'mitra' },
        { keys: ['klinik', 'konsultasi', 'sbu'], panel: 'klinik' },
        { keys: ['kontak', 'hubungi', 'telepon', 'email', 'alamat'], panel: 'kontak' },
        { keys: ['login', 'sia', 'masuk'], panel: 'login' },
        { keys: ['chat', 'tanya', 'bantuan'], panel: 'chat' }
    ];

    const handleSearch = (query) => {
        const q = query.trim().toLowerCase();
        if (!q) return;
        const hit = keywordMap.find((k) => k.keys.some((key) => q.includes(key)));
        if (hit) {
            openPanel(hit.panel);
        } else {
            const beritaEl = $('#berita');
            if (beritaEl) beritaEl.scrollIntoView({ behavior: 'smooth' });
        }
    };

    if ($('#hero-search')) {
        $('#hero-search').addEventListener('submit', (e) => {
            e.preventDefault();
            handleSearch(heroInput.value || (heroInput ? 'cari' : ''));
        });
    }
    $('#header-search-form').addEventListener('submit', (e) => {
        e.preventDefault();
        handleSearch($('#header-search-input').value);
        headerSearch.classList.remove('is-open');
    });

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

    window.openDaftarMitraModal = function(e) {
        if (e && e.preventDefault) e.preventDefault();
        closePanel();
        
        const modalEl = ensureMitraModal();
        modalEl.classList.add('is-active');
        modalEl.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            const input = document.getElementById('mitra-perusahaan');
            if (input) input.focus();
        }, 150);
    };

    window.closeDaftarMitraModal = function() {
        const modalEl = document.getElementById('daftar-mitra-modal');
        if (modalEl) {
            modalEl.classList.remove('is-active');
            modalEl.setAttribute('aria-hidden', 'true');
        }
        document.body.style.overflow = '';
    };

    window.handleTermsLinkClick = function(e) {
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

    window.handleDaftarMitraSubmit = function(e) {
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
                            <div class="daftar-mitra-header-icon" style="background: #e0f2fe; color: #0284c7;">
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

    window.openKlinikKonsultasiModal = function(e, defaultCategory) {
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

    window.closeKlinikKonsultasiModal = function() {
        const modalEl = document.getElementById('klinik-konsultasi-modal');
        if (modalEl) {
            modalEl.classList.remove('is-active');
            modalEl.setAttribute('aria-hidden', 'true');
        }
        document.body.style.overflow = '';
    };

    window.handleKlinikKonsultasiSubmit = function(e) {
        e.preventDefault();
        const nama = document.getElementById('konsultasi-name')?.value || 'Bapak/Ibu';
        const kategori = document.getElementById('konsultasi-kategori')?.value || 'Konsultasi';
        const bodyEl = document.getElementById('klinik-modal-form-body');
        const footerEl = document.getElementById('klinik-modal-footer');

        if (bodyEl && footerEl) {
            bodyEl.innerHTML = `
                <div class="mitra-success-box">
                    <div class="mitra-success-icon" style="background: #e0f2fe; color: #0284c7;">
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
})();
