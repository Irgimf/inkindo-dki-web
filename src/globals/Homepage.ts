import type { GlobalConfig } from 'payload'

export const Homepage: GlobalConfig = {
  slug: 'homepage',
  label: 'Halaman Beranda',
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'heroTypingText',
      type: 'array',
      label: 'Teks Efek Ketik (Hero Search)',
      fields: [
        { name: 'text', type: 'text', label: 'Teks' },
      ],
    },
    {
      name: 'statsTicker',
      type: 'array',
      label: 'Ticker Statistik',
      fields: [
        { name: 'value', type: 'text', label: 'Nilai (contoh: 900+)' },
        { name: 'label', type: 'text', label: 'Label (contoh: Konsultan Aktif)' },
        { name: 'sublabel', type: 'text', label: 'Keterangan Kecil (contoh: Badan usaha terdaftar)' },
      ],
    },
    {
      name: 'featuredPosts',
      type: 'relationship',
      relationTo: 'posts',
      hasMany: true,
      maxRows: 3,
      label: 'Berita Unggulan (Tampil di Bento Beranda)',
    },
  ],
}
