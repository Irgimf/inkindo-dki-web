'use client';

import { useState, useEffect, useRef } from 'react';
import Link from 'next/link';

export default function Hero() {
  const [activeSlide, setActiveSlide] = useState(0);
  const [tickerIndex, setTickerIndex] = useState(0);
  
  const slides = [
    {
      img: '/assets/hero-bg.jpg',
      intro: 'DPP Masa Bakti 2026–2030',
      title: 'Dewan Pengurus Provinsi INKINDO DKI Jakarta',
      link: '#tentang',
      graphic: null
    },
    {
      img: '/assets/gambar.png',
      intro: 'Kemitraan Kampus',
      title: 'INKINDO DKI Goes to Campus',
      link: '#berita',
      graphic: null
    },
    {
      img: '/assets/gambar2.jpg',
      intro: 'Agenda Mendatang',
      title: 'Pelatihan Audit Internal ISO 37001',
      link: '#berita',
      graphic: 'verified_user',
      dark: false
    },
    {
      img: '/assets/gambar1.jpg',
      intro: 'e-Magazine Edisi 79',
      title: 'Majalah INKINDO DKI Jakarta',
      link: '#berita',
      graphic: 'auto_stories',
      dark: true
    }
  ];

  const stats = [
    { value: '900+', label: 'Konsultan Aktif', sub: 'Badan usaha terdaftar' },
    { value: '#1', label: 'Provinsi Terbesar', sub: 'Dari 33 DPP' },
    { value: 'Hybrid', label: 'Layanan Terpadu', sub: 'Online & tatap muka' },
    { value: 'ISO 37001', label: 'Standar SMAP', sub: 'Anti penyuapan' }
  ];

  // Auto carousel
  useEffect(() => {
    const interval = setInterval(() => {
      setActiveSlide((prev) => (prev + 1) % slides.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [slides.length]);

  return (
    <section className="hero" id="hero">
      <div className="hero__bg" style={{ backgroundImage: "url('/assets/jakarta.jpg')" }}></div>
      <div className="hero__shade"></div>

      <div className="container hero__container">
        <div className="hero__content">
          <h1 className="sr-only">DPP INKINDO DKI Jakarta – Ekosistem Konsultansi Digital Jakarta</h1>

          <form className="hero-search" id="hero-search" onSubmit={e => e.preventDefault()}>
            <input type="text" id="hero-search-input" className="hero-search__input" autoComplete="off" aria-label="Cari layanan" placeholder="Cari layanan..." />
          </form>

          {/* Carousel */}
          <div className="carousel" id="hero-carousel">
            <div className="carousel__track">
              {slides.map((slide, idx) => (
                <div key={idx} className={`carousel__slide ${idx === activeSlide ? 'is-active' : ''} ${slide.graphic ? 'carousel__slide--graphic' : ''} ${slide.dark ? 'carousel__slide--dark' : ''}`}>
                  <img src={slide.img} alt={slide.title} />
                  {slide.graphic && <span className="material-symbols-outlined carousel__graphic">{slide.graphic}</span>}
                  <div className="carousel__caption">
                    <span className="carousel__intro">{slide.intro}</span>
                    <a href={slide.link} className="carousel__title">{slide.title}</a>
                  </div>
                </div>
              ))}
            </div>
            <button type="button" className="carousel__nav carousel__nav--prev" onClick={() => setActiveSlide((s) => (s === 0 ? slides.length - 1 : s - 1))} aria-label="Sebelumnya">
              <span className="material-symbols-outlined">chevron_left</span>
            </button>
            <button type="button" className="carousel__nav carousel__nav--next" onClick={() => setActiveSlide((s) => (s + 1) % slides.length)} aria-label="Berikutnya">
              <span className="material-symbols-outlined">chevron_right</span>
            </button>
            <div className="carousel__dots">
              {slides.map((_, idx) => (
                <button key={idx} type="button" className={`carousel__dot ${idx === activeSlide ? 'is-active' : ''}`} onClick={() => setActiveSlide(idx)} aria-label={`Slide ${idx + 1}`}></button>
              ))}
            </div>
          </div>

          <div className="hero-bottom-bar">
            <div className="mitra-kerja">
              <div className="mitra-kerja__head">
                <h2 className="mitra-kerja__title">Mitra Kerja</h2>
              </div>
              <div className="mitra-kerja__marquee-wrapper">
                <div className="mitra-kerja__marquee">
                  <div className="mitra-kerja__track">
                    <div className="mitra-card"><img src="/mitra_logos/avian.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/lesso.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/seven.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/dekkson.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/alila.jpg" alt="" /></div>
                  </div>
                  <div className="mitra-kerja__track">
                    <div className="mitra-card"><img src="/mitra_logos/kulitbatu.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/lesso.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/kjpp.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/amtyas.jpg" alt="" /></div>
                    <div className="mitra-card"><img src="/mitra_logos/dc.jpg" alt="" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div className="scroll-hint">
              <span className="material-symbols-outlined scroll-hint__icon">keyboard_double_arrow_down</span>
              <p>Scroll untuk melihat lebih</p>
            </div>
          </div>
        </div>
      </div>

      <div className="widget-strip">
        <div className="container widget-strip__inner">
          <a href="#tentang" className="widget-strip__label">Tentang INKINDO DKI</a>
          <div className="ticker" id="stats-ticker">
            <button type="button" className="ticker__nav" onClick={() => setTickerIndex((i) => (i === 0 ? stats.length - 1 : i - 1))}>
              <span className="material-symbols-outlined">chevron_left</span>
            </button>
            <div className="ticker__viewport">
              {stats.map((s, idx) => (
                <div key={idx} className={`ticker__item ${idx === tickerIndex ? 'is-active' : ''}`}>
                  <strong>{s.value}</strong> {s.label} <em>{s.sub}</em>
                </div>
              ))}
            </div>
            <button type="button" className="ticker__nav" onClick={() => setTickerIndex((i) => (i + 1) % stats.length)}>
              <span className="material-symbols-outlined">chevron_right</span>
            </button>
          </div>
          <p className="widget-strip__note">Data keanggotaan diperbarui berkala.</p>
        </div>
      </div>
    </section>
  );
}
