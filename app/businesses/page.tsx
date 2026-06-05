import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "For Businesses",
  description:
    "Sorty partnerships for thrift stores, consignment stores, repair shops, municipalities, and circular economy organizations.",
};

const segments = [
  {
    id: "thrift",
    audience: "Thrift stores and charities",
    headline: "Better donation quality before donations arrive.",
    pain: ["Low-quality donations", "Sorting labour", "Unusable garments", "Donation stream contamination"],
    outcomes: ["Less staff sorting time", "Higher resale potential", "More qualified donations", "App referral foot traffic"],
    tone: "Operational partnership",
  },
  {
    id: "consignment",
    audience: "Consignment stores",
    headline: "Premium intake pre-screening for higher-value inventory.",
    pain: ["Overwhelmed staff", "Unsuitable appointments", "Inconsistent client quality", "Manual condition assessment"],
    outcomes: ["Streamlined appointments", "Saved staff hours", "Better quality control", "Higher-value inventory"],
    tone: "AI-powered operational technology",
  },
  {
    id: "repair",
    audience: "Repair shops",
    headline: "Modern discovery for repair culture.",
    pain: ["Customer acquisition", "Low visibility", "Fragmented local discovery", "Declining repair habits"],
    outcomes: ["Priority Sorty listings", "New local customers", "Featured repair routes", "Circular ecosystem membership"],
    tone: "Local visibility layer",
  },
  {
    id: "municipalities",
    audience: "Municipalities",
    headline: "Intelligent textile diversion for climate-conscious cities.",
    pain: ["Landfill pressure", "Low behaviour-level data", "Scattered reuse resources", "Limited textile infrastructure"],
    outcomes: ["Reuse-first routing", "Diversion insights", "Local ecosystem maps", "Public education support"],
    tone: "Civic circular infrastructure",
  },
];

const onboarding = [
  "Map the partner's intake rules, service area, capacity, and ideal garment categories.",
  "Configure Sorty routing so users see the most relevant next step before they arrive.",
  "Launch local education, referral flows, and partner visibility inside the Sorty experience.",
  "Measure referral quality, circular outcomes, and operational learnings over time.",
];

export default function BusinessesPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <FadeIn>
          <div className="mx-auto max-w-5xl text-center">
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">For businesses and cities</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.94] tracking-[-0.065em] text-[#20201d] md:text-8xl">
              Circular infrastructure that solves operational problems.
            </h1>
            <p className="mx-auto mt-7 max-w-3xl text-lg leading-8 text-[#5f5b52]">
              Sorty helps thrift stores, consignment retailers, repair shops, municipalities, and circular economy
              partners reduce friction across the clothing reuse system.
            </p>
            <div className="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
              <ButtonLink href="/contact">Discuss a partnership</ButtonLink>
              <ButtonLink href="/sorty" variant="light">See Sorty workflow</ButtonLink>
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-12">
        <div className="grid gap-6">
          {segments.map((segment, index) => (
            <FadeIn key={segment.id} delay={index * 0.05}>
              <article id={segment.id} className="premium-card scroll-mt-32 rounded-[2.75rem] p-6 md:p-9">
                <div className="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
                  <div>
                    <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">{segment.audience}</p>
                    <h2 className="font-serif mt-5 text-4xl leading-[1.02] tracking-[-0.045em] text-[#20201d] md:text-6xl">
                      {segment.headline}
                    </h2>
                    <p className="mt-5 inline-flex rounded-full bg-[#20201d] px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#fffaf1]">
                      {segment.tone}
                    </p>
                  </div>
                  <div className="grid gap-4 md:grid-cols-2">
                    <div className="rounded-[2rem] border border-[#20201d]/8 bg-white/50 p-5">
                      <p className="text-xs font-semibold uppercase tracking-[0.28em] text-[#8a6d58]">Pain points</p>
                      <ul className="mt-4 grid gap-3 text-sm leading-6 text-[#625e55]">
                        {segment.pain.map((item) => (
                          <li key={item}>- {item}</li>
                        ))}
                      </ul>
                    </div>
                    <div className="rounded-[2rem] bg-[#8da18f]/20 p-5">
                      <p className="text-xs font-semibold uppercase tracking-[0.28em] text-[#56685b]">ROI outcomes</p>
                      <ul className="mt-4 grid gap-3 text-sm leading-6 text-[#394038]">
                        {segment.outcomes.map((item) => (
                          <li key={item}>- {item}</li>
                        ))}
                      </ul>
                    </div>
                  </div>
                </div>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:items-start">
          <FadeIn>
            <SectionHeader
              eyebrow="Subscription partnership"
              title="A practical onboarding flow for local circular systems."
              copy="Dreamstill partnership work is designed to be clear: understand your operational rules, configure intelligent routing, launch with your community, and measure what improves."
            />
          </FadeIn>
          <div className="grid gap-4">
            {onboarding.map((item, index) => (
              <FadeIn key={item} delay={index * 0.05}>
                <div className="premium-card flex gap-5 rounded-[2rem] p-5">
                  <span className="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#20201d] text-sm font-semibold text-[#fffaf1]">
                    {index + 1}
                  </span>
                  <p className="text-sm leading-7 text-[#625e55]">{item}</p>
                </div>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-8 lg:grid-cols-[1fr_0.7fr] lg:items-center">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Enterprise-ready circularity</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] md:text-7xl">
                  Make textile diversion measurable, local, and easier to participate in.
                </h2>
              </div>
              <div className="flex flex-col gap-3">
                <ButtonLink href="/contact" variant="sage">Start a pilot</ButtonLink>
                <ButtonLink href="/impact" variant="light">Explore impact</ButtonLink>
              </div>
            </div>
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
