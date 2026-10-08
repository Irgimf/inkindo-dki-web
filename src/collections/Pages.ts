import type { CollectionConfig } from 'payload'
import { isAdminOrEditor, isAnyUser } from './access/roles'
import { ContentBlock } from '../blocks/ContentBlock'
import { ImageBlock } from '../blocks/ImageBlock'
import { VisionMissionBlock } from '../blocks/VisionMissionBlock'
import { TimelineBlock } from '../blocks/TimelineBlock'

export const Pages: CollectionConfig = {
  slug: 'pages',
  labels: {
    singular: 'Halaman',
    plural: 'Halaman',
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
      label: 'Judul Halaman',
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
      name: 'layout',
      type: 'blocks',
      label: 'Layout Halaman',
      blocks: [
        ContentBlock,
        ImageBlock,
        VisionMissionBlock,
        TimelineBlock,
      ],
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
