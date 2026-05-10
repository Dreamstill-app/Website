import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "About",
  description:
    "Meet Dreamstill, the BIPOC female-led Vancouver climate technology company building circular fashion infrastructure.",
};

const values = [
  "Human before technical",
  "Reuse before recycling",
  "Community before extraction",
  "Infrastructure before optics",
];

const timeline = [
  {
    year: "Origin",
    title: "A personal relationship with clothing waste",
    copy: "Dreamstill began with the emotional weight many people feel when they no longer know what to do with clothing they once valued.",
  },
  {
    year: "Insight",
    title: "The problem was not care. It was decision-making.",
    copy: "People, stores, and cities all face the same missing layer: fast, trusted, local guidance that keeps garments in use longer.",
  },
  {
    year: "Now",
    title: "Sorty turns uncertainty into action.",
    copy: "Our AI-powered textile circularity platform helps each garment find the most useful next pathway.",
  },
  {
    year: "Future",
    title: "Circular infrastructure for fashion.",
    copy: "Dreamstill is building the connective tissue between closets, repair culture, resale, donation systems, municipalities, and recycling networks.",
  },
];

export default function AboutPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <div className="grid gap-12 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
          <FadeIn>
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">About Dreamstill</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.95] tracking-[-0.06em] text-[#20201d] md:text-8xl">
              A climate technology company with a human memory.
            </h1>
            <p className="mt-7 text-lg leading-8 text-[#5f5b52]">
              Dreamstill is a BIPOC female-led circular fashion technology startup based in Vancouver. We help people
              and industries understand the true value of clothing and enable circular textile systems.
            </p>
            <div className="mt-9 flex flex-col gap-3 sm:flex-row">
              <ButtonLink href="/sorty">Explore Sorty</ButtonLink>
              <ButtonLink href="/contact" variant="light">Partner with us</ButtonLink>
            </div>
          </FadeIn>
          <FadeIn delay={0.1}>
            <div className="premium-card relative overflow-hidden rounded-[3rem] p-8 md:p-10">
              <div className="absolute -right-12 -top-10 h-52 w-52 rounded-full bg-[#efd2c2]/70 blur-3xl" />
              <div className="absolute -bottom-10 -left-10 h-52 w-52 rounded-full bg-[#8da18f]/40 blur-3xl" />
              <div className="relative">
                <p className="text-sm uppercase tracking-[0.28em] text-[#8a6d58]">Founder ethos</p>
                <blockquote className="font-serif mt-6 text-4xl leading-[1.05] tracking-[-0.04em] text-[#20201d] md:text-5xl">
                  “The future of fashion is not only what we make. It is how intelligently we care for what already exists.”
                </blockquote>
                <p className="mt-6 text-sm leading-7 text-[#625e55]">
                  Dreamstill carries cultural, community, and climate roots into a technology company designed to feel warm,
                  credible, and deeply useful.
                </p>
              </div>
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-10 lg:grid-cols-[0.8fr_1.2fr]">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">The problem</p>
                <h2 className="font-serif mt-4 text-4xl leading-[1.02] tracking-[-0.045em] text-[#fffaf1] md:text-6xl">
                  Fashion waste is not just material. It is emotional, local, and systemic.
                </h2>
                <p className="mt-5 text-base leading-8 text-[#efe5d8]/78 md:text-lg">
                  People want to help but feel overwhelmed. Stores want better intake but face labour strain. Cities want
                  diversion but lack behaviour-level infrastructure.
                </p>
              </div>
              <div className="grid gap-4 sm:grid-cols-2">
                {[
                  "Closets are full of garments people do not know how to move responsibly.",
                  "Donation streams are contaminated by items that should have gone elsewhere.",
                  "Repair businesses need visibility inside modern consumer journeys.",
                  "Municipal textile diversion needs better routing and better data.",
                ].map((item) => (
                  <div key={item} className="rounded-[2rem] border border-white/10 bg-white/5 p-5 text-sm leading-7 text-[#efe5d8]/78">
                    {item}
                  </div>
                ))}
              </div>
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <SectionHeader
            eyebrow="Story"
            title="From clothing guilt to circular intelligence."
            copy="Dreamstill is designed for the emotional moment when someone wants to do better and the operational moment when a system needs a smarter route."
          />
        </FadeIn>
        <div className="mt-10 grid gap-5">
          {timeline.map((item, index) => (
            <FadeIn key={item.title} delay={index * 0.06}>
              <div className="premium-card grid gap-5 rounded-[2.25rem] p-6 md:grid-cols-[0.22fr_0.78fr] md:p-8">
                <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">{item.year}</p>
                <div>
                  <h3 className="font-serif text-3xl leading-[1.05] tracking-[-0.035em] text-[#20201d] md:text-4xl">{item.title}</h3>
                  <p className="mt-3 text-sm leading-7 text-[#625e55]">{item.copy}</p>
                </div>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
          <FadeIn>
            <SectionHeader
              eyebrow="Mission and ethos"
              title="Keep clothing in use longer, with dignity and intelligence."
              copy="We believe climate-conscious fashion systems should be culturally relevant, technically sophisticated, and easy for people to participate in."
            />
          </FadeIn>
          <div className="grid gap-4 sm:grid-cols-2">
            {values.map((value, index) => (
              <FadeIn key={value} delay={index * 0.05}>
                <div className="premium-card rounded-[2rem] p-6">
                  <p className="font-serif text-3xl leading-[1.06] tracking-[-0.035em] text-[#20201d]">{value}</p>
                </div>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
