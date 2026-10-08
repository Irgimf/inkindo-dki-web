import type { CollectionConfig } from 'payload'

export const Magazines: CollectionConfig = {
  slug: 'magazines',
  labels: {
    singular: 'e-Magazine',
    plural: 'e-Magazine',
  },
  admin: {
    useAsTitle: 'title',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'edition',
      type: 'text',
      label: 'Edisi (contoh: 79)',
      required: true,
    },
    {
      name: 'title',
      type: 'text',
      label: 'Judul Majalah',
      required: true,
    },
    {
      name: 'cover',
      type: 'upload',
      relationTo: 'media',
      label: 'Cover Majalah',
      required: true,
    },
    {
      name: 'pdfFile',
      type: 'upload',
      relationTo: 'media',
      label: 'File PDF',
      required: true,
    },
    {
      name: 'publishDate',
      type: 'date',
      label: 'Tanggal Terbit',
      required: true,
    },
  ],
}
