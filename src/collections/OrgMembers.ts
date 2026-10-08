import type { CollectionConfig } from 'payload'

export const OrgMembers: CollectionConfig = {
  slug: 'org_members',
  labels: {
    singular: 'Pengurus Organisasi',
    plural: 'Pengurus Organisasi',
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
      label: 'Nama Lengkap',
      required: true,
    },
    {
      name: 'photo',
      type: 'upload',
      relationTo: 'media',
      label: 'Foto Profil',
    },
    {
      name: 'position',
      type: 'text',
      label: 'Jabatan',
      required: true,
    },
    {
      name: 'unit',
      type: 'relationship',
      relationTo: 'org_units',
      label: 'Badan / Unit',
      required: true,
    },
    {
      name: 'period',
      type: 'text',
      label: 'Periode (mis. 2026-2030)',
    },
    {
      name: 'order',
      type: 'number',
      label: 'Urutan Tampil',
      defaultValue: 0,
    },
  ],
}
