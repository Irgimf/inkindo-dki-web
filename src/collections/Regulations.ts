import type { CollectionConfig } from 'payload'

export const Regulations: CollectionConfig = {
  slug: 'regulations',
  labels: {
    singular: 'Regulasi',
    plural: 'Regulasi',
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
      label: 'Judul Regulasi',
      required: true,
    },
    {
      name: 'number',
      type: 'text',
      label: 'Nomor Regulasi',
      required: true,
    },
    {
      name: 'year',
      type: 'number',
      label: 'Tahun',
      required: true,
    },
    {
      name: 'category',
      type: 'select',
      label: 'Kategori Utama',
      required: true,
      options: [
        { label: 'Regulasi INKINDO', value: 'inkindo' },
        { label: 'Regulasi Jasa Konsultansi', value: 'jasa_konsultansi' },
        { label: 'Regulasi Terkait', value: 'terkait' },
      ],
    },
    {
      name: 'subCategory',
      type: 'select',
      label: 'Sub Kategori',
      admin: {
        condition: (data) => data.category === 'jasa_konsultansi',
      },
      options: [
        { label: 'Konstruksi', value: 'konstruksi' },
        { label: 'Non Konstruksi', value: 'non_konstruksi' },
        { label: 'Umum', value: 'umum' },
      ],
    },
    {
      name: 'pdfFile',
      type: 'upload',
      relationTo: 'media',
      label: 'File PDF Regulasi',
      required: true,
    },
    {
      name: 'summary',
      type: 'textarea',
      label: 'Ringkasan Singkat',
    },
    {
      name: 'status',
      type: 'select',
      label: 'Status Berlaku',
      options: [
        { label: 'Berlaku', value: 'berlaku' },
        { label: 'Dicabut/Tidak Berlaku', value: 'dicabut' },
      ],
      defaultValue: 'berlaku',
    },
    {
      name: 'downloads',
      type: 'number',
      label: 'Jumlah Unduh',
      defaultValue: 0,
      admin: {
        readOnly: true,
      },
    },
  ],
}
