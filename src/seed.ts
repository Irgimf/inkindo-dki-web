import { getPayload } from 'payload'
import config from './payload.config'

async function seed() {
  const payload = await getPayload({ config })

  console.log('Seeding data...')

  // Seed Homepage Global
  await payload.updateGlobal({
    slug: 'homepage',
    data: {
      heroTypingText: [
        { text: 'Sistem Informasi Anggota' },
        { text: 'Pendaftaran Anggota' },
        { text: 'Direktori Anggota' },
        { text: 'Klinik Konsultasi' },
      ],
      statsTicker: [
        { value: '900+', label: 'Konsultan Aktif', sublabel: 'Badan usaha terdaftar' },
        { value: '#1', label: 'Provinsi Terbesar', sublabel: 'Dari 33 DPP' },
        { value: 'Hybrid', label: 'Layanan Terpadu', sublabel: 'Online & tatap muka' },
        { value: 'ISO 37001', label: 'Standar SMAP', sublabel: 'Anti penyuapan' },
      ]
    },
  })

  // Seed SiteSettings
  await payload.updateGlobal({
    slug: 'site-settings',
    data: {
      contactEmail: 'dpp_dki@inkindo.org',
      contactPhone: '(021) 797-1582 / 797-1583',
      address: 'Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760, DKI Jakarta',
      operatingHours: 'Senin - Jumat: 08.30 - 17.00 WIB',
    }
  })

  // Seed ExternalLinks
  await payload.updateGlobal({
    slug: 'external-links',
    data: {
      loginAnggota: 'https://www.inkindo-dki.org/auth/login',
      pendaftaranAnggota: 'https://www.inkindo-dki.org/register',
    }
  })

  // Seed Navigation (Footer)
  await payload.updateGlobal({
    slug: 'navigation',
    data: {
      footerLinks: [
        { label: 'Sistem Informasi Anggota (SIA)', url: '#' },
        { label: 'Pendaftaran & SBU Online', url: '#' },
        { label: 'Standar Billing Rate Remunerasi', url: '#' },
        { label: 'Direktori Anggota Terverifikasi', url: '#' },
      ],
      footerPolicy: [
        { label: 'Kebijakan Privasi', url: '#' },
        { label: 'Syarat Layanan', url: '#' },
        { label: 'LPJK PUPR', url: '#' },
      ]
    }
  })

  // Seed Banners
  const bannerCount = await payload.count({ collection: 'banners' })
  if (bannerCount.totalDocs === 0) {
    // We would need to upload media first, but we can't easily do that in a script without physical files.
    // So we'll skip creating banners with images for now, or just provide a dummy image ID if possible.
    // Actually, we can just insert a dummy banner with no image if the image field wasn't strictly required.
    // Wait, `image` is required in Banners.ts. Let's make it optional temporarily or skip it.
  }

  console.log('Seed complete!')
  process.exit(0)
}

seed().catch(console.error)
