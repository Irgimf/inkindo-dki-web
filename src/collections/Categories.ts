import type { CollectionConfig } from 'payload'

export const Categories: CollectionConfig = {
  slug: 'categories',
  labels: {
    singular: 'Kategori',
    plural: 'Kategori',
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
      label: 'Nama Kategori',
      required: true,
    },
    {
      name: 'slug',
      type: 'text',
      label: 'URL Slug',
      required: true,
      unique: true,
    },
    {
      name: 'type',
      type: 'select',
      label: 'Tipe Kategori',
      required: true,
      options: [
        { label: 'Berita', value: 'news' },
        { label: 'Agenda', value: 'event' },
        { label: 'Lainnya', value: 'other' },
      ],
      defaultValue: 'news',
    },
  ],
}
