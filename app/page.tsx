import { AnimatedCounter } from "@/components/AnimatedCounter";
import { AppMockup } from "@/components/AppMockup";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { GarmentLifecycle } from "@/components/GarmentLifecycle";
import { SectionHeader } from "@/components/SectionHeader";
import { WorkflowVisual } from "@/components/WorkflowVisual";

const audiences = [
  {
    label: "General public",
    title: "Know what to do with clothing in seconds.",
    copy: "Snap a photo, get instant guidance, and find nearby resale, repair, donation, reuse, or recycling options without guilt or guesswork.",
    href: "/sorty",
  },
  {
    label: "Thrift stores and charities",
    title: "Improve donation quality before it reaches your door.",
    copy: "Sorty helps reduce contamination, sorting labour, and low-value intake while sending more qualified donors to your location.",
    href: "/businesses#thrift",
  },
  {
    label: "Consignment stores",
    title: "Pre-screen inventory before appointments.",
    copy: "AI-powered intake guidance helps teams save staff hours, reduce unsuitable garments, and focus on higher-value pieces.",
    href: "/businesses#consignment",
  },
  {
    label: "Municipalities and partners",
    title: "Build textile circularity infrastructure.",
    copy: "Support intelligent textile diversion, local circular maps, behavioural insight, and reuse-first climate programming.",
    href: "/businesses#municipalities",
  },
];

const stats = [
  { value: 92, suffix: "M", label: "tonnes of textile waste generated globally each year" },
  { value: 5, suffix: " sec", label: "to understand what Sorty does: scan, assess, route" },
  { value: 4, suffix: "x", label: "priority pathways before recycling: resale, repair, donation, reuse" },
  { value: 8, suffix: "+", label: "audiences served across public, retail, civic, and partner ecosystems" },
];

const proof = [
  "BIPOC female-led climate technology from Vancouver",
  "Built for circular fashion systems, not generic recycling",
  "Designed for stores, cities, partners, and everyday clothing decisions",
];

