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
        }
    });

    /* ---------- Hero search: efek mengetik ---------- */
    const heroInput = $('#hero-search-input');
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

    /* Pencarian sederhana: arahkan ke panel / bagian terkait */
    const keywordMap = [
        { keys: ['lelang', 'tender', 'lpse', 'spse'], panel: 'lelang' },
        { keys: ['anggota', 'kta', 'registrasi', 'daftar', 'billing'], panel: 'anggota' },
        { keys: ['mitra', 'partner', 'pupr', 'lpjk', 'lkpp'], panel: 'mitra' },
        { keys: ['klinik', 'konsultasi'], panel: 'klinik' },
        { keys: ['kontak', 'hubungi', 'telepon', 'email', 'alamat'], panel: 'kontak' },
        { keys: ['login', 'sia', 'sbu', 'masuk'], panel: 'login' },
        { keys: ['chat', 'tanya', 'bantuan'], panel: 'chat' }
    ];

    const handleSearch = (query) => {
        const q = query.trim().toLowerCase();
        if (!q) return;
        const hit = keywordMap.find((k) => k.keys.some((key) => q.includes(key)));
        if (hit) {
            openPanel(hit.panel);
        } else {
            $('#berita').scrollIntoView({ behavior: 'smooth' });
        }
    };

    $('#hero-search').addEventListener('submit', (e) => {
        e.preventDefault();
        handleSearch(heroInput.value || phrases[pIndex]);
    });
    $('#header-search-form').addEventListener('submit', (e) => {
        e.preventDefault();
        handleSearch($('#header-search-input').value);
        headerSearch.classList.remove('is-open');
    });

    /* ---------- Hero carousel ---------- */
    const carousel = $('#hero-carousel');
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

    /* ---------- Ticker statistik ---------- */
    const tickerItems = $$('.ticker__item');
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
            text: 'Pengajuan rekomendasi SBU dilakukan melalui menu Login → Pengajuan SBU. Pastikan KTA Anda masih aktif sebelum mengajukan.'
        },
        {
            keys: ['jam', 'operasional', 'buka'],
            text: 'Sekretariat DPP INKINDO DKI Jakarta buka Senin - Jumat pukul 08.30 - 17.00 WIB.'
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
            : 'Terima kasih atas pertanyaannya. Untuk informasi lebih lanjut, hubungi sekretariat di (021) 797-1582 atau email dpp_dki@inkindo.org.';
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

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();
        sendUser(chatInput.value);
        chatInput.value = '';
    });
    $$('.chat-quick__btn').forEach((btn) =>
        btn.addEventListener('click', () => sendUser(btn.textContent)));
})();
