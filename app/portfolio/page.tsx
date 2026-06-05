import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { ContactForm } from "@/components/ContactForm";
import { EventImage } from "@/components/EventImage";
import { FadeIn } from "@/components/FadeIn";
import { PartnerStrip } from "@/components/PartnerStrip";
import { SectionHeader } from "@/components/SectionHeader";
import { galleryImages, site } from "@/lib/site";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "Experiences",
  description:
    "Book Dreamstill sustainability and creativity experiences for team building, conferences, retreats, and celebrations across British Columbia.",
  path: "/portfolio",
});

const experiences = [
  {
    title: "Team building",
    copy: "Hands-on creative sessions using repurposed textile materials.",
    outcome: "Teams leave with a handmade item, shared story, and a circular fashion action plan.",
  },
  {
    title: "Wellness & climate resilience",
    copy: "Mindfulness and meaningful conversations for modern workplaces.",
    outcome: "Participants gain language for climate anxiety, creativity, and purposeful action.",
  },
  {
    title: "Conference activations",
    copy: "Interactive installations for up to 100 participants.",
    outcome: "High-touch programming that makes sustainability feel tactile — not like a lecture.",
  },
];

const testimonials = [
  {
    quote:
      "Dreamstill created the rare kind of team experience that felt thoughtful, beautiful, and genuinely connective.",
    name: "People & Culture Lead",
    organization: "BC technology company retreat",
  },
  {
    quote:
      "Our attendees stayed longer than expected because the activation felt calm, tactile, and different from everything else in the room.",
    name: "Conference producer",
    organization: "Regional sustainability summit",
  },
  {
    quote:
      "The session made climate action feel personal without overwhelming our team. Creative, warm, and memorable.",
    name: "Operations director",
    organization: "Professional services firm",
  },
];

const pricing = [
  {
    title: "Small teams",
    range: "10–20 participants",
    price: "From $2,500 CAD",
    includes: ["90-minute facilitated experience", "Repurposed materials kit", "On-site setup support"],
    copy: "Intimate offsites, leadership teams, and small departments.",
  },
  {
    title: "Growing teams",
    range: "20–50 participants",
    price: "From $4,000 CAD",
    includes: ["Expanded creative format", "Additional facilitators as needed", "Customized climate narrative"],
    copy: "Department celebrations, retreats, and culture weeks.",
  },
  {
    title: "Large activations",
    range: "50–100 participants",
    price: "Custom quote (CAD)",
    includes: ["Drop-in or structured flow", "Installation design", "Run-of-show coordination"],
    copy: "Conferences, public activations, and high-capacity events.",
  },
];

const faqs = [
  {
    question: "Who is the ideal client?",
    answer:
      "Teams of 10–100 people at companies, public institutions, conferences, and nonprofits that want creative sustainability programming — especially HR, culture, ESG, and events leaders planning retreats or activations in BC.",
  },
  {
    question: "What kinds of companies do you work with?",
    answer: "Any organization that values thoughtful design and meaningful team connection — startups to enterprise, public sector, and nonprofits.",
  },
  {
    question: "Can experiences be customized?",
    answer: "Yes. Every experience is customized around your goals, venue, audience skill level, and tone.",
  },
  {
    question: "Can you travel?",
    answer: "Yes. Dreamstill designs experiences across British Columbia and can discuss travel needs during discovery.",
  },
];

