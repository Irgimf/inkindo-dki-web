import type { CollectionConfig } from 'payload'

export const Faqs: CollectionConfig = {
  slug: 'faqs',
  labels: {
    singular: 'FAQ / Chatbot',
    plural: 'FAQ / Chatbot',
  },
  admin: {
    useAsTitle: 'question',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'question',
      type: 'text',
      label: 'Pertanyaan',
      required: true,
    },
    {
      name: 'answer',
      type: 'textarea',
      label: 'Jawaban Bot',
      required: true,
    },
    {
      name: 'keywords',
      type: 'text',
      label: 'Kata Kunci Pemicu (pisahkan koma)',
      admin: {
        description: 'Bot akan mengirim jawaban ini jika pesan user mengandung salah satu kata kunci ini.',
      },
      required: true,
    },
    {
      name: 'category',
      type: 'text',
      label: 'Kategori',
    },
  ],
}
