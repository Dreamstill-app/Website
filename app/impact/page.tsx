import type { Metadata } from "next";
import { AnimatedCounter } from "@/components/AnimatedCounter";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { GarmentLifecycle } from "@/components/GarmentLifecycle";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "Impact",
  description:
    "Dreamstill impact storytelling for textile waste reduction, landfill diversion, circular economy metrics, and reuse-first systems.",
};

const metrics = [
  { value: 92, suffix: "M", label: "tonnes of textile waste are generated globally each year" },
  { value: 85, suffix: "%", label: "of discarded textiles are commonly estimated to be landfilled or incinerated" },
  { value: 1, suffix: "", label: "garment decision can become a resale, repair, donation, reuse, or recovery route" },
  { value: 5, suffix: "", label: "core pathways Sorty evaluates for each scanned item" },
];

const dashboard = [
  "Garments routed away from landfill",
  "Reuse-first recommendations",
  "Partner referral quality",
  "Repair and resale demand signals",
  "Neighbourhood circular access gaps",
  "Donation stream quality indicators",
];

export default function ImpactPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <div className="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
          <FadeIn>
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Impact</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.94] tracking-[-0.065em] text-[#20201d] md:text-8xl">
              Textile waste needs intelligence, not shame.
            </h1>
            <p className="mt-7 max-w-2xl text-lg leading-8 text-[#5f5b52]">
              Dreamstill turns climate concern into useful action by helping garments move through the highest-value
              circular pathway before recycling becomes the only option.
            </p>
          </FadeIn>
          <FadeIn delay={0.1}>
            <div className="grid grid-cols-2 gap-4">
              {metrics.map((metric) => (
                <div key={metric.label} className="premium-card rounded-[2.25rem] p-6">
                  <p className="font-serif text-5xl leading-none tracking-[-0.05em] text-[#20201d] md:text-6xl">
                    <AnimatedCounter value={metric.value} suffix={metric.suffix} />
                  </p>
                  <p className="mt-4 text-xs leading-6 text-[#625e55]">{metric.label}</p>
                </div>
              ))}
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-8 md:p-12">
            <div className="grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-center">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Landfill reduction</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] md:text-7xl">
                  Reuse is a climate pathway.
                </h2>
                <p className="mt-6 text-lg leading-8 text-[#efe5d8]/78">
                  The most sustainable garment is often the one already in circulation. Sorty helps protect that value
                  by moving garments toward useful next lives.
                </p>
              </div>
              <div className="rounded-[2.5rem] border border-white/10 bg-white/5 p-6">
                <div className="h-4 overflow-hidden rounded-full bg-white/10">
                  <div className="h-full w-[74%] rounded-full bg-[#8da18f]" />
                </div>
                <div className="mt-6 grid gap-4">
                  {["Resale", "Repair", "Donation", "Reuse", "Recycling only when needed"].map((item) => (
                    <div key={item} className="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3 text-sm text-[#fffaf1]">
                      <span>{item}</span>
                      <span className="text-[#d9c6b2]">pathway</span>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
          <FadeIn>
            <GarmentLifecycle />
          </FadeIn>
          <FadeIn delay={0.1}>
            <SectionHeader
              eyebrow="Circular economy metrics"
              title="Impact gets stronger when circularity becomes visible."
              copy="Dreamstill is building toward dashboards that help partners understand where garments go, what pathways are working, and where the ecosystem needs more capacity."
            />
            <div className="mt-8 grid gap-3">
              {dashboard.map((item) => (
                <div key={item} className="rounded-full border border-[#20201d]/8 bg-white/55 px-5 py-4 text-sm font-medium text-[#34322d]">
                  {item}
                </div>
              ))}
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="premium-card rounded-[3rem] p-8 text-center md:p-12">
            <SectionHeader
              eyebrow="Ecosystem growth"
              title="A more circular city starts with a clearer clothing decision."
              copy="When people know where clothing should go, partners receive better-matched items, repair shops become easier to find, and municipalities can build smarter textile diversion systems."
              align="center"
            />
            <div className="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
              <ButtonLink href="/businesses">Partner with Dreamstill</ButtonLink>
              <ButtonLink href="/community" variant="light">See community work</ButtonLink>
            </div>
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
