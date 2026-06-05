import type { Metadata } from "next";
import Link from "next/link";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { FeatureSlider } from "@/components/FeatureSlider";
import { NewsletterSignup } from "@/components/NewsletterSignup";
import { PartnerStrip } from "@/components/PartnerStrip";
import { SectionHeader } from "@/components/SectionHeader";
import {
  backedBy,
  canadaStats,
  canadaStatsSource,
  partnerTypes,
  recognition,
  site,
  socialProof,
} from "@/lib/site";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "Clean tech for clothing with a future",
  description:
    "Dreamstill equips people and industries with AI-powered textile circularity tools, community activations, and Sorty — the sorting app for better clothing decisions.",
  path: "/",
});

const solutions = [
  {
    title: "Technological development",
    copy: "Digital decision-support tools that identify the next best use for textiles and help municipalities and residents navigate circular options.",
  },
  {
    title: "Community engagement",
    copy: "Circular fashion activations that make repair, reuse, swaps, and education feel inviting, creative, and connected.",
  },
];

export default function Home() {
  return (
    <div className="overflow-hidden pt-28">
      <section className="container-shell section-space relative min-h-[calc(100vh-8rem)]">
        <div className="absolute -right-24 top-16 h-72 w-72 rounded-full bg-[#8da18f]/30 blur-3xl" />
        <div className="grid items-center gap-10 lg:grid-cols-[1.02fr_0.98fr]">
          <FadeIn>
            <div className="inline-flex rounded-full border border-[#20201d]/10 bg-white/55 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#6a655d] shadow-sm backdrop-blur">
              {site.tagline}
            </div>
            <h1 className="page-title mt-6 max-w-4xl">Clean tech for clothing with a future.</h1>
            <p className="mt-6 max-w-2xl text-lg leading-8 text-[#555149] md:text-xl">
              We help people, communities, and industries see the true value of clothing through AI-powered decision
              support, circular fashion events, and textile recovery education.
            </p>
            <div className="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
              <ButtonLink href="/sorty">See how Sorty works</ButtonLink>
              <ButtonLink href="/portfolio#calendly" variant="light">
                Book an experience
              </ButtonLink>
              <ButtonLink href="/contact" variant="light">
                Partner with us
              </ButtonLink>
            </div>
          </FadeIn>
          <FadeIn delay={0.12}>
            <FeatureSlider />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <div className="rounded-[2.75rem] border border-[#20201d]/10 bg-[#fffaf1]/72 p-8 shadow-2xl shadow-[#20201d]/8 backdrop-blur md:p-12">
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Our mission</p>
            <h2 className="page-subtitle mt-4 max-w-4xl">{site.mission}</h2>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          {socialProof.map((item, index) => (
            <FadeIn key={item.label} delay={index * 0.04}>
              <div className="premium-card rounded-[2rem] p-5">
                <p className="font-serif text-4xl font-medium tracking-[-0.04em] text-[#20201d]">{item.value}</p>
                <p className="mt-3 text-sm leading-6 text-[#625e55]">{item.label}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Our solutions"
            title="Technology and community, connected."
            copy="Smarter tools reduce confusion. Community programming turns behaviour change into culture."
          />
        </FadeIn>
        <div className="mt-8 grid gap-5 md:grid-cols-2">
          {solutions.map((solution, index) => (
            <FadeIn key={solution.title} delay={index * 0.06}>
              <article className="premium-card h-full rounded-[2.5rem] p-7">
                <p className="text-xs font-semibold uppercase tracking-[0.28em] text-[#8a6d58]">Solution 0{index + 1}</p>
                <h3 className="page-subtitle mt-4 text-3xl md:text-4xl">{solution.title}</h3>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{solution.copy}</p>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Did you know?"
            title="Canada's textile opportunity is enormous."
            copy="The waste stream is large — and so is the opportunity to recover value from clothing already in circulation."
          />
        </FadeIn>
        <div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          {canadaStats.map((stat, index) => (
            <FadeIn key={stat.label} delay={index * 0.04}>
              <div className="premium-card rounded-[2rem] p-5">
                <p className="font-serif text-4xl font-medium tracking-[-0.04em] text-[#20201d]">{stat.value}</p>
                <p className="mt-3 text-sm leading-6 text-[#625e55]">{stat.label}</p>
              </div>
            </FadeIn>
          ))}
        </div>
        <p className="mt-6 max-w-4xl text-xs leading-6 text-[#6a655d]">{canadaStatsSource}</p>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
          <FadeIn>
            <SectionHeader
              eyebrow="Who we work with"
              title="If you're building circular systems, you belong here."
              copy="Dreamstill partners with organizations that want practical climate action — not performative sustainability."
            />
            <ul className="mt-6 grid gap-3">
              {partnerTypes.map((type) => (
                <li key={type} className="rounded-2xl border border-[#20201d]/8 bg-white/45 px-4 py-3 text-sm text-[#514f48]">
                  {type}
                </li>
              ))}
            </ul>
          </FadeIn>
          <FadeIn delay={0.08}>
            <PartnerStrip />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Recognition"
            title="Building credibility through community and product milestones."
            copy="Dreamstill is growing through pilots, activations, and research-aligned partnerships across British Columbia."
          />
        </FadeIn>
        <div className="mt-8 grid gap-4 md:grid-cols-2">
          {recognition.map((item) => (
            <div key={item} className="premium-card rounded-[2rem] p-5 text-sm leading-7 text-[#625e55]">
              {item}
            </div>
          ))}
        </div>
        <div className="mt-8">
          <p className="text-xs font-semibold uppercase tracking-[0.28em] text-[#8a6d58]">Backed by &amp; building with</p>
          <div className="mt-4 flex flex-wrap gap-3">
            {backedBy.map((item) => (
              <span
                key={item}
                className="rounded-full border border-[#20201d]/10 bg-white/55 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#625e55]"
              >
                {item}
              </span>
            ))}
          </div>
        </div>
      </section>

      <section className="container-shell section-space">
        <NewsletterSignup />
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Connect</p>
                <h2 className="page-subtitle mt-4 text-[#fffaf1]">Have questions or want to collaborate?</h2>
                <p className="mt-4 max-w-2xl text-base leading-7 text-[#efe5d8]/78">
                  Explore Sorty pilots, circular fashion events, textile education, or industry partnerships.
                </p>
                <p className="mt-4 text-sm text-[#efe5d8]/72">
                  <a href={`mailto:${site.email}`} className="underline underline-offset-4">
                    {site.email}
                  </a>{" "}
                  · {site.phone}
                </p>
              </div>
              <div className="flex flex-col gap-3">
                <ButtonLink href="/contact" variant="sage">
                  Contact us
                </ButtonLink>
                <Link
                  href={site.social.instagram}
                  target="_blank"
                  rel="noreferrer"
                  className="rounded-full border border-white/15 px-6 py-3 text-center text-sm font-semibold text-[#fffaf1]"
                >
                  Connect on Instagram
                </Link>
              </div>
            </div>
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
