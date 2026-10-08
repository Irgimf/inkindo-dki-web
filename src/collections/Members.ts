import type { CollectionConfig } from 'payload'

export const Members: CollectionConfig = {
  slug: 'members',
  labels: {
    singular: 'Anggota Terdaftar',
    plural: 'Anggota Terdaftar',
  },
  admin: {
    useAsTitle: 'companyName',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'companyName',
      type: 'text',
      label: 'Nama Perusahaan',
      required: true,
    },
    {
      name: 'npa',
      type: 'text',
      label: 'NPA (Nomor Pokok Anggota)',
      required: true,
      unique: true,
    },
    {
      name: 'field',
      type: 'text',
      label: 'Bidang / Subklasifikasi',
    },
    {
      name: 'city',
      type: 'text',
      label: 'Kota Domisili',
    },
    {
      name: 'status',
      type: 'select',
      label: 'Status Keanggotaan',
      options: [
        { label: 'Aktif', value: 'aktif' },
        { label: 'Non-Aktif', value: 'nonaktif' },
      ],
      defaultValue: 'aktif',
    },
    {
      name: 'validUntil',
      type: 'date',
      label: 'Masa Berlaku Sampai',
    },
    {
      name: 'website',
      type: 'text',
      label: 'Website Perusahaan',
    },
  ],
}
