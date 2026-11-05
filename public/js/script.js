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
        const jakartaImages = [
            'assets/jakarta.jpg',
            'assets/jakarta2.jpg',
            'assets/jakarta3.jpg',
            'assets/jakarta4.jpg',
            'assets/jakarta5.jpg',
            'assets/jakarta6.jpg',
            'assets/jakarta7.jpg',
            'assets/jakarta8.jpg',
            'assets/jakarta9.jpg'
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

    window.openDaftarMitraModal = function (e) {
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
})();


/* ==========================================================================
   LOGIN ADMIN KESEKRETARIATAN & SUPER ADMIN MODE (LARAVEL BACKEND)
   ========================================================================== */
(function () {
    'use strict';

    window.__INKINDO_AUTH = {
        authenticated: false,
        user: null,
        csrf_token: ''
    };

    function closeSidePanelIfOpen() {
        const closeBtn = document.getElementById('side-panel-close');
        const panel = document.getElementById('side-panel');
        if (panel && panel.classList.contains('is-open') && closeBtn) {
            closeBtn.click();
        }
    }

    function injectAdminAuthStyles() {
        if (document.getElementById('inkindo-admin-auth-styles')) return;
        const style = document.createElement('style');
        style.id = 'inkindo-admin-auth-styles';
        style.textContent = `
            .admin-floating-bar {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9990;
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                color: #ffffff;
                padding: 10px 16px;
                border-radius: 50px;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.35);
                border: 1px solid rgba(255, 255, 255, 0.15);
                display: none;
                align-items: center;
                gap: 12px;
                font-size: 13px;
                font-family: 'Poppins', sans-serif;
            }
            .admin-floating-bar.is-visible {
                display: flex;
            }
            .admin-floating-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-weight: 600;
                color: #38bdf8;
            }
            .admin-floating-badge .dot {
                width: 8px;
                height: 8px;
                background: #10b981;
                border-radius: 50%;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
            }
            .admin-floating-btn {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                transition: all 0.2s ease;
                font-family: inherit;
            }
            .admin-floating-btn:hover {
                background: #0B62A2;
                border-color: #38bdf8;
                color: #ffffff;
            }
            .admin-floating-btn--logout {
                background: rgba(239, 68, 68, 0.2);
                border-color: rgba(239, 68, 68, 0.4);
                color: #fca5a5;
            }
            .admin-floating-btn--logout:hover {
                background: #ef4444;
                border-color: #ef4444;
                color: #ffffff;
            }
            .admin-login-error {
                background: #fef2f2;
                border: 1px solid #fecaca;
                color: #dc2626;
                padding: 10px 14px;
                border-radius: 10px;
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 16px;
                display: none;
                align-items: center;
                gap: 8px;
            }
            .admin-login-error.is-visible {
                display: flex;
            }
            .admin-toast {
                position: fixed;
                top: 88px;
                right: 24px;
                z-index: 10005;
                background: #0f172a;
                color: #ffffff;
                padding: 12px 18px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 13.5px;
                font-weight: 600;
                transform: translateY(-20px);
                opacity: 0;
                pointer-events: none;
                transition: all 0.25s ease;
            }
            .admin-toast.is-shown {
                transform: translateY(0);
                opacity: 1;
            }
            @media (max-width: 768px) {
                .admin-floating-bar {
                    left: 12px;
                    right: 12px;
                    bottom: 12px;
                    justify-content: space-between;
                    border-radius: 14px;
                    flex-wrap: wrap;
                }
            }
        `;
        document.head.appendChild(style);
    }

    window.showAdminToast = function (message, icon = 'check_circle', iconColor = '#10b981') {
        injectAdminAuthStyles();
        let toast = document.getElementById('inkindo-admin-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'inkindo-admin-toast';
            toast.className = 'admin-toast';
            document.body.appendChild(toast);
        }
        toast.innerHTML = `<span class="material-symbols-outlined" style="color:${iconColor};font-size:20px;">${icon}</span><span>${message}</span>`;
        toast.classList.add('is-shown');
        clearTimeout(window.__adminToastTimer);
        window.__adminToastTimer = setTimeout(() => {
            toast.classList.remove('is-shown');
        }, 3200);
    };

    function ensureAdminLoginModal() {
        injectAdminAuthStyles();
        let modalEl = document.getElementById('admin-login-modal');
        if (!modalEl) {
            modalEl = document.createElement('div');
            modalEl.id = 'admin-login-modal';
            modalEl.className = 'daftar-mitra-modal-overlay';
            modalEl.setAttribute('role', 'dialog');
            modalEl.setAttribute('aria-modal', 'true');
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.innerHTML = `
                <div class="daftar-mitra-modal-card" style="max-width: 440px;">
                    <div class="daftar-mitra-modal-header">
                        <div class="daftar-mitra-header-left">
                            <div class="daftar-mitra-header-icon" style="background: rgba(11, 98, 162, 0.1); color: #0B62A2;">
                                <span class="material-symbols-outlined">admin_panel_settings</span>
                            </div>
                            <div>
                                <h3 class="daftar-mitra-modal-title">Login Admin Kesekretariatan</h3>
                                <p class="daftar-mitra-modal-subtitle">Akses khusus pengelolaan data DPP INKINDO DKI Jakarta</p>
                            </div>
                        </div>
                        <button type="button" class="daftar-mitra-modal-close" onclick="closeAdminLoginModal()" aria-label="Tutup modal">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <form id="form-admin-login" onsubmit="handleAdminLoginSubmit(event)">
                        <div class="daftar-mitra-modal-body">
                            <div id="admin-login-error" class="admin-login-error">
                                <span class="material-symbols-outlined" style="font-size: 18px;">error</span>
                                <span id="admin-login-error-text">Username atau password salah.</span>
                            </div>

                            <div class="mitra-form-group">
                                <label class="mitra-form-label" for="admin-username">Username <span class="req">*</span></label>
                                <div class="mitra-input-wrapper">
                                    <span class="material-symbols-outlined mitra-input-icon">person</span>
                                    <input type="text" id="admin-username" class="mitra-form-input" placeholder="Masukkan username admin" autocomplete="username" required>
                                </div>
                            </div>

                            <div class="mitra-form-group" style="margin-bottom: 6px;">
                                <label class="mitra-form-label" for="admin-password">Password <span class="req">*</span></label>
                                <div class="mitra-input-wrapper" style="position: relative;">
                                    <span class="material-symbols-outlined mitra-input-icon">lock</span>
                                    <input type="password" id="admin-password" class="mitra-form-input" placeholder="Masukkan password" autocomplete="current-password" style="padding-right: 42px;" required>
                                    <button type="button" onclick="toggleAdminPasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; cursor: pointer; display: flex; align-items: center;" aria-label="Tampilkan password">
                                        <span class="material-symbols-outlined" id="admin-pw-eye" style="font-size: 20px;">visibility</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="daftar-mitra-modal-footer">
                            <button type="button" class="btn-mitra-cancel" onclick="closeAdminLoginModal()">Batal</button>
                            <button type="submit" class="btn-mitra-submit" id="btn-submit-admin-login">
                                Masuk Admin
                            </button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modalEl);

            modalEl.addEventListener('click', (e) => {
                if (e.target === modalEl) window.closeAdminLoginModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modalEl.classList.contains('is-active')) {
                    window.closeAdminLoginModal();
                }
            });
        }
        return modalEl;
    }

    window.toggleAdminPasswordVisibility = function () {
        const pwInput = document.getElementById('admin-password');
        const eyeIcon = document.getElementById('admin-pw-eye');
        if (!pwInput || !eyeIcon) return;
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            eyeIcon.textContent = 'visibility_off';
        } else {
            pwInput.type = 'password';
            eyeIcon.textContent = 'visibility';
        }
    };

    window.openAdminLoginModal = function (e) {
        if (e && e.preventDefault) e.preventDefault();
        closeSidePanelIfOpen();

        if (window.__INKINDO_AUTH && window.__INKINDO_AUTH.authenticated) {
            window.showAdminToast('Anda sudah login sebagai Admin Kesekretariatan.');
            return;
        }

        const modalEl = ensureAdminLoginModal();
        const errBox = document.getElementById('admin-login-error');
        if (errBox) errBox.classList.remove('is-visible');

        modalEl.classList.add('is-active');
        modalEl.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            const input = document.getElementById('admin-username');
            if (input) input.focus();
        }, 120);
    };

    window.closeAdminLoginModal = function () {
        const modalEl = document.getElementById('admin-login-modal');
        if (modalEl) {
            modalEl.classList.remove('is-active');
            modalEl.setAttribute('aria-hidden', 'true');
        }
        document.body.style.overflow = '';
    };

    window.handleAdminLoginSubmit = async function (e) {
        e.preventDefault();
        const username = document.getElementById('admin-username')?.value.trim();
        const password = document.getElementById('admin-password')?.value;
        const btn = document.getElementById('btn-submit-admin-login');
        const errBox = document.getElementById('admin-login-error');
        const errText = document.getElementById('admin-login-error-text');

        if (errBox) errBox.classList.remove('is-visible');
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Memproses...';
        }

        try {
            const res = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.__INKINDO_AUTH.csrf_token || ''
                },
                credentials: 'same-origin',
                body: JSON.stringify({ username, password })
            });
            const data = await res.json();

            if (!res.ok || !data.success) {
                if (errText) errText.textContent = data.message || 'Username atau password salah.';
                if (errBox) errBox.classList.add('is-visible');
            } else {
                window.__INKINDO_AUTH = {
                    authenticated: true,
                    user: data.user,
                    csrf_token: data.csrf_token || window.__INKINDO_AUTH.csrf_token
                };
                document.getElementById('form-admin-login')?.reset();
                window.closeAdminLoginModal();
                updateAdminUI();
                window.dispatchEvent(new CustomEvent('inkindo:auth-changed', { detail: window.__INKINDO_AUTH }));
                window.showAdminToast(data.message || 'Login Admin Kesekretariatan Berhasil!');
            }
        } catch (err) {
            if (errText) errText.textContent = 'Gagal terhubung ke server Laravel. Pastikan server aktif.';
            if (errBox) errBox.classList.add('is-visible');
        } finally {
            if (btn) {
                btn.disabled = false;
                btn.textContent = 'Masuk Admin';
            }
        }
    };

    window.handleAdminLogout = async function (e) {
        if (e && e.preventDefault) e.preventDefault();
        closeSidePanelIfOpen();
        try {
            const res = await fetch('/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.__INKINDO_AUTH.csrf_token || ''
                },
                credentials: 'same-origin'
            });
            const data = await res.json();
            window.__INKINDO_AUTH = {
                authenticated: false,
                user: null,
                csrf_token: data.csrf_token || ''
            };
            updateAdminUI();
            window.dispatchEvent(new CustomEvent('inkindo:auth-changed', { detail: window.__INKINDO_AUTH }));
            window.showAdminToast('Berhasil logout dari Mode Admin Kesekretariatan.', 'info', '#38bdf8');
        } catch (err) {
            console.error(err);
        }
    };

    function updateAdminUI() {
        injectAdminAuthStyles();
        const isAuth = Boolean(window.__INKINDO_AUTH && window.__INKINDO_AUTH.authenticated);
        const user = window.__INKINDO_AUTH?.user;

        // 1. Update Floating Bar
        let bar = document.getElementById('inkindo-admin-floating-bar');
        if (!bar) {
            bar = document.createElement('div');
            bar.id = 'inkindo-admin-floating-bar';
            bar.className = 'admin-floating-bar';
            document.body.appendChild(bar);
        }

        if (isAuth) {
            bar.innerHTML = `
                <span class="admin-floating-badge">
                    <span class="dot"></span>
                    Mode Super Admin (${user?.username || 'admin'})
                </span>
                <a href="anggota-terdaftar.html" class="admin-floating-btn">
                    <span class="material-symbols-outlined" style="font-size: 16px;">groups</span>
                    Kelola Anggota
                </a>
                <button type="button" class="admin-floating-btn admin-floating-btn--logout" onclick="handleAdminLogout(event)">
                    <span class="material-symbols-outlined" style="font-size: 16px;">logout</span>
                    Logout
                </button>
            `;
            bar.classList.add('is-visible');
        } else {
            bar.classList.remove('is-visible');
        }

        // 2. Update Login Side Panel link for Admin Kesekretariatan
        const loginContent = document.querySelector('.side-panel__content[data-content="login"]');
        if (loginContent) {
            const links = loginContent.querySelectorAll('.panel-link');
            links.forEach((link) => {
                if (link.textContent.includes('Admin Kesekretariatan')) {
                    const smallEl = link.querySelector('small');
                    if (isAuth) {
                        link.style.background = 'rgba(16, 185, 129, 0.1)';
                        link.style.borderLeft = '3px solid #10b981';
                        if (smallEl) {
                            smallEl.innerHTML = '<span style="color:#059669;font-weight:600;">Status: Aktif (Klik untuk Logout)</span>';
                        }
                        link.onclick = (e) => window.handleAdminLogout(e);
                    } else {
                        link.style.background = '';
                        link.style.borderLeft = '';
                        if (smallEl) {
                            smallEl.textContent = 'Login Petugas DPP INKINDO';
                        }
                        link.onclick = (e) => window.openAdminLoginModal(e);
                    }
                }
            });
        }
    }

    async function checkAdminAuthStatus() {
        updateAdminUI();
        try {
            const res = await fetch('/api/auth/status', {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });
            if (res.ok) {
                const data = await res.json();
                window.__INKINDO_AUTH = {
                    authenticated: Boolean(data.authenticated),
                    user: data.user || null,
                    csrf_token: data.csrf_token || ''
                };
                updateAdminUI();
                window.dispatchEvent(new CustomEvent('inkindo:auth-changed', { detail: window.__INKINDO_AUTH }));
            }
        } catch (err) {
            // Ignore when opened without server
        }
    }

    checkAdminAuthStatus();
})();