export default function Home() {
  return (
    <div className="overflow-hidden pt-28">
      <section className="container-shell relative min-h-[calc(100vh-7rem)] py-12 md:py-20">
        <div className="absolute -right-24 top-16 h-72 w-72 rounded-full bg-[#8da18f]/30 blur-3xl" />
        <div className="absolute -left-20 bottom-8 h-80 w-80 rounded-full bg-[#efd2c2]/50 blur-3xl" />
        <div className="grid items-center gap-12 lg:grid-cols-[1.05fr_0.95fr]">
          <FadeIn>
            <div className="inline-flex rounded-full border border-[#20201d]/10 bg-white/55 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#6a655d] shadow-sm backdrop-blur">
              Circular intelligence for fashion
            </div>
            <h1 className="font-serif mt-7 max-w-5xl text-6xl leading-[0.92] tracking-[-0.065em] text-[#20201d] md:text-8xl lg:text-9xl">
              Give your clothing a better next life.
            </h1>
            <p className="mt-7 max-w-2xl text-lg leading-8 text-[#555149] md:text-xl">
              Dreamstill builds AI-powered textile circularity infrastructure. Sorty identifies garments,
              assesses condition, and guides people toward reuse, repair, donation, resale, or recycling in seconds.
            </p>
            <div className="mt-9 flex flex-col gap-3 sm:flex-row">
              <ButtonLink href="/sorty" variant="dark">Download Sorty</ButtonLink>
              <ButtonLink href="/contact" variant="light">Partner With Us</ButtonLink>
            </div>
            <div className="mt-10 grid gap-3 sm:grid-cols-3">
              {proof.map((item) => (
                <div key={item} className="rounded-3xl border border-[#20201d]/8 bg-white/40 p-4 text-sm leading-6 text-[#5c574e] backdrop-blur">
                  {item}
                </div>
              ))}
            </div>
          </FadeIn>

          <FadeIn delay={0.15} className="relative">
            <div className="textile-motion absolute inset-8 rounded-[4rem] bg-gradient-to-br from-[#8da18f]/20 via-[#efd2c2]/24 to-[#b9866d]/20 blur-2xl" />
            <AppMockup />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="dark-card rounded-[2.75rem] p-7 md:p-10">
            <div className="grid gap-8 lg:grid-cols-[0.82fr_1.18fr] lg:items-end">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">What Sorty does</p>
                <h2 className="font-serif mt-4 text-4xl leading-[1.02] tracking-[-0.045em] md:text-6xl">
                  Circular decision-making, not another recycling app.
                </h2>
              </div>
              <p className="text-lg leading-8 text-[#efe5d8]/78">
                Sorty turns a confusing clothing decision into a clear next step. It combines garment identification,
                condition analysis, pathway intelligence, and local partner routing so clothing stays useful for longer.
              </p>
            </div>
            <div className="mt-10">
              <WorkflowVisual />
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <SectionHeader
            eyebrow="Built for every point in the system"
            title="One platform, multiple circular economy pain points."
            copy="Dreamstill speaks to people making closet decisions and organizations trying to make textile circularity operational, measurable, and scalable."
          />
        </FadeIn>
        <div className="mt-10 grid gap-5 md:grid-cols-2">
          {audiences.map((audience, index) => (
            <FadeIn key={audience.label} delay={index * 0.06}>
              <a
                href={audience.href}
                className="premium-card group block h-full rounded-[2.25rem] p-6 transition duration-300 hover:-translate-y-1 hover:bg-white/70"
              >
                <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6d58]">{audience.label}</p>
                <h3 className="font-serif mt-5 text-3xl leading-[1.05] tracking-[-0.035em] text-[#20201d] md:text-4xl">
                  {audience.title}
                </h3>
                <p className="mt-5 text-sm leading-7 text-[#625e55]">{audience.copy}</p>
                <span className="mt-7 inline-flex text-sm font-semibold text-[#56685b] transition group-hover:translate-x-1">
                  Explore pathway
                </span>
              </a>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell py-16">
        <div className="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
          <FadeIn>
            <SectionHeader
              eyebrow="Impact intelligence"
              title="From concern to action, with measurable diversion."
              copy="Textile waste is emotional, operational, and infrastructural. Dreamstill brings clarity to each layer by routing garments toward their highest-value next use."
            />
            <div className="mt-8 grid grid-cols-2 gap-4">
              {stats.map((stat) => (
                <div key={stat.label} className="premium-card rounded-[2rem] p-5">
                  <p className="font-serif text-4xl tracking-[-0.04em] text-[#20201d] md:text-5xl">
                    <AnimatedCounter value={stat.value} suffix={stat.suffix} />
                  </p>
                  <p className="mt-3 text-xs leading-5 text-[#625e55]">{stat.label}</p>
                </div>
              ))}
            </div>
          </FadeIn>
          <FadeIn delay={0.1}>
            <GarmentLifecycle />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <div className="rounded-[2.75rem] border border-[#20201d]/10 bg-[#fffaf1]/62 p-8 shadow-2xl shadow-[#20201d]/8 backdrop-blur md:p-12">
            <div className="grid gap-10 lg:grid-cols-[1fr_0.9fr] lg:items-center">
              <div>
                <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Category creation</p>
                <h2 className="font-serif mt-5 max-w-3xl text-5xl leading-[0.98] tracking-[-0.055em] text-[#20201d] md:text-7xl">
                  The infrastructure layer for circular textile economies.
                </h2>
                <p className="mt-6 max-w-2xl text-lg leading-8 text-[#5f5b52]">
                  Dreamstill is not a sustainability organization, thrift initiative, or recycling project. We are building
                  circular decision-making infrastructure for the future of clothing reuse.
                </p>
              </div>
              <div className="grid gap-3">
                {[
                  "AI-powered textile circularity",
                  "Intelligent textile diversion",
                  "Climate-conscious fashion systems",
                  "Helping clothing find its next life",
                ].map((item) => (
                  <div key={item} className="rounded-full border border-[#20201d]/8 bg-white/60 px-5 py-4 text-sm font-semibold text-[#34322d]">
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
          <div className="dark-card relative overflow-hidden rounded-[3rem] p-8 md:p-14">
            <div className="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[#8da18f]/20 blur-3xl" />
            <div className="relative grid gap-10 lg:grid-cols-[1fr_0.72fr] lg:items-center">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Join the circular future</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] md:text-7xl">
                  Build the next life of clothing with us.
                </h2>
                <p className="mt-6 max-w-2xl text-lg leading-8 text-[#efe5d8]/78">
                  Whether you are a municipality, repair shop, consignment store, thrift organization, investor, or community partner,
                  Dreamstill can help turn textile waste into useful, local, data-informed pathways.
                </p>
              </div>
              <div className="flex flex-col gap-3 sm:flex-row lg:flex-col">
                <ButtonLink href="/contact" variant="sage">Start a partnership</ButtonLink>
                <ButtonLink href="/about" variant="light">Read the founder story</ButtonLink>
              </div>
            </div>
          </div>
        </FadeIn>
      </section>
    </div>
  );
}
