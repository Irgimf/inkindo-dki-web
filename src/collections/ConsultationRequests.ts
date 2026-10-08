import type { CollectionConfig } from 'payload'

export const ConsultationRequests: CollectionConfig = {
  slug: 'consultation_requests',
  labels: {
    singular: 'Permintaan Konsultasi',
    plural: 'Permintaan Konsultasi',
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
      label: 'Nama Pemohon',
      required: true,
    },
    {
      name: 'company',
      type: 'text',
      label: 'Nama Perusahaan',
    },
    {
      name: 'email',
      type: 'email',
      label: 'Email',
      required: true,
    },
    {
      name: 'phone',
      type: 'text',
      label: 'Nomor Telepon',
    },
    {
      name: 'topic',
      type: 'text',
      label: 'Topik Konsultasi',
      required: true,
    },
    {
      name: 'question',
      type: 'textarea',
      label: 'Pertanyaan / Detail',
      required: true,
    },
    {
      name: 'status',
      type: 'select',
      label: 'Status Penanganan',
      options: [
        { label: 'Baru Masuk', value: 'baru' },
        { label: 'Sedang Diproses', value: 'proses' },
        { label: 'Selesai', value: 'selesai' },
      ],
      defaultValue: 'baru',
    },
    {
      name: 'adminNotes',
      type: 'textarea',
      label: 'Catatan Admin (Internal)',
    },
  ],
}
