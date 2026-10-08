import type { CollectionConfig } from 'payload'

export const ContactMessages: CollectionConfig = {
  slug: 'contact_messages',
  labels: {
    singular: 'Pesan Kontak',
    plural: 'Pesan Kontak',
  },
  admin: {
    useAsTitle: 'name',
  },
  access: {
    read: () => true,
    create: () => true, // Allows public submission
  },
  fields: [
    {
      name: 'name',
      type: 'text',
      label: 'Nama Pengirim',
      required: true,
    },
    {
      name: 'email',
      type: 'email',
      label: 'Email',
      required: true,
    },
    {
      name: 'subject',
      type: 'text',
      label: 'Subjek Pesan',
      required: true,
    },
    {
      name: 'message',
      type: 'textarea',
      label: 'Isi Pesan',
      required: true,
    },
    {
      name: 'status',
      type: 'select',
      label: 'Status Penanganan',
      options: [
        { label: 'Belum Dibaca', value: 'unread' },
        { label: 'Sudah Dibalas', value: 'replied' },
      ],
      defaultValue: 'unread',
    },
  ],
}
