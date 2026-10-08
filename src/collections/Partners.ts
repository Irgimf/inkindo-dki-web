import type { CollectionConfig } from 'payload'

export const Partners: CollectionConfig = {
  slug: 'partners',
  labels: {
    singular: 'Mitra Kerja',
    plural: 'Mitra Kerja',
  },
  admin: {
    useAsTitle: 'name',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'name',
      type: 'text',
      label: 'Nama Mitra',
      required: true,
    },
    {
      name: 'logo',
      type: 'upload',
      relationTo: 'media',
      label: 'Logo Mitra',
      required: true,
    },
    {
      name: 'category',
      type: 'text',
      label: 'Kategori / Bidang Usaha',
    },
    {
      name: 'website',
      type: 'text',
      label: 'Link Website',
    },
    {
      name: 'description',
      type: 'textarea',
      label: 'Deskripsi Singkat',
    },
    {
      name: 'showOnHome',
      type: 'checkbox',
      label: 'Tampilkan di Marquee Beranda',
      defaultValue: true,
    },
    {
      name: 'order',
      type: 'number',
      label: 'Urutan',
      defaultValue: 0,
    },
  ],
}
