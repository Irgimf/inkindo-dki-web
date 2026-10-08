import type { CollectionConfig } from 'payload'

export const OrgUnits: CollectionConfig = {
  slug: 'org_units',
  labels: {
    singular: 'Badan / Unit Organisasi',
    plural: 'Badan / Unit Organisasi',
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
      label: 'Nama Badan / Unit (mis. DPPH, DPPL)',
      required: true,
    },
    {
      name: 'parent',
      type: 'relationship',
      relationTo: 'org_units',
      label: 'Induk Badan (Opsional)',
    },
    {
      name: 'order',
      type: 'number',
      label: 'Urutan Tampil',
      defaultValue: 0,
    },
  ],
}
