/* THIS FILE WAS GENERATED AUTOMATICALLY BY PAYLOAD. */
import { RootLayout } from '@payloadcms/next/layouts'
import { handleServerFunctions } from '@payloadcms/next/utilities'
import { importMap } from './admin/importMap'
import config from '@payload-config'

type Args = {
  children: React.ReactNode
}

const Layout = ({ children }: Args) => (
  <RootLayout config={config} importMap={importMap} serverFunction={handleServerFunctions}>
    {children}
  </RootLayout>
)

export default Layout
