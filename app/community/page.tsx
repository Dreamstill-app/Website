import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "Community and Events",
  description:
    "Dreamstill community programming, swaps, workshops, circular fashion partnerships, climate events, and education.",
};

const programs = [
  {
    title: "Clothing swaps",
    copy: "Youth-forward events that make reuse social, joyful, and culturally relevant.",
  },
  {
    title: "Repair workshops",
    copy: "Programming that restores repair culture and helps garments stay in use longer.",
  },
  {
    title: "Circular fashion education",
    copy: "Workshops for schools, partners, and communities navigating textile waste without shame.",
  },
  {
    title: "Climate activations",
    copy: "Events that connect fashion behaviour to local climate action and circular economy participation.",
  },
];

const moments = [
  "Community-led swaps",
  "Repair partner spotlights",
  "Circular economy panels",
  "Campus and youth programming",
  "Municipal education pop-ups",
  "Fashion activism collaborations",
];

export default function CommunityPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <FadeIn>
          <div className="mx-auto max-w-5xl text-center">
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Community and events</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.94] tracking-[-0.065em] text-[#20201d] md:text-8xl">
              Circular fashion has to feel human to scale.
            </h1>
            <p className="mx-auto mt-7 max-w-3xl text-lg leading-8 text-[#5f5b52]">
              Dreamstill pairs premium climate technology with community programming that makes reuse, repair, and
              textile diversion feel visible, local, and hopeful.
            </p>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-12">
        <div className="grid gap-5 md:grid-cols-2">
          {programs.map((program, index) => (
            <FadeIn key={program.title} delay={index * 0.05}>
              <div className="premium-card h-full rounded-[2.5rem] p-7">
                <div className="h-44 rounded-[2rem] bg-gradient-to-br from-[#20201d] via-[#6b725f] to-[#d3a58d] p-5">
                  <div className="h-full rounded-[1.5rem] border border-white/20 bg-white/10 backdrop-blur-sm" />
                </div>
                <h2 className="font-serif mt-6 text-4xl leading-[1.05] tracking-[-0.04em] text-[#20201d]">{program.title}</h2>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{program.copy}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Emotional legitimacy</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] md:text-7xl">
                  Not a campaign. A culture of better next lives.
                </h2>
                <p className="mt-6 text-lg leading-8 text-[#efe5d8]/78">
                  Technology can guide the decision. Community makes the decision feel possible, shared, and worth repeating.
                </p>
              </div>
              <div className="grid gap-3 sm:grid-cols-2">
                {moments.map((moment) => (
                  <div key={moment} className="rounded-[2rem] border border-white/10 bg-white/5 p-5 text-sm font-medium text-[#fffaf1]">
                    {moment}
                  </div>
                ))}
              </div>
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
          <FadeIn>
            <SectionHeader
              eyebrow="Partnerships"
              title="Build climate-conscious fashion systems with the people already doing the work."
              copy="Dreamstill collaborates with community partners, repair specialists, educators, sustainability organizations, and local circular economy leaders."
            />
            <div className="mt-8 flex flex-col gap-3 sm:flex-row">
              <ButtonLink href="/contact">Host an activation</ButtonLink>
              <ButtonLink href="/impact" variant="light">Explore impact</ButtonLink>
            </div>
          </FadeIn>
          <FadeIn delay={0.1}>
            <div className="premium-card rounded-[3rem] p-8">
              <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Programming lens</p>
              <div className="mt-6 grid gap-5">
                {[
                  ["Hope", "Move people from climate anxiety to agency."],
                  ["Intelligence", "Teach practical, local pathways for garments."],
                  ["Warmth", "Make circularity feel welcoming, not judgmental."],
                  ["Cultural relevance", "Meet fashion communities where they already gather."],
                ].map(([title, copy]) => (
                  <div key={title} className="rounded-[2rem] bg-white/55 p-5">
                    <p className="font-serif text-3xl tracking-[-0.035em] text-[#20201d]">{title}</p>
                    <p className="mt-2 text-sm leading-6 text-[#625e55]">{copy}</p>
                  </div>
                ))}
              </div>
            </div>
          </FadeIn>
        </div>
      </section>
    </div>
  );
}
