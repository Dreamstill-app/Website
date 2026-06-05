import type { Metadata } from "next";
import { AppMockup } from "@/components/AppMockup";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { NewsletterSignup } from "@/components/NewsletterSignup";
import { SectionHeader } from "@/components/SectionHeader";
import { WorkflowVisual } from "@/components/WorkflowVisual";
import { site } from "@/lib/site";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "Sorty app",
  description:
    "Sorty is Dreamstill's AI-powered clothing sorting app for garment identification, condition analysis, and circular pathway routing.",
  path: "/sorty",
});

const pilots = ["UBC capstone research collaborators", "Metro Vancouver circular fashion hosts", "Municipal textile diversion conversations"];

export default function SortyPage() {
  return (
    <div className="pt-28">
      <section className="container-shell section-space">
        <div className="grid gap-10 lg:grid-cols-[1fr_0.9fr] lg:items-center">
          <FadeIn>
            <div className="inline-flex rounded-full border border-[#8da18f]/30 bg-[#8da18f]/15 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#3f5244]">
              Sorty status: Beta — pilot partners onboarding for Spring 2026 launch
            </div>
            <h1 className="page-title mt-5 max-w-4xl">Meet Sorty, the next-best-use tool for unwanted clothing.</h1>
            <p className="mt-6 max-w-2xl text-lg leading-8 text-[#5f5b52]">
              Sorty is a computer vision mobile application that helps users determine the next best use for unwanted
              clothing in just a few taps — photo, short condition questions, and local pathway routing.
            </p>
            <div className="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
              <ButtonLink href="/contact?interest=Sorty%20app%20pilot">Request a pilot</ButtonLink>
              <ButtonLink href={site.calendlyPilot} variant="light">
                Book a pilot call
              </ButtonLink>
            </div>
          </FadeIn>
          <FadeIn delay={0.1}>
            <AppMockup />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="How it works"
            title="Simple decisions for circular textiles."
            copy="Take a photo, answer a few condition questions, and get a ranked recommendation with nearby locations."
            align="center"
          />
        </FadeIn>
        <div className="mt-8">
          <WorkflowVisual />
        </div>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-2">
          <FadeIn>
            <SectionHeader
              eyebrow="Why it exists"
              title="Textile waste is one of the fastest-growing waste streams globally."
              copy="Most people do not know what to do with unwanted clothing. Even when items are donated, reuse systems are overwhelmed."
            />
            <p className="mt-4 text-sm leading-7 text-[#625e55]">
              It is estimated that a large share of donated garments never reach resale markets domestically, often
              flowing to export, downcycling, or disposal. Dreamstill cites this figure directionally based on secondary
              market research and partner intake observations; exact rates vary by region and operator.
            </p>
          </FadeIn>
          <FadeIn delay={0.08}>
            <SectionHeader
              eyebrow="Technical credibility"
              title="Computer vision + pathway intelligence"
              copy="Sorty combines garment image signals, user-reported condition inputs, and rules-based pathway scoring to recommend resale, repair, donation, reuse, or recycling — then maps nearby partners."
            />
            <ul className="mt-6 grid gap-3 text-sm leading-7 text-[#625e55]">
              <li className="premium-card rounded-2xl p-4">On-device-friendly capture workflow for quick closet decisions</li>
              <li className="premium-card rounded-2xl p-4">Condition-aware scoring that prioritizes highest-value circular routes</li>
              <li className="premium-card rounded-2xl p-4">Partner map layer designed for municipal and retail integrations</li>
            </ul>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-5 md:grid-cols-3">
          {[
            {
              title: "For residents",
              copy: "Understand whether an item is best suited for resale, repair, donation, consignment, or recycling.",
            },
            {
              title: "For municipalities",
              copy: "Guide residents toward local infrastructure, support diversion reporting, and pilot textile education programs with procurement-friendly language.",
            },
            {
              title: "For investors",
              copy: "Climate technology with measurable diversion potential, partner network effects, and SaaS + services revenue paths.",
            },
          ].map((item, index) => (
            <FadeIn key={item.title} delay={index * 0.05}>
              <article className="premium-card h-full rounded-[2rem] p-6">
                <h3 className="font-serif text-2xl font-medium text-[#20201d]">{item.title}</h3>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{item.copy}</p>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-10">
            <SectionHeader
              eyebrow="Municipal procurement lens"
              title="Pilot-ready outputs for waste diversion teams."
              copy="Sorty pilots can include resident education modules, partner map configuration, aggregate pathway analytics, and quarterly reporting templates aligned to existing waste programs."
            />
            <ul className="mt-6 grid gap-3 sm:grid-cols-2">
              {[
                "Diversion-oriented resident guidance",
                "Configurable local partner directory",
                "Pilot terms with clear scope and timelines",
                "Integration notes for existing outreach channels",
              ].map((item) => (
                <li key={item} className="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-[#efe5d8]/82">
                  {item}
                </li>
              ))}
            </ul>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader eyebrow="Pilot collaborators" title="Early traction with research and community partners." />
        </FadeIn>
        <div className="mt-6 flex flex-wrap gap-3">
          {pilots.map((pilot) => (
            <span
              key={pilot}
              className="rounded-full border border-[#20201d]/10 bg-white/55 px-5 py-3 text-xs font-semibold uppercase tracking-[0.16em] text-[#625e55]"
            >
              {pilot}
            </span>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <NewsletterSignup />
        <p className="mt-4 text-center text-sm text-[#625e55]">Join the waitlist for Sorty launch updates and pilot openings.</p>
      </section>
    </div>
  );
}
