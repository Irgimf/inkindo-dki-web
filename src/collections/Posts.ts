import type { CollectionConfig } from 'payload'
import { isAdminOrEditor, isAnyUser } from './access/roles'

export const Posts: CollectionConfig = {
  slug: 'posts',
  labels: {
    singular: 'Berita',
    plural: 'Berita',
  },
  admin: {
    useAsTitle: 'title',
  },
  versions: {
    drafts: true,
  },
  access: {
    read: () => true,
    create: isAnyUser,
    update: isAnyUser,
    delete: isAdminOrEditor,
  },
  hooks: {
    beforeChange: [
      ({ req: { user }, data }) => {
        if (data._status === 'published' && user?.role === 'contributor') {
          throw new Error('Kontributor tidak diizinkan mempublikasikan konten.')
        }
        return data
      },
    ],
  },
  fields: [
    {
      name: 'title',
      type: 'text',
      label: 'Judul Berita',
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
      name: 'summary',
      type: 'textarea',
      label: 'Ringkasan Singkat',
    },
    {
      name: 'cover',
      type: 'upload',
      relationTo: 'media',
      label: 'Gambar Cover',
    },
    {
      name: 'content',
      type: 'richText',
      label: 'Isi Berita',
      required: true,
    },
    {
      name: 'category',
      type: 'relationship',
      relationTo: 'categories',
      label: 'Kategori',
      hasMany: true,
    },
    {
      name: 'tags',
      type: 'text',
      label: 'Tag (pisahkan dengan koma)',
    },
    {
      name: 'featured',
      type: 'checkbox',
      label: 'Berita Unggulan',
      defaultValue: false,
    },
    {
      name: 'publishedDate',
      type: 'date',
      label: 'Tanggal Publish',
    },
    {
      name: 'author',
      type: 'relationship',
      relationTo: 'users',
      label: 'Penulis',
    },
    {
      name: 'seo',
      type: 'group',
      label: 'SEO Settings',
      fields: [
        { name: 'metaTitle', type: 'text', label: 'Meta Title' },
        { name: 'metaDescription', type: 'textarea', label: 'Meta Description' },
      ],
    },
  ],
}
