import type { Metadata } from "next";

const defaultOgImage = "/logo.svg";

export function createPageMetadata({
  title,
  description,
  path = "",
}: {
  title: string;
  description: string;
  path?: string;
}): Metadata {
  const url = `https://dreamstill.com${path}`;

  return {
    title,
    description,
    alternates: { canonical: url },
    openGraph: {
      title: `${title} | Dreamstill`,
      description,
      url,
      siteName: "Dreamstill",
      type: "website",
      images: [{ url: defaultOgImage, width: 1200, height: 630, alt: "Dreamstill" }],
    },
    twitter: {
      card: "summary_large_image",
      title: `${title} | Dreamstill`,
      description,
      images: [defaultOgImage],
    },
  };
}
