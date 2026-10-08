import type { Block } from 'payload'

export const TimelineBlock: Block = {
  slug: 'timeline',
  labels: {
    singular: 'Linimasa (Timeline)',
    plural: 'Linimasa',
  },
  fields: [
    {
      name: 'events',
      type: 'array',
      label: 'Peristiwa',
      required: true,
      minRows: 1,
      fields: [
        {
          name: 'year',
          type: 'text',
          label: 'Tahun',
          required: true,
        },
        {
          name: 'title',
          type: 'text',
          label: 'Judul Peristiwa',
          required: true,
        },
        {
          name: 'description',
          type: 'textarea',
          label: 'Deskripsi Singkat',
        },
      ],
    },
  ],
}
