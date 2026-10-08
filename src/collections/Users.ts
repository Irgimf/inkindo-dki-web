import type { CollectionConfig } from 'payload'

export const Users: CollectionConfig = {
  slug: 'users',
  labels: {
    singular: 'Pengguna',
    plural: 'Pengguna',
  },
  auth: {
    useAPIKey: true,
  },
  admin: {
    useAsTitle: 'email',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'name',
      type: 'text',
      label: 'Nama Lengkap',
      required: true,
    },
    {
      name: 'role',
      type: 'select',
      label: 'Peran (Role)',
      required: true,
      defaultValue: 'editor',
      options: [
        { label: 'Super Admin', value: 'admin' },
        { label: 'Editor', value: 'editor' },
        { label: 'Kontributor', value: 'contributor' },
      ],
    },
    {
      name: 'active',
      type: 'checkbox',
      label: 'Status Aktif',
      defaultValue: true,
    },
    {
      name: 'twoFactorEnabled',
      type: 'checkbox',
      label: '2FA Aktif (Autentikasi Dua Langkah)',
      defaultValue: false,
      admin: {
        description: 'Tandai jika pengguna ini telah mengaktifkan 2FA (Implementasi lanjutan).',
      },
    },
  ],
}
