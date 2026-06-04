import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "Corporate Experiences",
  description:
    "Premium Dreamstill sustainability and creativity experiences for team building, conferences, retreats, and company celebrations across British Columbia.",
};

const experiences = [
  {
    title: "Team Building",
    copy: "Hands-on creative experiences using repurposed textile materials.",
    detail: "Guided making sessions that help teams slow down, collaborate, and leave with something meaningful.",
  },
  {
    title: "Wellness & Climate Resilience",
    copy: "Mindfulness and meaningful conversations for modern workplaces.",
    detail: "A grounded format for teams navigating climate anxiety, creativity, care, and purposeful action.",
  },
  {
    title: "Conference Activations",
    copy: "Interactive installations and drop-in experiences for up to 100 participants.",
    detail: "High-touch, visually engaging activations that bring sustainability to life without feeling like a lecture.",
  },
];

const gallery = [
  {
    title: "Textile storytelling circle",
    meta: "Retreat experience",
    className: "md:row-span-2 min-h-[420px] from-[#2b2a26] via-[#7a6658] to-[#d6a78d]",
  },
  {
    title: "Repurposed materials studio",
    meta: "Team creative lab",
    className: "min-h-[260px] from-[#8da18f] via-[#c6b8a1] to-[#f0d8c7]",
  },
  {
    title: "Drop-in circular fashion activation",
    meta: "Conference floor",
    className: "min-h-[300px] from-[#20201d] via-[#56685b] to-[#b9866d]",
  },
  {
    title: "Mindful mending conversation",
    meta: "Wellness session",
    className: "min-h-[300px] from-[#eadfce] via-[#d3a58d] to-[#6b725f]",
  },
  {
    title: "Community swap moment",
    meta: "Public event",
    className: "md:col-span-2 min-h-[340px] from-[#433f37] via-[#8a6d58] to-[#efd2c2]",
  },
];

const testimonials = [
  {
    quote:
      "Dreamstill created the rare kind of team experience that felt thoughtful, beautiful, and genuinely connective.",
    name: "People & Culture Lead",
    context: "BC workplace retreat",
  },
  {
    quote:
      "Our attendees stayed longer than expected because the activation felt calm, tactile, and different from everything else in the room.",
    name: "Conference Producer",
    context: "Sustainability event",
  },
  {
    quote:
      "The session made climate action feel personal without making our team feel overwhelmed. It was creative, warm, and memorable.",
    name: "Operations Director",
    context: "Corporate team building",
  },
];

const partnerLogos = ["Community Hosts", "Repair Partners", "Campus Groups", "Circular Fashion Allies"];

const pricing = [
  {
    title: "Small Teams",
    range: "10-20",
    price: "Starting at $2,500",
    copy: "Intimate, facilitated experiences for teams, offsites, and leadership groups.",
  },
  {
    title: "Growing Teams",
    range: "20-50",
    price: "Starting at $4,000",
    copy: "Expanded creative formats for departments, retreats, and company celebrations.",
  },
  {
    title: "Large Activations",
    range: "50-100",
    price: "Custom Quote",
    copy: "Drop-in installations, conference experiences, and high-capacity activations.",
  },
];

const faqs = [
  {
    question: "What kinds of companies do you work with?",
    answer: "Any. We design experiences for startups, enterprise teams, public institutions, nonprofits, conferences, and creative communities.",
  },
  {
    question: "How many participants can you accommodate?",
    answer: "Up to 100 participants, depending on the format, venue, materials, and facilitation needs.",
  },
  {
    question: "Can you travel?",
    answer: "Yes. Dreamstill designs experiences across British Columbia and can discuss travel needs during discovery.",
  },
  {
    question: "Can experiences be customized?",
    answer: "Yes. Every Dreamstill experience is customized around your team, goals, audience, venue, and desired tone.",
  },
  {
    question: "Do participants need prior experience?",
    answer:
      "No. The experiences are beginner-friendly, but we can customize the format for higher-skilled participants if you wish.",
  },
];

