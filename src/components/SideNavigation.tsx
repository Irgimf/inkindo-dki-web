'use client';

import { useState, useEffect, useRef } from 'react';
import Link from 'next/link';

type ChatMsg = {
  id: number;
  text: string;
  who: 'user' | 'bot';
  typing?: boolean;
};

const replies = [
  { keys: ['daftar', 'anggota', 'registrasi', 'kta'], text: 'Untuk menjadi anggota, siapkan akta pendirian, NIB, dan NPWP badan usaha, lalu lakukan registrasi melalui Portal KTA. Tim sekretariat akan memverifikasi berkas Anda.' },
  { keys: ['sbu', 'sertifikat', 'lpjk'], text: 'Pengajuan rekomendasi SBU dilakukan melalui menu Login → Pengajuan SBU. Pastikan KTA Anda masih aktif sebelum mengajukan.' },
  { keys: ['jam', 'operasional', 'buka'], text: 'Sekretariat DPP INKINDO DKI Jakarta buka Senin - Jumat pukul 08.30 - 17.00 WIB.' },
  { keys: ['alamat', 'lokasi', 'kantor'], text: 'Sekretariat kami berada di Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760.' },
  { keys: ['lelang', 'tender'], text: 'Informasi lelang dapat dipantau melalui menu Info Lelang di sisi kanan, termasuk LPSE DKI Jakarta dan SPSE LKPP.' },
  { keys: ['konsultasi', 'klinik'], text: 'Klinik Konsultasi tersedia gratis untuk anggota. Silakan buka menu Klinik Konsultasi untuk mengajukan jadwal.' }
];

