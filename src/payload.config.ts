import { buildConfig } from 'payload'
import { postgresAdapter } from '@payloadcms/db-postgres'
import { lexicalEditor } from '@payloadcms/richtext-lexical'
import path from 'path'
import { fileURLToPath } from 'url'

import { Users } from './collections/Users'
import { Media } from './collections/Media'
import { Pages } from './collections/Pages'
import { Banners } from './collections/Banners'
import { Posts } from './collections/Posts'
import { Categories } from './collections/Categories'
import { Events } from './collections/Events'
import { Magazines } from './collections/Magazines'
import { Regulations } from './collections/Regulations'
import { OrgUnits } from './collections/OrgUnits'
import { OrgMembers } from './collections/OrgMembers'
import { Members } from './collections/Members'
import { Partners } from './collections/Partners'
import { Tenders } from './collections/Tenders'
import { Faqs } from './collections/Faqs'
import { ConsultationRequests } from './collections/ConsultationRequests'
import { ContactMessages } from './collections/ContactMessages'

import { SiteSettings } from './globals/SiteSettings'
import { ExternalLinks } from './globals/ExternalLinks'
import { Homepage } from './globals/Homepage'
import { Navigation } from './globals/Navigation'

const filename = fileURLToPath(import.meta.url)
const dirname = path.dirname(filename)

export default buildConfig({
  admin: {
    user: 'users',
    meta: {
      titleSuffix: '- INKINDO DKI Jakarta',
    },
  },
  collections: [
    Users,
    Media,
    Pages,
    Banners,
    Posts,
    Categories,
    Events,
    Magazines,
    Regulations,
    OrgUnits,
    OrgMembers,
    Members,
    Partners,
    Tenders,
    Faqs,
    ConsultationRequests,
    ContactMessages,
  ],
  globals: [
    SiteSettings,
    ExternalLinks,
    Homepage,
    Navigation,
  ],
  editor: lexicalEditor({}),
  db: postgresAdapter({
    pool: {
      connectionString: process.env.DATABASE_URI || 'postgres://postgres:postgres@127.0.0.1:5432/inkindo',
    },
  }),
  secret: process.env.PAYLOAD_SECRET || 'fallback-secret',
  typescript: {
    outputFile: path.resolve(dirname, 'payload-types.ts'),
  },
})
