import type { Block } from 'payload'

export const ImageBlock: Block = {
  slug: 'image',
  labels: {
    singular: 'Gambar',
    plural: 'Gambar',
  },
  fields: [
    {
      name: 'image',
      type: 'upload',
      relationTo: 'media',
      required: true,
      label: 'Upload Gambar',
    },
    {
      name: 'caption',
      type: 'text',
      label: 'Caption (Opsional)',
    },
    {
      name: 'fullWidth',
      type: 'checkbox',
      label: 'Tampilkan Lebar Penuh',
      defaultValue: false,
    },
  ],
}
