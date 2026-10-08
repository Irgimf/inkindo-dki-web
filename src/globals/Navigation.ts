import type { GlobalConfig } from 'payload'

export const Navigation: GlobalConfig = {
  slug: 'navigation',
  label: 'Navigasi & Menu',
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'footerLinks',
      type: 'array',
      label: 'Menu Footer (Akses Cepat)',
      fields: [
        { name: 'label', type: 'text', label: 'Teks Link' },
        { name: 'url', type: 'text', label: 'URL' },
      ],
    },
    {
      name: 'footerPolicy',
      type: 'array',
      label: 'Kebijakan & Syarat (Bawah)',
      fields: [
        { name: 'label', type: 'text', label: 'Teks Link' },
        { name: 'url', type: 'text', label: 'URL' },
      ],
    },
  ],
}