export default function SideNavigation() {
  const [currentPanel, setCurrentPanel] = useState<string | null>(null);
  
  // Chat state
  const [chatMsgs, setChatMsgs] = useState<ChatMsg[]>([]);
  const [chatStarted, setChatStarted] = useState(false);
  const [chatInput, setChatInput] = useState('');
  const chatBodyRef = useRef<HTMLDivElement>(null);
  const nextMsgId = useRef(1);

  const openPanel = (name: string) => {
    if (currentPanel === name) {
      setCurrentPanel(null);
    } else {
      setCurrentPanel(name);
      if (name === 'chat' && !chatStarted) {
        setChatStarted(true);
        setTimeout(() => {
          setChatMsgs([{ id: nextMsgId.current++, text: 'Halo! Saya Asisten INKINDO DKI Jakarta. Ada yang bisa saya bantu hari ini?', who: 'bot' }]);
        }, 300);
      }
    }
  };

  const closePanel = () => {
    setCurrentPanel(null);
  };

  useEffect(() => {
    if (currentPanel) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  }, [currentPanel]);

  useEffect(() => {
    if (chatBodyRef.current) {
      chatBodyRef.current.scrollTop = chatBodyRef.current.scrollHeight;
    }
  }, [chatMsgs, currentPanel]);

  const handleSendChat = (text: string) => {
    if (!text.trim()) return;
    const q = text.trim();
    setChatMsgs(prev => [...prev, { id: nextMsgId.current++, text: q, who: 'user' }, { id: nextMsgId.current++, text: '', who: 'bot', typing: true }]);
    setChatInput('');
    
    setTimeout(() => {
      const lower = q.toLowerCase();
      const hit = replies.find(r => r.keys.some(k => lower.includes(k)));
      const ans = hit ? hit.text : 'Terima kasih atas pertanyaannya. Untuk informasi lebih lanjut, hubungi sekretariat di (021) 797-1582 atau email dpp_dki@inkindo.org.';
      
      setChatMsgs(prev => {
        const newMsgs = [...prev];
        const lastIdx = newMsgs.length - 1;
        if (newMsgs[lastIdx].typing) {
          newMsgs[lastIdx] = { ...newMsgs[lastIdx], typing: false, text: ans };
        }
        return newMsgs;
      });
    }, 800);
  };

  return (
    <>
      {/* Side Nav Kanan */}
      <aside className="side-nav" id="side-nav" aria-label="Menu layanan">
        <div className="side-nav__list">
          <button type="button" className={`side-nav__link ${currentPanel === 'login' ? 'is-active' : ''}`} onClick={() => openPanel('login')}>
            <span className="material-symbols-outlined side-nav__icon">login</span>
            <span className="side-nav__label">Login</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'lelang' ? 'is-active' : ''}`} onClick={() => openPanel('lelang')}>
            <span className="material-symbols-outlined side-nav__icon">gavel</span>
            <span className="side-nav__label">Info Lelang</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'anggota' ? 'is-active' : ''}`} onClick={() => openPanel('anggota')}>
            <span className="material-symbols-outlined side-nav__icon">groups</span>
            <span className="side-nav__label">Anggota</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'mitra' ? 'is-active' : ''}`} onClick={() => openPanel('mitra')}>
            <span className="material-symbols-outlined side-nav__icon">handshake</span>
            <span className="side-nav__label">Mitra Kerja</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'klinik' ? 'is-active' : ''}`} onClick={() => openPanel('klinik')}>
            <span className="material-symbols-outlined side-nav__icon">medical_information</span>
            <span className="side-nav__label">Klinik Konsultasi</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'kontak' ? 'is-active' : ''}`} onClick={() => openPanel('kontak')}>
            <span className="material-symbols-outlined side-nav__icon">call</span>
            <span className="side-nav__label">Hubungi Kami</span>
          </button>
          <button type="button" className={`side-nav__link ${currentPanel === 'chat' ? 'is-active' : ''}`} onClick={() => openPanel('chat')}>
            <span className="material-symbols-outlined side-nav__icon">forum</span>
            <span className="side-nav__label">Chat</span>
          </button>
        </div>
      </aside>

      {/* Side Panel Geser */}
      <div className={`side-panel ${currentPanel ? 'is-open' : ''}`} aria-hidden={currentPanel ? 'false' : 'true'}>
        <div className="side-panel__top">
          <button type="button" className="side-panel__close" onClick={closePanel} aria-label="Tutup panel">
            <span className="material-symbols-outlined">close</span>
          </button>
        </div>

        {/* Login Panel */}
        <div className={`side-panel__content ${currentPanel === 'login' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Login</h3>
          <ul className="panel-links">
            <li><Link href="https://www.inkindo-dki.org/auth/login" className="panel-link" target="_blank" rel="noopener noreferrer">
              <div className="panel-link__icon"><span className="material-symbols-outlined">groups</span></div>
              <span><strong>Anggota INKINDO</strong><small>Akses portal untuk anggota terdaftar</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">handshake</span></div>
              <span><strong>Mitra Kerja</strong><small>Segera Hadir</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">admin_panel_settings</span></div>
              <span><strong>Admin Kesekretariatan</strong><small>Segera Hadir</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
          </ul>
        </div>

        {/* Info Lelang */}
        <div className={`side-panel__content ${currentPanel === 'lelang' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Info Lelang</h3>
          <p className="side-panel__desc">Pantau paket pengadaan jasa konsultansi pemerintah melalui kanal resmi berikut.</p>
          <ul className="panel-links">
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">shopping_cart_checkout</span></div>
              <span><strong>LKPP</strong><small>Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">campaign</span></div>
              <span><strong>Info Lelang Lainnya</strong><small>Informasi paket pengadaan alternatif</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
          </ul>
        </div>

        {/* Anggota */}
        <div className={`side-panel__content ${currentPanel === 'anggota' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Anggota</h3>
          <ul className="panel-links">
            <li><Link href="https://www.inkindo-dki.org/register" className="panel-link" target="_blank" rel="noopener noreferrer">
              <div className="panel-link__icon"><span className="material-symbols-outlined">person_add</span></div>
              <span><strong>Pendaftaran Anggota</strong><small>Registrasi baru keanggotaan INKINDO</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">autorenew</span></div>
              <span><strong>Perpanjangan Anggota</strong><small>Segera Hadir</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">fact_check</span></div>
              <span><strong>Anggota Terdaftar</strong><small>Direktori badan usaha terverifikasi</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
          </ul>
        </div>

        {/* Mitra Kerja */}
        <div className={`side-panel__content ${currentPanel === 'mitra' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Mitra Kerja</h3>
          <ul className="panel-links">
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">rule</span></div>
              <span><strong>Ketentuan Mitra Kerja</strong><small>Syarat dan panduan kemitraan</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
            <li><Link href="#" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">format_list_bulleted</span></div>
              <span><strong>Daftar Mitra Kerja</strong><small>Katalog mitra resmi INKINDO</small></span>
              <span className="material-symbols-outlined panel-link__arrow">chevron_right</span>
            </Link></li>
          </ul>
          <h4 style={{ marginTop: '24px', fontSize: '14px', fontWeight: 700, color: 'var(--slate-900)', display: 'flex', alignItems: 'center', gap: '8px' }}>
            <span className="material-symbols-outlined" style={{ color: 'var(--royal)', fontSize: '20px' }}>verified</span>
            Mitra Kerja Terdaftar
          </h4>
          <div className="partner-grid" style={{ marginTop: '12px', gridTemplateColumns: 'repeat(3, 1fr)' }}>
            {['avian', 'lesso', 'seven', 'dekkson', 'alila', 'propan'].map((mitra) => (
              <div key={mitra} className="partner-card" style={{ padding: '12px', alignItems: 'center', justifyContent: 'center', height: '100%' }}>
                <img src={`/mitra_logos/${mitra}.jpg`} alt={mitra} style={{ maxHeight: '35px', width: 'auto', mixBlendMode: 'multiply' }} />
              </div>
            ))}
          </div>
        </div>

        {/* Klinik Konsultasi */}
        <div className={`side-panel__content ${currentPanel === 'klinik' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Klinik Konsultasi</h3>
          <p className="side-panel__desc">Pendampingan gratis bagi anggota terkait regulasi, sertifikasi, dan pengadaan jasa konsultansi.</p>
          <div className="topic-list">
            <span className="topic-chip">Regulasi Pengadaan</span>
            <span className="topic-chip">SBU &amp; LPJK</span>
            <span className="topic-chip">SMAP ISO 37001</span>
            <span className="topic-chip">Billing Rate</span>
            <span className="topic-chip">Kontrak &amp; Sengketa</span>
            <span className="topic-chip">Perpajakan Jasa</span>
          </div>
          <div className="panel-info">
            <div className="panel-link__icon" style={{background:'transparent'}}><span className="material-symbols-outlined">schedule</span></div>
            <span>Sesi tatap muka &amp; daring<br/><small>Senin - Jumat: 08.30 - 17.00 WIB</small></span>
          </div>
          <a href="mailto:dpp_dki@inkindo.org?subject=Klinik%20Konsultasi" className="btn btn--primary btn--block">Ajukan Konsultasi</a>
        </div>

        {/* Hubungi Kami */}
        <div className={`side-panel__content ${currentPanel === 'kontak' ? 'is-active' : ''}`}>
          <h3 className="side-panel__title">Hubungi Kami</h3>
          <ul className="panel-links">
            <li><a href="tel:0217971582" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">call</span></div>
              <span><strong>(021) 797-1582 / 797-1583</strong><small>Telepon sekretariat</small></span>
            </a></li>
            <li><a href="mailto:dpp_dki@inkindo.org" className="panel-link">
              <div className="panel-link__icon"><span className="material-symbols-outlined">mail</span></div>
              <span><strong>dpp_dki@inkindo.org</strong><small>Email resmi</small></span>
            </a></li>
            <li>
              <div className="panel-link">
                <div className="panel-link__icon"><span className="material-symbols-outlined">location_on</span></div>
                <span><strong>Sekretariat DPP</strong><small>Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760</small></span>
              </div>
            </li>
            <li>
              <div className="panel-link">
                <div className="panel-link__icon"><span className="material-symbols-outlined">schedule</span></div>
                <span><strong>Jam Operasional</strong><small>Senin - Jumat: 08.30 - 17.00 WIB</small></span>
              </div>
            </li>
          </ul>
        </div>

        {/* Chat */}
        <div className={`side-panel__content side-panel__content--chat ${currentPanel === 'chat' ? 'is-active' : ''}`}>
          <div className="chat-head">
            <div className="chat-head__avatar" style={{ display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
              <span className="material-symbols-outlined" style={{ display: 'block', lineHeight: 1 }}>smart_toy</span>
            </div>
            <div>
              <h3 className="side-panel__title side-panel__title--chat">Asisten INKINDO</h3>
              <span className="chat-head__status">Online</span>
            </div>
          </div>
          <div className="chat-body" id="chat-body" ref={chatBodyRef}>
            {chatMsgs.map(msg => (
              <div key={msg.id} className={`chat-msg chat-msg--${msg.who} ${msg.typing ? 'chat-msg--typing' : ''}`}>
                {msg.typing ? (
                  <><i></i><i></i><i></i></>
                ) : (
                  msg.text
                )}
              </div>
            ))}
          </div>
          <div className="chat-quick" id="chat-quick">
            <button type="button" className="chat-quick__btn" onClick={() => handleSendChat('Cara daftar anggota')}>Cara daftar anggota</button>
            <button type="button" className="chat-quick__btn" onClick={() => handleSendChat('Info SBU')}>Info SBU</button>
            <button type="button" className="chat-quick__btn" onClick={() => handleSendChat('Jam operasional')}>Jam operasional</button>
          </div>
          <form className="chat-form" onSubmit={(e) => { e.preventDefault(); handleSendChat(chatInput); }}>
            <input type="text" className="chat-form__input" placeholder="Ketik pesan..." autoComplete="off" value={chatInput} onChange={e => setChatInput(e.target.value)} />
            <button type="submit" className="chat-form__btn" aria-label="Kirim">
              <span className="material-symbols-outlined">send</span>
            </button>
          </form>
        </div>
      </div>

      {/* Overlay */}
      <div className={`overlay ${currentPanel ? 'is-visible' : ''}`} onClick={closePanel}></div>
    </>
  );
}
