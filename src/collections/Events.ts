import type { CollectionConfig } from 'payload'

export const Events: CollectionConfig = {
  slug: 'events',
  labels: {
    singular: 'Agenda',
    plural: 'Agenda',
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
      label: 'Judul Agenda',
      required: true,
    },
    {
      name: 'cover',
      type: 'upload',
      relationTo: 'media',
      label: 'Gambar Cover',
    },
    {
      name: 'description',
      type: 'richText',
      label: 'Deskripsi Agenda',
    },
    {
      name: 'startDate',
      type: 'date',
      label: 'Tanggal & Waktu Mulai',
      admin: {
        date: {
          pickerAppearance: 'dayAndTime',
        },
      },
      required: true,
    },
    {
      name: 'endDate',
      type: 'date',
      label: 'Tanggal & Waktu Selesai',
      admin: {
        date: {
          pickerAppearance: 'dayAndTime',
        },
      },
    },
    {
      name: 'location',
      type: 'text',
      label: 'Lokasi',
    },
    {
      name: 'mode',
      type: 'select',
      label: 'Mode Pelaksanaan',
      options: [
        { label: 'Luring (Tatap Muka)', value: 'offline' },
        { label: 'Daring (Online)', value: 'online' },
        { label: 'Hybrid', value: 'hybrid' },
      ],
      defaultValue: 'offline',
    },
    {
      name: 'registrationLink',
      type: 'text',
      label: 'Link Pendaftaran',
    },
  ],
}
