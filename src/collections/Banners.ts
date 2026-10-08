import type { CollectionConfig } from 'payload'

export const Banners: CollectionConfig = {
  slug: 'banners',
  labels: {
    singular: 'Banner Hero',
    plural: 'Banner Hero',
  },
  admin: {
    useAsTitle: 'title',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'title',
      type: 'text',
      label: 'Judul Banner',
      required: true,
    },
    {
      name: 'intro',
      type: 'text',
      label: 'Teks Intro (Kecil di atas judul)',
    },
    {
      name: 'image',
      type: 'upload',
      relationTo: 'media',
      label: 'Gambar Background',
      required: true,
    },
    {
      name: 'link',
      type: 'text',
      label: 'URL Tautan',
    },
    {
      name: 'order',
      type: 'number',
      label: 'Urutan Tampil',
      defaultValue: 0,
    },
    {
      name: 'startDate',
      type: 'date',
      label: 'Mulai Tayang',
    },
    {
      name: 'endDate',
      type: 'date',
      label: 'Akhir Tayang',
    },
    {
      name: 'isActive',
      type: 'checkbox',
      label: 'Aktif',
      defaultValue: true,
    },
  ],
}