export default function PortfolioPage() {
  return (
    <div className="overflow-hidden pt-28">
      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-[0.94fr_1.06fr] lg:items-stretch">
          <FadeIn>
            <div className="flex h-full flex-col justify-center">
              <p className="text-xs font-semibold uppercase tracking-[0.34em] text-[#8a6d58]">Dreamstill experiences</p>
              <h1 className="page-title mt-5 max-w-4xl">Experiences that inspire creativity and connection.</h1>
              <p className="mt-6 max-w-2xl text-lg leading-8 text-[#5f5b52]">
                Premium sustainability and creativity programming for teams, conferences, retreats, and celebrations
                across British Columbia.
              </p>
              <div className="mt-8 flex flex-col gap-3 sm:flex-row">
                <ButtonLink href="#calendly">Book a discovery call</ButtonLink>
                <ButtonLink href="#past-experiences" variant="light">
                  View past events
                </ButtonLink>
              </div>
            </div>
          </FadeIn>
          <FadeIn delay={0.1}>
            <div className="relative min-h-[480px] overflow-hidden rounded-[3rem]">
              <EventImage
                src="/images/events/fashion-runway.jpg"
                fallback="/images/events/fashion-runway.svg"
                alt="Dreamstill fashion activation"
                priority
              />
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Why Dreamstill"
            title="Not a generic sustainability workshop."
            copy="Dreamstill experiences are tactile, creative, and community-rooted — designed for teams who want climate programming that feels human, memorable, and shareable."
          />
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-5 md:grid-cols-3">
          {experiences.map((experience, index) => (
            <FadeIn key={experience.title} delay={index * 0.05}>
              <article className="premium-card h-full rounded-[2.5rem] p-6 md:p-8">
                <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6d58]">0{index + 1}</p>
                <h2 className="page-subtitle mt-4 text-3xl">{experience.title}</h2>
                <p className="mt-4 text-sm leading-7 text-[#4f4b44]">{experience.copy}</p>
                <p className="mt-4 text-sm font-medium leading-7 text-[#56685b]">{experience.outcome}</p>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section id="past-experiences" className="container-shell scroll-mt-28 section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Past experiences"
            title="Moments designed to be felt, photographed, and remembered."
            copy="Swap the placeholder files in /public/images/events/ with your approved event photography for the highest-impact gallery."
          />
        </FadeIn>
        <div className="mt-8 grid auto-rows-[120px] gap-5 md:grid-cols-3">
          {galleryImages.map((item, index) => (
            <FadeIn
              key={item.title}
              delay={index * 0.04}
              className={
                item.className.includes("row-span")
                  ? "md:row-span-2"
                  : item.className.includes("col-span")
                    ? "md:col-span-2"
                    : undefined
              }
            >
              <article className={`group relative h-full overflow-hidden rounded-[2.5rem] ${item.className}`}>
                <EventImage src={item.src} fallback={item.fallback} alt={item.title} />
                <div className="absolute inset-0 bg-gradient-to-t from-[#20201d]/72 via-transparent to-transparent" />
                <div className="absolute inset-x-5 bottom-5 rounded-[1.75rem] border border-white/15 bg-white/14 p-5 text-[#fffaf1] backdrop-blur-md">
                  <p className="text-xs uppercase tracking-[0.28em] text-[#fffaf1]/70">{item.meta}</p>
                  <h3 className="page-subtitle mt-2 text-2xl text-[#fffaf1]">{item.title}</h3>
                </div>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-[0.84fr_1.16fr]">
          <FadeIn>
            <SectionHeader
              eyebrow="Social proof"
              title="Trusted for thoughtful, creative sustainability programming."
              copy="Designed for attendees who want meaningful community moments and buyers who need polished, memorable programming."
            />
            <div className="mt-8">
              <PartnerStrip title="Organizations we've built with" />
            </div>
          </FadeIn>
          <div className="grid gap-5">
            {testimonials.map((testimonial, index) => (
              <FadeIn key={testimonial.quote} delay={index * 0.05}>
                <blockquote className="premium-card rounded-[2.25rem] p-6 md:p-8">
                  <p className="page-subtitle text-2xl leading-[1.12] md:text-3xl">&ldquo;{testimonial.quote}&rdquo;</p>
                  <footer className="mt-6 border-t border-[#20201d]/10 pt-4">
                    <p className="text-sm font-semibold text-[#20201d]">{testimonial.name}</p>
                    <p className="mt-1 text-xs uppercase tracking-[0.22em] text-[#8a6d58]">{testimonial.organization}</p>
                  </footer>
                </blockquote>
              </FadeIn>
            ))}
          </div>
        </div>
      </section>

      <section id="calendly" className="container-shell scroll-mt-28 section-space">
        <div className="grid gap-8 lg:grid-cols-[0.84fr_1.16fr]">
          <FadeIn>
            <SectionHeader
              eyebrow="Book a discovery call"
              title="Let's create something memorable."
              copy="We'll discuss your event, team size, goals, and build an experience your people will remember."
            />
          </FadeIn>
          <FadeIn delay={0.08}>
            <div className="premium-card overflow-hidden rounded-[2.5rem] p-3">
              <iframe
                title="Book a Dreamstill discovery call"
                src={site.calendlyDiscovery}
                className="h-[720px] w-full rounded-[2rem] bg-white"
              />
            </div>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <div className="dark-card rounded-[3rem] p-7 md:p-12">
            <SectionHeader
              eyebrow="Pricing guidance"
              title="Bespoke experiences with clear starting points."
              copy="Every experience is customized. Pricing below is in CAD so buyers can self-qualify before booking."
            />
            <div className="mt-8 grid gap-5 md:grid-cols-3">
              {pricing.map((tier) => (
                <article key={tier.title} className="rounded-[2.25rem] border border-white/10 bg-white/6 p-6">
                  <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">{tier.range}</p>
                  <h3 className="page-subtitle mt-4 text-3xl text-[#fffaf1]">{tier.title}</h3>
                  <p className="mt-4 text-2xl font-semibold text-[#efd2c2]">{tier.price}</p>
                  <p className="mt-3 text-sm leading-7 text-[#efe5d8]/72">{tier.copy}</p>
                  <ul className="mt-5 grid gap-2 text-sm text-[#efe5d8]/78">
                    {tier.includes.map((item) => (
                      <li key={item}>• {item}</li>
                    ))}
                  </ul>
                </article>
              ))}
            </div>
            <div className="mt-10 rounded-[2rem] border border-white/10 bg-white/5 p-6">
              <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">What&apos;s included</p>
              <p className="mt-3 text-sm leading-7 text-[#efe5d8]/78">
                Facilitation, curated materials, setup and pack-down support, experience design, and follow-up notes with
                optional photography guidance. Travel and venue fees may apply for locations outside core Metro Vancouver.
              </p>
            </div>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-[0.72fr_1.28fr]">
          <FadeIn>
            <SectionHeader eyebrow="Corporate inquiry" title="Request a tailored experience proposal." />
            <p className="mt-4 text-sm leading-7 text-[#625e55]">{site.responseTime}</p>
          </FadeIn>
          <FadeIn delay={0.06}>
            <ContactForm defaultInterest="Corporate experience booking" submitLabel="Request experience proposal" />
          </FadeIn>
        </div>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-4">
          {faqs.map((faq, index) => (
            <FadeIn key={faq.question} delay={index * 0.04}>
              <details className="premium-card rounded-[2rem] p-6">
                <summary className="cursor-pointer list-none text-lg font-semibold text-[#20201d]">{faq.question}</summary>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{faq.answer}</p>
              </details>
            </FadeIn>
          ))}
        </div>
      </section>
    </div>
  );
}
