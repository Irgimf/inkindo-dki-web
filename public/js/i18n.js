(function () {
    'use strict';

    const STORAGE_KEY = 'inkindo_lang';
    const CACHE_KEY = 'inkindo_en_cache_v2';
    const MAX_LOCAL_CACHE = 1200;
    const SKIP_TAGS = new Set(['SCRIPT', 'STYLE', 'NOSCRIPT', 'CODE', 'PRE', 'TEXTAREA']);
    const ATTR_LIST = ['placeholder', 'aria-label', 'title'];

    const origTextMap = new WeakMap();
    const origAttrMap = new WeakMap();
    const pendingTexts = new Set();

    let currentLang = (localStorage.getItem(STORAGE_KEY) === 'en') ? 'en' : 'id';
    let observer = null;
    let mutationTimer = null;
    let dictLoaded = false;
    let dictLoadingPromise = null;
    let dynamicCache = loadLocalCache();
    let origDocTitle = document.title;

    function loadLocalCache() {
        try {
            const raw = localStorage.getItem(CACHE_KEY);
            if (!raw) return {};
            const parsed = JSON.parse(raw);
            return (parsed && typeof parsed === 'object') ? parsed : {};
        } catch (e) {
            return {};
        }
    }

    function saveLocalCache() {
        try {
            const keys = Object.keys(dynamicCache);
            if (keys.length > MAX_LOCAL_CACHE) {
                const trimmed = {};
                keys.slice(keys.length - MAX_LOCAL_CACHE).forEach((k) => {
                    trimmed[k] = dynamicCache[k];
                });
                dynamicCache = trimmed;
            }
            localStorage.setItem(CACHE_KEY, JSON.stringify(dynamicCache));
        } catch (e) {}
    }

    function shouldSkipElement(el) {
        if (!el || el.nodeType !== 1) return true;
        if (SKIP_TAGS.has(el.tagName)) return true;
        if (el.id === 'hero-type-text') return true;
        if (el.classList && (
            el.classList.contains('material-symbols-outlined') ||
            el.classList.contains('notranslate') ||
            el.classList.contains('lang-switch')
        )) {
            return true;
        }
        if (el.closest && el.closest('.lang-switch')) {
            return true;
        }
        return false;
    }

    function needsDynamicTranslation(trimmed) {
        if (!trimmed || trimmed.length < 2) return false;
        if (/^[\d\s\W_]+$/.test(trimmed)) return false;
        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmed)) return false;
        if (/^https?:\/\//i.test(trimmed)) return false;
        if (/^(assets|cms_uploads|mitra_logos)\//i.test(trimmed)) return false;
        if (/^(\+?\d[\d\s\-()./]+)$/.test(trimmed)) return false;
        return true;
    }

    function lookupStaticOrCache(raw) {
        if (!raw) return { hit: false, value: raw };
        const trimmed = raw.replace(/\s+/g, ' ').trim();
        if (!trimmed) return { hit: true, value: raw };

        const lead = raw.match(/^\s*/)[0];
        const trail = raw.match(/\s*$/)[0];

        const dict = window.__INKINDO_EN_DICT;
        if (dict && Object.prototype.hasOwnProperty.call(dict, trimmed)) {
            return { hit: true, value: lead + dict[trimmed] + trail };
        }

        if (Object.prototype.hasOwnProperty.call(dynamicCache, trimmed)) {
            return { hit: true, value: lead + dynamicCache[trimmed] + trail };
        }

        const patterns = window.__INKINDO_EN_PATTERNS;
        if (patterns && trimmed.length < 300) {
            let out = raw;
            let changed = false;
            for (let i = 0; i < patterns.length; i++) {
                const next = out.replace(patterns[i][0], patterns[i][1]);
                if (next !== out) {
                    out = next;
                    changed = true;
                }
            }
            if (changed) return { hit: true, value: out };
        }

        return { hit: false, value: raw, trimmed: trimmed };
    }

    function applyToRoot(root, lang) {
        if (!root) return [];
        const missingSet = new Set();

        // 0. Document title
        if (lang === 'en') {
            const titleRes = lookupStaticOrCache(origDocTitle);
            if (titleRes.hit) {
                document.title = titleRes.value;
            } else if (needsDynamicTranslation(titleRes.trimmed) && !pendingTexts.has(titleRes.trimmed)) {
                missingSet.add(titleRes.trimmed);
            }
        } else if (document.title !== origDocTitle) {
            document.title = origDocTitle;
        }

        // 1. Text nodes via fast TreeWalker
        const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, {
            acceptNode: function (node) {
                const parent = node.parentElement;
                if (!parent || shouldSkipElement(parent)) return NodeFilter.FILTER_REJECT;
                if (!node.nodeValue || !node.nodeValue.trim()) return NodeFilter.FILTER_SKIP;
                return NodeFilter.FILTER_ACCEPT;
            }
        });

        let textNode;
        while ((textNode = walker.nextNode())) {
            if (lang === 'en') {
                if (!origTextMap.has(textNode)) {
                    origTextMap.set(textNode, textNode.nodeValue);
                }
                const orig = origTextMap.get(textNode);
                const res = lookupStaticOrCache(orig);
                if (res.hit) {
                    if (textNode.nodeValue !== res.value) {
                        textNode.nodeValue = res.value;
                    }
                } else if (needsDynamicTranslation(res.trimmed) && !pendingTexts.has(res.trimmed)) {
                    missingSet.add(res.trimmed);
                }
            } else if (origTextMap.has(textNode)) {
                const orig = origTextMap.get(textNode);
                if (textNode.nodeValue !== orig) {
                    textNode.nodeValue = orig;
                }
            }
        }

        // 2. Attributes (placeholder, aria-label, title)
        const attrEls = root.querySelectorAll ? root.querySelectorAll('[placeholder],[aria-label],[title]') : [];
        for (let i = 0; i < attrEls.length; i++) {
            const el = attrEls[i];
            if (shouldSkipElement(el)) continue;

            let saved = origAttrMap.get(el);
            if (!saved) {
                saved = {};
                origAttrMap.set(el, saved);
            }

            for (let j = 0; j < ATTR_LIST.length; j++) {
                const attr = ATTR_LIST[j];
                if (!el.hasAttribute(attr)) continue;

                if (lang === 'en') {
                    if (!(attr in saved)) {
                        saved[attr] = el.getAttribute(attr);
                    }
                    const res = lookupStaticOrCache(saved[attr]);
                    if (res.hit) {
                        if (el.getAttribute(attr) !== res.value) {
                            el.setAttribute(attr, res.value);
                        }
                    } else if (needsDynamicTranslation(res.trimmed) && !pendingTexts.has(res.trimmed)) {
                        missingSet.add(res.trimmed);
                    }
                } else if (attr in saved) {
                    if (el.getAttribute(attr) !== saved[attr]) {
                        el.setAttribute(attr, saved[attr]);
                    }
                }
            }
        }

        return Array.from(missingSet);
    }

    async function googleTranslateDirect(query) {
        const controller = new AbortController();
        const timer = setTimeout(() => controller.abort(), 4500);
        try {
            const url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=en&dt=t&q=' + encodeURIComponent(query);
            const res = await fetch(url, { signal: controller.signal });
            if (!res.ok) return null;
            const json = await res.json();
            if (!Array.isArray(json) || !Array.isArray(json[0])) return null;
            let out = '';
            for (let i = 0; i < json[0].length; i++) {
                if (Array.isArray(json[0][i]) && json[0][i][0]) {
                    out += json[0][i][0];
                }
            }
            return out || null;
        } catch (e) {
            return null;
        } finally {
            clearTimeout(timer);
        }
    }

    async function fetchMissingTranslations(texts) {
        if (!texts || texts.length === 0 || currentLang !== 'en') return;

        texts.forEach((t) => pendingTexts.add(t));

        // Kelompokkan teks menjadi chunk <= 950 karakter agar aman di URL GET & cepat
        const chunks = [];
        let current = [];
        let currentLen = 0;
        for (let i = 0; i < texts.length; i++) {
            const t = texts[i];
            if (current.length > 0 && (currentLen + t.length > 950 || current.length >= 12)) {
                chunks.push(current);
                current = [];
                currentLen = 0;
            }
            current.push(t);
            currentLen += t.length + 2;
        }
        if (current.length > 0) chunks.push(current);

        // Proses maksimal 3 chunk paralel agar tidak memblokir browser/network
        const CONCURRENCY = 3;
        let idx = 0;

        async function worker() {
            while (idx < chunks.length && currentLang === 'en') {
                const chunk = chunks[idx++];
                try {
                    if (chunk.length === 1) {
                        const translated = await googleTranslateDirect(chunk[0]);
                        if (translated) {
                            dynamicCache[chunk[0]] = translated;
                        }
                    } else {
                        const joined = chunk.join('\n');
                        const batchOut = await googleTranslateDirect(joined);
                        if (batchOut) {
                            const lines = batchOut.split('\n');
                            if (lines.length === chunk.length) {
                                for (let k = 0; k < chunk.length; k++) {
                                    const tr = lines[k].trim();
                                    if (tr) dynamicCache[chunk[k]] = tr;
                                }
                            } else {
                                // Fallback 1 per 1 jika jumlah baris berubah
                                for (let k = 0; k < chunk.length && currentLang === 'en'; k++) {
                                    const singleTr = await googleTranslateDirect(chunk[k]);
                                    if (singleTr) dynamicCache[chunk[k]] = singleTr;
                                }
                            }
                        }
                    }
                } finally {
                    chunk.forEach((t) => pendingTexts.delete(t));
                }

                if (currentLang === 'en') {
                    saveLocalCache();
                    applyToRoot(document.body, 'en');
                    refreshHeroPhrases();
                }
            }
        }

        const workers = [];
        for (let w = 0; w < Math.min(CONCURRENCY, chunks.length); w++) {
            workers.push(worker());
        }
        await Promise.all(workers);
    }

    function refreshHeroPhrases() {
        const idPhrases = window.__INKINDO_HERO_PHRASES_ID;
        if (!Array.isArray(idPhrases) || idPhrases.length === 0) return;
        if (typeof window.__startHeroTypewriter !== 'function') return;

        if (currentLang !== 'en') {
            window.__startHeroTypewriter(idPhrases);
            return;
        }

        const missing = [];
        const enPhrases = idPhrases.map((p) => {
            const res = lookupStaticOrCache(p);
            if (res.hit) return res.value;
            if (needsDynamicTranslation(res.trimmed) && !pendingTexts.has(res.trimmed)) {
                missing.push(res.trimmed);
            }
            return p;
        });

        window.__startHeroTypewriter(enPhrases);
        if (missing.length > 0) {
            fetchMissingTranslations(missing);
        }
    }

    function runEnglishPass() {
        if (currentLang !== 'en') return;
        const missing = applyToRoot(document.body, 'en');
        if (missing.length > 0) {
            fetchMissingTranslations(missing);
        }
    }

    function ensureEnDict() {
        if (dictLoaded && window.__INKINDO_EN_DICT) {
            return Promise.resolve();
        }
        if (dictLoadingPromise) {
            return dictLoadingPromise;
        }
        dictLoadingPromise = new Promise((resolve) => {
            const script = document.createElement('script');
            script.src = '/js/lang-en.js?v=3';
            script.async = true;
            script.onload = () => {
                dictLoaded = true;
                resolve();
            };
            script.onerror = () => resolve();
            document.head.appendChild(script);
        });
        return dictLoadingPromise;
    }

    function startObserver() {
        if (observer || !document.body) return;
        observer = new MutationObserver(() => {
            if (currentLang !== 'en') return;
            if (mutationTimer) clearTimeout(mutationTimer);
            mutationTimer = setTimeout(() => {
                mutationTimer = null;
                runEnglishPass();
            }, 60);
        });
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    function stopObserver() {
        if (mutationTimer) {
            clearTimeout(mutationTimer);
            mutationTimer = null;
        }
        if (observer) {
            observer.disconnect();
            observer = null;
        }
    }

    function updateButtons(lang) {
        document.documentElement.setAttribute('lang', lang);
        const btns = document.querySelectorAll('.lang-switch__btn[data-lang]');
        for (let i = 0; i < btns.length; i++) {
            btns[i].classList.toggle('is-active', btns[i].getAttribute('data-lang') === lang);
        }
    }

    async function setLanguage(lang, save = true) {
        const nextLang = (lang === 'en') ? 'en' : 'id';
        currentLang = nextLang;
        if (save) {
            localStorage.setItem(STORAGE_KEY, nextLang);
        }
        updateButtons(nextLang);

        if (nextLang === 'en') {
            await ensureEnDict();
            if (currentLang !== 'en') return;
            runEnglishPass();
            refreshHeroPhrases();
            startObserver();
        } else {
            stopObserver();
            applyToRoot(document.body, 'id');
            refreshHeroPhrases();
        }
    }

    function init() {
        origDocTitle = document.title;
        updateButtons(currentLang);

        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.lang-switch__btn[data-lang]');
            if (!btn) return;
            e.preventDefault();
            const targetLang = btn.getAttribute('data-lang');
            if (targetLang && targetLang !== currentLang) {
                setLanguage(targetLang, true);
            }
        });

        // Zero work on initial load if language is default 'id'
        if (currentLang === 'en') {
            setLanguage('en', false);
        }
    }

    window.InkindoI18n = {
        setLanguage: setLanguage,
        getLanguage: () => currentLang,
        refreshHeroPhrases: refreshHeroPhrases
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
