import type { GlobalConfig } from 'payload'

export const SiteSettings: GlobalConfig = {
  slug: 'site-settings',
  label: 'Pengaturan Web',
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'logo',
      type: 'upload',
      relationTo: 'media',
      label: 'Logo Utama',
    },
    {
      name: 'contactEmail',
      type: 'email',
      label: 'Email Resmi',
    },
    {
      name: 'contactPhone',
      type: 'text',
      label: 'Nomor Telepon (Utama)',
    },
    {
      name: 'address',
      type: 'textarea',
      label: 'Alamat Sekretariat',
    },
    {
      name: 'operatingHours',
      type: 'text',
      label: 'Jam Operasional',
    },
    {
      name: 'socialLinks',
      type: 'array',
      label: 'Sosial Media',
      fields: [
        { name: 'platform', type: 'text', label: 'Platform (contoh: Facebook, Instagram)' },
        { name: 'url', type: 'text', label: 'Link URL' },
      ],
    },
    {
      name: 'googleMapsUrl',
      type: 'text',
      label: 'Link / Embed Google Maps',
    },
  ],
}
