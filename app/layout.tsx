import type { Metadata } from "next";
import { Cormorant_Garamond, Inter } from "next/font/google";
import type { ReactNode } from "react";
import Script from "next/script";
import { Footer } from "@/components/Footer";
import { MobileCtaBar } from "@/components/MobileCtaBar";
import { SiteHeader } from "@/components/SiteHeader";
import "./globals.css";

const inter = Inter({
  subsets: ["latin"],
  variable: "--font-sans",
  display: "swap",
});

const cormorant = Cormorant_Garamond({
  subsets: ["latin"],
  variable: "--font-serif",
  display: "swap",
  weight: ["400", "500", "600"],
});

export const metadata: Metadata = {
  metadataBase: new URL("https://dreamstill.com"),
  title: {
    default: "Dreamstill | AI-powered textile circularity",
    template: "%s | Dreamstill",
  },
  description:
    "Dreamstill builds circular fashion technology and Sorty, an AI clothing sorting app for textile reuse, repair, donation, resale, and diversion.",
  keywords: [
    "textile recycling app",
    "circular fashion technology",
    "clothing donation app",
    "sustainable fashion app",
    "textile waste reduction",
    "fashion circular economy",
    "clothing reuse platform",
    "AI clothing sorting",
    "textile diversion technology",
  ],
  openGraph: {
    title: "Dreamstill | Circular intelligence for fashion",
    description:
      "AI-powered circular decision-making infrastructure that helps clothing find its next life.",
    url: "https://dreamstill.com",
    siteName: "Dreamstill",
    type: "website",
  },
};

export default function RootLayout({ children }: { children: ReactNode }) {
  return (
    <html lang="en" className={`${inter.variable} ${cormorant.variable}`}>
      <body className="pb-24 lg:pb-0">
        <SiteHeader />
        <main>{children}</main>
        <Footer />
        <MobileCtaBar />
        {process.env.NEXT_PUBLIC_PLAUSIBLE_DOMAIN ? (
          <Script
            defer
            data-domain={process.env.NEXT_PUBLIC_PLAUSIBLE_DOMAIN}
            src="https://plausible.io/js/script.js"
            strategy="afterInteractive"
          />
        ) : null}
      </body>
    </html>
  );
}
