import type { GlobalConfig } from 'payload'

export const ExternalLinks: GlobalConfig = {
  slug: 'external-links',
  label: 'Tautan Eksternal',
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'loginAnggota',
      type: 'text',
      label: 'URL Login Anggota',
      defaultValue: 'https://www.inkindo-dki.org/auth/login',
    },
    {
      name: 'pendaftaranAnggota',
      type: 'text',
      label: 'URL Pendaftaran Anggota',
      defaultValue: 'https://www.inkindo-dki.org/register',
    },
    {
      name: 'perpanjanganAnggota',
      type: 'text',
      label: 'URL Perpanjangan Anggota',
    },
    {
      name: 'loginMitra',
      type: 'text',
      label: 'URL Login Mitra Kerja',
    },
    {
      name: 'loginAdmin',
      type: 'text',
      label: 'URL Login Admin Kesekretariatan',
    },
  ],
}
