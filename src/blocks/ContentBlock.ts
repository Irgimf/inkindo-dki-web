import type { Block } from 'payload'

export const ContentBlock: Block = {
  slug: 'content',
  labels: {
    singular: 'Teks Konten',
    plural: 'Teks Konten',
  },
  fields: [
    {
      name: 'richText',
      type: 'richText',
      label: 'Konten',
      required: true,
    },
  ],
}
