import type { Metadata } from "next";
import Link from "next/link";
import { ContactForm } from "@/components/ContactForm";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";
import { SocialLinks } from "@/components/SocialLinks";
import { site } from "@/lib/site";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "Contact",
  description: "Contact Dreamstill for Sorty pilots, corporate experiences, partnerships, media, and investor inquiries.",
  path: "/contact",
});

const inquiryTypes = [
  { title: "Sorty app pilot", copy: "Municipal pilots, partner integrations, and product access." },
  { title: "Corporate experience booking", copy: "Team building, conferences, retreats, and activations." },
  { title: "Investor or grant inquiry", copy: "Climate technology roadmap and partnership opportunities." },
  { title: "Media or speaking", copy: "Interviews, founder background, and brand assets." },
];

export default async function ContactPage({
  searchParams,
}: {
  searchParams: Promise<{ interest?: string }>;
}) {
  const params = await searchParams;
  const defaultInterest = params.interest ?? "General inquiry";

  return (
    <div className="pt-28">
      <section className="container-shell section-space">
        <div className="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
          <FadeIn>
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Contact</p>
            <h1 className="page-title mt-5 max-w-4xl">Questions, pilots, or circular fashion ideas?</h1>
            <p className="mt-6 max-w-2xl text-lg leading-8 text-[#5f5b52]">
              Tell us what you&apos;re building. We&apos;ll route Sorty pilots, corporate bookings, and partnership inquiries to the
              right workflow.
            </p>
            <p className="mt-4 text-sm font-medium text-[#56685b]">{site.responseTime}</p>
            <p className="mt-2 text-sm leading-7 text-[#625e55]">
              After you submit, you&apos;ll receive a confirmation by email. Our team reviews your note and follows up with next
              steps — usually a reply or scheduling link within 2 business days.
            </p>
            <ul className="mt-8 grid gap-3 text-sm text-[#514f48]">
              <li>
                <a href={site.phoneHref} className="font-semibold text-[#20201d] hover:underline">
                  {site.phone}
                </a>
              </li>
              <li>
                <a href={`mailto:${site.email}`} className="font-semibold text-[#20201d] hover:underline">
                  {site.email}
                </a>
              </li>
            </ul>
            <div className="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href={site.calendlyDiscovery}
                target="_blank"
                rel="noreferrer"
                className="inline-flex items-center justify-center rounded-full bg-[#20201d] px-6 py-3 text-sm font-semibold text-[#fffaf1]"
              >
                Book on Calendly
              </Link>
              <Link
                href="/portfolio#calendly"
                className="inline-flex items-center justify-center rounded-full border border-[#20201d]/10 bg-white/55 px-6 py-3 text-sm font-semibold text-[#20201d]"
              >
                Book an experience
              </Link>
            </div>
          </FadeIn>
          <FadeIn delay={0.08}>
            <ContactForm defaultInterest={defaultInterest as never} />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader eyebrow="Inquiry pathways" title="Every partner enters through a clear door." />
        </FadeIn>
        <div className="mt-8 grid gap-5 md:grid-cols-2">
          {inquiryTypes.map((type, index) => (
            <FadeIn key={type.title} delay={index * 0.05}>
              <div className="premium-card h-full rounded-[2.25rem] p-6">
                <p className="page-subtitle text-2xl">{type.title}</p>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{type.copy}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <div className="premium-card rounded-[3rem] p-8">
            <SectionHeader
              eyebrow="Community WhatsApp"
              title="Join the Dreamstill community chat"
              copy="A space for circular fashion updates, event announcements, and community coordination. Professional inquiries should still use the form or Calendly."
            />
            <Link
              href={site.whatsappGroup}
              target="_blank"
              rel="noreferrer"
              className="mt-6 inline-flex rounded-full bg-[#8da18f] px-6 py-3 text-sm font-semibold text-[#1e241f]"
            >
              Join WhatsApp group
            </Link>
            <SocialLinks className="mt-8" />
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
