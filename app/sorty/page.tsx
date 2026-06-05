import type { Metadata } from "next";
import { AppMockup } from "@/components/AppMockup";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { GarmentLifecycle } from "@/components/GarmentLifecycle";
import { SectionHeader } from "@/components/SectionHeader";
import { WorkflowVisual } from "@/components/WorkflowVisual";

export const metadata: Metadata = {
  title: "Sorty Product",
  description:
    "Sorty is an AI-powered clothing sorting app for garment identification, condition analysis, and circular pathway routing.",
};

const pathways = [
  {
    title: "Resale",
    copy: "High-quality garments are directed toward resale and consignment pathways that preserve economic value.",
  },
  {
    title: "Repair",
    copy: "Items with fixable wear are routed toward local repair shops and mending culture before they leave use.",
  },
  {
    title: "Donation",
    copy: "Donation-ready items are matched with partners that can receive useful, qualified garments.",
  },
  {
    title: "Reuse",
    copy: "Community reuse, swaps, and creative redistribution keep clothing circulating locally.",
  },
  {
    title: "Recycling",
    copy: "Textile recycling is reserved for garments that no longer have realistic reuse potential.",
  },
];

const roadmap = [
  "Partner analytics for intake quality, referral patterns, and diversion trends",
  "Municipal textile heatmaps for neighbourhood-level circular infrastructure",
  "Expanded garment categories, fabric signals, and condition scoring",
  "Repairability intelligence and local service availability",
];

export default function SortyPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <div className="grid gap-12 lg:grid-cols-[1fr_0.9fr] lg:items-center">
          <FadeIn>
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Sorty product</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.94] tracking-[-0.065em] text-[#20201d] md:text-8xl">
              AI-powered guidance for every garment decision.
            </h1>
            <p className="mt-7 max-w-2xl text-lg leading-8 text-[#5f5b52]">
              Sorty identifies clothing, assesses visible condition, scores circular pathways, and routes users to the
              best next option: resale, repair, donation, reuse, or recycling.
            </p>
            <div className="mt-9 flex flex-col gap-3 sm:flex-row">
              <ButtonLink href="/contact">Request product access</ButtonLink>
              <ButtonLink href="/businesses" variant="light">For partners</ButtonLink>
            </div>
          </FadeIn>
          <FadeIn delay={0.12}>
            <AppMockup />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <SectionHeader
            eyebrow="How it works"
            title="From photo to circular pathway in seconds."
            copy="Sorty is designed to make the responsible decision feel simple for people and more useful for downstream partners."
            align="center"
          />
        </FadeIn>
        <div className="mt-10">
          <FadeIn>
            <WorkflowVisual />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
          <FadeIn>
            <SectionHeader
              eyebrow="Pathway intelligence"
              title="Every garment deserves a better question than trash or donate."
              copy="Sorty ranks the highest-value circular route first, helping users and partners make reuse-first decisions."
            />
          </FadeIn>
          <div className="grid gap-4 md:grid-cols-2">
            {pathways.map((pathway, index) => (
              <FadeIn key={pathway.title} delay={index * 0.05}>
                <div className="premium-card h-full rounded-[2rem] p-6">
                  <p className="font-serif text-3xl tracking-[-0.035em] text-[#20201d]">{pathway.title}</p>
                  <p className="mt-4 text-sm leading-7 text-[#625e55]">{pathway.copy}</p>
                </div>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
          <FadeIn>
            <GarmentLifecycle />
          </FadeIn>
          <FadeIn delay={0.1}>
            <SectionHeader
              eyebrow="Before and after"
              title="Before Sorty: uncertainty. After Sorty: confident action."
              copy="A user no longer has to search scattered rules, guess store fit, or default to disposal. Sorty translates garment context into a local, useful next step."
            />
            <div className="mt-8 grid gap-4">
              <div className="rounded-[2rem] border border-[#20201d]/8 bg-white/45 p-5">
                <p className="text-xs uppercase tracking-[0.28em] text-[#8a6d58]">Before</p>
                <p className="mt-3 text-sm leading-7 text-[#625e55]">Can I donate this? Is it too worn? Should I repair it? Where does it go?</p>
              </div>
              <div className="rounded-[2rem] bg-[#20201d] p-5 text-[#fffaf1]">
                <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">After</p>
                <p className="mt-3 text-sm leading-7 text-[#efe5d8]/82">This blazer has strong resale potential. Three nearby partners can accept it this week.</p>
              </div>
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Roadmap</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] md:text-7xl">
                  From app intelligence to ecosystem infrastructure.
                </h2>
                <p className="mt-6 text-lg leading-8 text-[#efe5d8]/78">
                  Sorty is the consumer interface for a broader circular fashion technology layer.
                </p>
              </div>
              <div className="grid gap-4">
                {roadmap.map((item, index) => (
                  <div key={item} className="rounded-[2rem] border border-white/10 bg-white/5 p-5">
                    <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">0{index + 1}</p>
                    <p className="mt-3 text-base leading-7 text-[#fffaf1]">{item}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
