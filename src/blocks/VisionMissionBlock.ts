import type { Block } from 'payload'

export const VisionMissionBlock: Block = {
  slug: 'visionMission',
  labels: {
    singular: 'Visi & Misi',
    plural: 'Visi & Misi',
  },
  fields: [
    {
      name: 'vision',
      type: 'textarea',
      label: 'Visi',
      required: true,
    },
    {
      name: 'missions',
      type: 'array',
      label: 'Misi',
      required: true,
      minRows: 1,
      fields: [
        {
          name: 'item',
          type: 'textarea',
          required: true,
        },
      ],
    },
  ],
}