export default function PortfolioPage() {
  return (
    <div className="overflow-hidden pt-28">
      <section className="container-shell py-10 md:py-16">
        <div className="grid gap-8 lg:grid-cols-[0.94fr_1.06fr] lg:items-stretch">
          <FadeIn>
            <div className="flex h-full flex-col justify-center py-8 lg:py-14">
              <p className="text-xs font-semibold uppercase tracking-[0.34em] text-[#8a6d58]">
                Dreamstill experiences
              </p>
              <h1 className="font-serif mt-5 max-w-4xl text-6xl leading-[0.92] tracking-[-0.065em] text-[#20201d] md:text-8xl">
                Corporate Experiences That Inspire Creativity and Connection.
              </h1>
              <p className="mt-7 max-w-2xl text-lg leading-8 text-[#5f5b52] md:text-xl">
                Dreamstill designs unforgettable sustainability and creativity experiences for teams, conferences,
                retreats, and company celebrations across British Columbia.
              </p>
              <div className="mt-9 flex flex-col gap-3 sm:flex-row">
                <ButtonLink href="#calendly">Book a Discovery Call</ButtonLink>
                <ButtonLink href="#past-experiences" variant="light">
                  View Past Events
                </ButtonLink>
              </div>
            </div>
          </FadeIn>

          <FadeIn delay={0.12}>
            <div className="premium-card noise-border relative min-h-[560px] overflow-hidden rounded-[3rem] p-5">
              <div className="absolute inset-0 bg-gradient-to-br from-[#20201d] via-[#6b725f] to-[#d3a58d]" />
              <div className="absolute inset-0 opacity-65 mix-blend-soft-light soft-grid" />
              <div className="absolute left-10 top-10 h-28 w-28 rounded-full border border-white/35 bg-white/10 backdrop-blur-md" />
              <div className="absolute right-12 top-20 h-44 w-32 rotate-6 rounded-[2.2rem] bg-[#fffaf1]/20 shadow-2xl backdrop-blur" />
              <div className="absolute bottom-10 left-8 right-8 rounded-[2.25rem] border border-white/20 bg-[#fffaf1]/18 p-5 text-[#fffaf1] backdrop-blur-xl">
                <div className="flex items-center justify-between gap-4">
                  <div>
                    <p className="text-xs uppercase tracking-[0.28em] text-[#fffaf1]/72">Signature format</p>
                    <p className="font-serif mt-3 text-3xl leading-none tracking-[-0.04em] md:text-4xl">
                      tactile creativity + climate meaning
                    </p>
                  </div>
                  <span className="hidden rounded-full bg-white/18 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] sm:inline-flex">
                    BC teams
                  </span>
                </div>
              </div>
              <div className="absolute left-16 top-1/2 h-52 w-40 -translate-y-1/2 -rotate-12 rounded-t-full rounded-b-[3rem] bg-[#2a2925]/72 shadow-2xl" />
              <div className="absolute right-24 top-1/2 h-60 w-48 -translate-y-1/2 rotate-6 rounded-[3rem] bg-[#f5ddc9]/42 shadow-2xl backdrop-blur-sm" />
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-14 md:py-20">
        <div className="grid gap-5 md:grid-cols-3">
          {experiences.map((experience, index) => (
            <FadeIn key={experience.title} delay={index * 0.06}>
              <article className="premium-card group h-full rounded-[2.5rem] p-6 transition duration-300 hover:-translate-y-1 hover:bg-white/70 md:p-8">
                <div className="mb-8 h-40 rounded-[2rem] bg-gradient-to-br from-[#20201d] via-[#8da18f] to-[#efd2c2] p-4 transition duration-300 group-hover:scale-[1.02]">
                  <div className="h-full rounded-[1.5rem] border border-white/25 bg-white/10 backdrop-blur-sm" />
                </div>
                <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6d58]">0{index + 1}</p>
                <h2 className="font-serif mt-4 text-4xl leading-[1.02] tracking-[-0.045em] text-[#20201d]">
                  {experience.title}
                </h2>
                <p className="mt-4 text-base leading-7 text-[#4f4b44]">{experience.copy}</p>
                <p className="mt-5 text-sm leading-7 text-[#6a655d]">{experience.detail}</p>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section id="past-experiences" className="container-shell scroll-mt-28 py-14 md:py-20">
        <FadeIn>
          <SectionHeader
            eyebrow="Past Experiences"
            title="Moments designed to be felt, photographed, and remembered."
            copy="A gallery-style look at Dreamstill's tactile events, creative climate conversations, community activations, and team experiences."
          />
        </FadeIn>
        <div className="mt-10 grid auto-rows-[120px] gap-5 md:grid-cols-3">
          {gallery.map((item, index) => (
            <FadeIn key={item.title} delay={index * 0.04} className={item.className.includes("row-span") ? "md:row-span-2" : item.className.includes("col-span") ? "md:col-span-2" : undefined}>
              <article
                className={`group relative h-full overflow-hidden rounded-[2.5rem] bg-gradient-to-br ${item.className.replace("md:row-span-2", "").replace("md:col-span-2", "")} shadow-2xl shadow-[#20201d]/10`}
              >
                <div className="absolute inset-0 soft-grid opacity-30 mix-blend-soft-light" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#20201d]/72 via-transparent to-white/10 opacity-90" />
                <div className="absolute inset-x-5 bottom-5 translate-y-2 rounded-[1.75rem] border border-white/15 bg-white/14 p-5 text-[#fffaf1] backdrop-blur-md transition duration-300 group-hover:translate-y-0 group-hover:bg-white/20">
                  <p className="text-xs uppercase tracking-[0.28em] text-[#fffaf1]/70">{item.meta}</p>
                  <h3 className="font-serif mt-2 text-3xl leading-[1.04] tracking-[-0.04em]">{item.title}</h3>
                </div>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell py-14 md:py-20">
        <div className="grid gap-8 lg:grid-cols-[0.84fr_1.16fr] lg:items-start">
          <FadeIn>
            <SectionHeader
              eyebrow="Social proof"
              title="Premium experiences that make sustainability feel creative and human."
              copy="Designed for attendees who want meaningful community moments and corporate clients who need polished, memorable programming."
            />
            <div className="mt-8 flex flex-wrap gap-3">
              {partnerLogos.map((logo) => (
                <span
                  key={logo}
                  className="rounded-full border border-[#20201d]/10 bg-white/55 px-5 py-3 text-xs font-semibold uppercase tracking-[0.24em] text-[#625e55]"
                >
                  {logo}
                </span>
              ))}
            </div>
          </FadeIn>
          <div className="grid gap-5">
            {testimonials.map((testimonial, index) => (
              <FadeIn key={testimonial.quote} delay={index * 0.05}>
                <blockquote className="premium-card rounded-[2.25rem] p-6 md:p-8">
                  <p className="font-serif text-3xl leading-[1.12] tracking-[-0.035em] text-[#20201d]">
                    <span aria-hidden="true">&quot;</span>
                    {testimonial.quote}
                    <span aria-hidden="true">&quot;</span>
                  </p>
                  <footer className="mt-6 border-t border-[#20201d]/10 pt-4">
                    <p className="text-sm font-semibold text-[#20201d]">{testimonial.name}</p>
                    <p className="mt-1 text-xs uppercase tracking-[0.24em] text-[#8a6d58]">{testimonial.context}</p>
                  </footer>
                </blockquote>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>

      <section className="container-shell py-14 md:py-20">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-7 md:p-12">
            <div className="grid gap-8 lg:grid-cols-[0.82fr_1.18fr] lg:items-end">
              <div>
                <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Pricing guidance</p>
                <h2 className="font-serif mt-5 text-5xl leading-[1] tracking-[-0.055em] text-[#fffaf1] md:text-7xl">
                  Bespoke experiences with clear starting points.
                </h2>
              </div>
              <p className="text-lg leading-8 text-[#efe5d8]/78">
                Every Dreamstill experience is customized to your team and goals.
              </p>
            </div>
            <div className="mt-10 grid gap-5 md:grid-cols-3">
              {pricing.map((tier) => (
                <article key={tier.title} className="rounded-[2.25rem] border border-white/10 bg-white/6 p-6">
                  <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">{tier.range} participants</p>
                  <h3 className="font-serif mt-4 text-4xl leading-none tracking-[-0.04em] text-[#fffaf1]">
                    {tier.title}
                  </h3>
                  <p className="mt-5 text-2xl font-semibold text-[#efd2c2]">{tier.price}</p>
                  <p className="mt-4 text-sm leading-7 text-[#efe5d8]/72">{tier.copy}</p>
                </article>
              ))}
            </div>
          </div>
        </FadeIn>
      </section>

      <section id="calendly" className="container-shell scroll-mt-28 py-14 md:py-20">
        <div className="grid gap-8 lg:grid-cols-[0.84fr_1.16fr] lg:items-start">
          <FadeIn>
            <SectionHeader
              eyebrow="Book a discovery call"
              title="Let's Create Something Memorable."
              copy="We'll discuss your event, team size, goals, and build an experience your people will actually remember."
            />
          </FadeIn>
          <FadeIn delay={0.1}>
            <div className="premium-card overflow-hidden rounded-[2.5rem] p-3">
              <iframe
                title="Book a Dreamstill discovery call"
                src="https://calendly.com/dreamstill/discovery-call?hide_event_type_details=1&hide_gdpr_banner=1"
                className="h-[720px] w-full rounded-[2rem] bg-white"
              />
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-14 md:py-20">
        <div className="grid gap-8 lg:grid-cols-[0.72fr_1.28fr]">
          <FadeIn>
            <SectionHeader
              eyebrow="FAQ"
              title="A few details before we design your experience."
            />
          </FadeIn>
          <div className="grid gap-4">
            {faqs.map((faq, index) => (
              <FadeIn key={faq.question} delay={index * 0.04}>
                <details className="premium-card group rounded-[2rem] p-6">
                  <summary className="cursor-pointer list-none text-lg font-semibold text-[#20201d]">
                    <span className="flex items-center justify-between gap-4">
                      {faq.question}
                      <span className="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#20201d] text-sm text-[#fffaf1] transition group-open:rotate-45">
                        +
                      </span>
                    </span>
                  </summary>
                  <p className="mt-4 max-w-3xl text-sm leading-7 text-[#625e55]">{faq.answer}</p>
                </details>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
