import type { CollectionConfig } from 'payload'

export const Tenders: CollectionConfig = {
  slug: 'tenders',
  labels: {
    singular: 'Info Lelang',
    plural: 'Info Lelang',
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
      label: 'Judul Paket Lelang',
      required: true,
    },
    {
      name: 'agency',
      type: 'text',
      label: 'Instansi / K/L/PD',
      required: true,
    },
    {
      name: 'source',
      type: 'select',
      label: 'Sumber Informasi',
      options: [
        { label: 'LKPP (SPSE)', value: 'lkpp' },
        { label: 'Lainnya', value: 'lainnya' },
      ],
      defaultValue: 'lkpp',
    },
    {
      name: 'hpsValue',
      type: 'number',
      label: 'Nilai HPS (Rp)',
    },
    {
      name: 'deadlineDate',
      type: 'date',
      label: 'Batas Waktu',
      admin: {
        date: {
          pickerAppearance: 'dayAndTime',
        },
      },
    },
    {
      name: 'sourceLink',
      type: 'text',
      label: 'Link Sumber Asli',
      required: true,
    },
  ],
}
