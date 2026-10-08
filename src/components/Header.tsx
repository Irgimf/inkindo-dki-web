/* eslint-disable @typescript-eslint/no-explicit-any */
'use client';

import { useState, useEffect } from 'react';
import Link from 'next/link';

export default function Header({ settings }: { settings?: any }) {
  const [isScrolled, setIsScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const [searchOpen, setSearchOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);
  const [lang, setLang] = useState('id');

  useEffect(() => {
    const onScroll = () => {
      const scrolled = window.scrollY > 40;
      setIsScrolled(scrolled);
      document.body.classList.toggle('is-scrolled', scrolled);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => {
    document.body.classList.toggle('menu-open', menuOpen);
    document.body.style.overflow = menuOpen ? 'hidden' : '';
  }, [menuOpen]);

  // Click outside to close dropdowns
  useEffect(() => {
    const handleClickOutside = (e: MouseEvent) => {
      if (!(e.target as Element).closest('.has-dropdown')) {
        setOpenDropdown(null);
      }
    };
    document.addEventListener('click', handleClickOutside);
    return () => document.removeEventListener('click', handleClickOutside);
  }, []);

  const toggleDropdown = (name: string, e: React.MouseEvent) => {
    e.preventDefault();
    setOpenDropdown((prev) => (prev === name ? null : name));
  };

  const toggleSearch = () => {
    setMenuOpen(false);
    setSearchOpen(!searchOpen);
    if (!searchOpen) {
      setTimeout(() => document.getElementById('header-search-input')?.focus(), 300);
    }
  };

  return (
    <header className={`main-header ${isScrolled || searchOpen ? 'is-scrolled' : ''}`} id="main-header">
      <div className="container main-header__inner">
        <Link href="/" className="main-header__logo" id="logo-link" aria-label="Beranda DPP INKINDO DKI Jakarta">
          <img src={settings?.logo?.url || "/assets/logo-inkindo.png"} alt="Logo DPP INKINDO DKI Jakarta" />
        </Link>

        <nav className="main-nav" id="main-nav" aria-label="Navigasi utama">
          <ul className="main-nav__menu">
            <li><Link href="/" className="main-nav__link is-active" id="nav-home">Home</Link></li>
            
            <li className={`has-dropdown ${openDropdown === 'tentang' ? 'is-open' : ''}`}>
              <a href="#tentang" className="main-nav__link" onClick={(e) => toggleDropdown('tentang', e)}>Tentang Kami</a>
              <ul className="dropdown">
                <li><Link href="/profil" onClick={() => setMenuOpen(false)}>Profil Inkindo</Link></li>
                <li><Link href="/struktur-organisasi" onClick={() => setMenuOpen(false)}>Struktur Organisasi</Link></li>
              </ul>
            </li>
            
            <li className={`has-dropdown ${openDropdown === 'regulasi' ? 'is-open' : ''}`}>
              <a href="#regulasi" className="main-nav__link" onClick={(e) => toggleDropdown('regulasi', e)}>Regulasi</a>
              <ul className="dropdown">
                <li><Link href="/regulasi/inkindo" onClick={() => setMenuOpen(false)}>Regulasi Inkindo</Link></li>
                <li><Link href="/regulasi/jasa-konsultansi" onClick={() => setMenuOpen(false)}>Regulasi Jasa Konsultasi</Link></li>
                <li><Link href="/regulasi/terkait" onClick={() => setMenuOpen(false)}>Regulasi Terkait</Link></li>
              </ul>
            </li>
            
            <li><Link href="#berita" className="main-nav__link">Berita &amp; Informasi</Link></li>
            
            <li className="main-nav__icon-item">
              <button type="button" className="main-nav__icon" onClick={toggleSearch} aria-label="Cari">
                <span className="material-symbols-outlined">search</span>
              </button>
            </li>
            
            <li>
              <div className="lang-switch">
                <button type="button" className={`lang-switch__btn ${lang === 'id' ? 'is-active' : ''}`} onClick={() => setLang('id')}>ID</button>
                <button type="button" className={`lang-switch__btn ${lang === 'en' ? 'is-active' : ''}`} onClick={() => setLang('en')}>EN</button>
              </div>
            </li>
          </ul>
        </nav>

        <button type="button" className="mobile-toggle" onClick={() => setMenuOpen(!menuOpen)} aria-label="Buka menu">
          <span className="material-symbols-outlined">{menuOpen ? 'close' : 'menu'}</span>
        </button>
      </div>

      <div className={`header-search ${searchOpen ? 'is-open' : ''}`} id="header-search">
        <form className="container header-search__form" onSubmit={(e) => e.preventDefault()}>
          <input type="text" id="header-search-input" className="header-search__input" placeholder="Cari di sini?" autoComplete="off" />
          <button type="submit" className="header-search__btn" aria-label="Cari">
            <span className="material-symbols-outlined">search</span>
          </button>
        </form>
      </div>
    </header>
  );
}
