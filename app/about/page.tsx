import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "About Dreamstill",
  description:
    "Meet the Dreamstill founders, origin story, and timeline building circular textile technology and community programming in Vancouver.",
  path: "/about",
});

const values = [
  {
    title: "Innovation",
    copy: "Building clean technology that turns textile decisions into clear, fast, actionable next steps.",
  },
  {
    title: "Authenticity",
    copy: "Showing up with honesty, imagination, and lived connection to fashion, culture, and climate work.",
  },
  {
    title: "Environmental stewardship",
    copy: "Prioritizing reuse, repair, resale, and recycling so garments stay in use longer and out of landfill.",
  },
  {
    title: "Collaboration",
    copy: "Working across communities, municipalities, research networks, and industry to build circular systems.",
  },
];

const timeline = [
  {
    season: "Spring 2024",
    title: "Finding the problem in closets and donation piles",
    copy: "We gathered community stories, mapped textile waste pain points, and learned how much value hides in unwanted clothing.",
    outcome: "Outcome: validated that confusion — not apathy — drives most disposal decisions.",
  },
  {
    season: "Summer 2024",
    title: "Clothing swaps, styling, and resale experiments",
    copy: "Dreamstill's first solutions came through hands-on circular fashion experiences across Vancouver.",
    outcome: "Outcome: proved that joyful, tactile programming increases reuse behaviour.",
  },
  {
    season: "Fall 2024",
    title: "Buildspace venture development",
    copy: "We refined the venture narrative, tested assumptions, and shaped a stronger product direction.",
    outcome: "Outcome: clarified Sorty as climate infrastructure, not just an events brand.",
  },
  {
    season: "Spring 2025",
    title: "Capstone app development with UBC",
    copy: "Sorty advanced into a working prototype with computer vision, condition questions, and pathway recommendations.",
    outcome: "Outcome: demonstrated scan-to-route flows with local map integration.",
  },
  {
    season: "Summer 2025",
    title: "Community activations scaled",
    copy: "Swaps, repair workshops, panels, and education expanded Dreamstill's public footprint.",
    outcome: "Outcome: built recurring community demand and partner introductions.",
  },
  {
    season: "Fall 2025",
    title: "Industry and research partnerships",
    copy: "Collaborations deepened with circular fashion hosts, Kelowna Fashion Weekend, and UBC Slow Fibre Research Cluster.",
    outcome: "Outcome: connected product development to real-world circular ecosystems.",
  },
  {
    season: "Spring 2026",
    title: "Sorty launch preparation",
    copy: "Sorty moves toward public release as a practical decision-support tool for residents, municipalities, and partners.",
    outcome: "Outcome: opening pilot conversations with cities and institutions.",
  },
];

const founders = [
  {
    name: "Khushi",
    image: "/images/founders/khushi.svg",
    linkedin: "https://ca.linkedin.com/company/dreamstilll",
    paragraphs: [
      "Khushi is the innovative co-founder of Dreamstill Technologies with a background in startup development and strategic planning. She has co-led social justice and creative expression initiatives by fostering team collaboration, securing funding, and executing growth strategies.",
      "She is known for accelerating non-profit growth and boosting workplace productivity through EDI-forward operations, project management systems, and community engagement that elevates organizational visibility.",
    ],
  },
  {
    name: "Mars",
    image: "/images/founders/mars.svg",
    linkedin: "https://ca.linkedin.com/company/dreamstilll",
    paragraphs: [
      "Mars is a Brazilian environmental professional, actor, poet, and co-founder working across climate technology and Indigenous governance. As co-founder of Dreamstill, Mars leads the development of AI-driven solutions addressing textile waste and circular fashion systems.",
      "Alongside Dreamstill, Mars serves as a Regulatory Engagement Coordinator with the Gitga'at First Nation, supporting environmental decision-making between industry, government, and community.",
    ],
  },
];

const advisors = [
  "UBC Slow Fibre Research Cluster collaborators",
  "Circular fashion community hosts across Metro Vancouver",
  "Repair, resale, and donation partners informing Sorty routing logic",
];

export default function AboutPage() {
  return (
    <div className="pt-28">
      <section className="container-shell section-space">
        <FadeIn>
          <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">About us</p>
          <h1 className="page-title mt-5 max-w-4xl">Change happens when people are empowered, inspired, and connected.</h1>
          <p className="mt-6 max-w-3xl text-lg leading-8 text-[#5f5b52]">
            At Dreamstill, sustainability is a cultural and emotional journey. We help people rediscover agency and care
            through the clothes they wear and the communities they belong to.
          </p>
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Why we started"
            title="The problem we lived: clothing guilt without a clear next step."
            copy="Dreamstill began when founders kept hearing the same story — people wanted to do the right thing with clothing, but every pathway felt confusing, shameful, or out of reach."
          />
        </FadeIn>
        <div className="mt-8 grid gap-4 md:grid-cols-3">
          {[
            "Closets full of garments with no trusted guidance.",
            "Donation streams overwhelmed by low-quality intake.",
            "Cities and partners lacking behaviour-level textile infrastructure.",
          ].map((item) => (
            <div key={item} className="premium-card rounded-[2rem] p-5 text-sm leading-7 text-[#625e55]">
              {item}
            </div>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader eyebrow="Our story" title="A timeline of learning, building, and scaling impact." />
        </FadeIn>
        <div className="mt-8 grid gap-5">
          {timeline.map((item, index) => (
            <FadeIn key={item.season} delay={index * 0.04}>
              <article className="premium-card rounded-[2.25rem] p-6 md:p-8">
                <p className="text-xs font-semibold uppercase tracking-[0.28em] text-[#8a6d58]">{item.season}</p>
                <h3 className="page-subtitle mt-3 text-3xl md:text-4xl">{item.title}</h3>
                <p className="mt-3 text-sm leading-7 text-[#625e55]">{item.copy}</p>
                <p className="mt-3 text-sm font-medium leading-7 text-[#4f4b44]">{item.outcome}</p>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader eyebrow="Values" title="Creative rigor, community accountability, better endings for clothing." />
        </FadeIn>
        <div className="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          {values.map((value, index) => (
            <FadeIn key={value.title} delay={index * 0.04}>
              <div className="premium-card h-full rounded-[2rem] p-6">
                <h3 className="font-serif text-2xl font-medium tracking-[-0.03em] text-[#20201d]">{value.title}</h3>
                <p className="mt-3 text-sm leading-7 text-[#625e55]">{value.copy}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Founders"
            title="Two founders building climate infrastructure with community heart."
            copy="Founder-led climate technology with community roots in Vancouver and the Pacific Northwest."
          />
        </FadeIn>
        <div className="mt-8 grid gap-6 lg:grid-cols-2">
          {founders.map((founder, index) => (
            <FadeIn key={founder.name} delay={index * 0.06}>
              <article className="premium-card grid gap-6 rounded-[2.5rem] p-6 md:grid-cols-[0.34fr_0.66fr]">
                <div className="relative min-h-56 overflow-hidden rounded-[2rem] bg-[#20201d]/5">
                  <Image src={founder.image} alt={`Portrait of ${founder.name}`} fill className="object-cover" />
                </div>
                <div>
                  <h3 className="page-subtitle text-3xl">{founder.name}</h3>
                  {founder.paragraphs.map((paragraph) => (
                    <p key={paragraph.slice(0, 24)} className="mt-4 text-sm leading-7 text-[#625e55]">
                      {paragraph}
                    </p>
                  ))}
                  <Link
                    href={founder.linkedin}
                    target="_blank"
                    rel="noreferrer"
                    className="mt-5 inline-flex text-sm font-semibold text-[#56685b] underline underline-offset-4"
                  >
                    Connect on LinkedIn
                  </Link>
                </div>
              </article>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-8 lg:grid-cols-2">
          <FadeIn>
            <SectionHeader
              eyebrow="Advisors & supporters"
              title="Growing with research, community, and industry allies."
              copy="Dreamstill collaborates with mentors and institutional supporters who strengthen product rigor and community trust."
            />
            <ul className="mt-6 grid gap-3">
              {advisors.map((item) => (
                <li key={item} className="rounded-2xl bg-white/55 px-4 py-3 text-sm text-[#625e55]">
                  {item}
                </li>
              ))}
            </ul>
          </FadeIn>
          <FadeIn delay={0.08}>
            <div className="dark-card h-full rounded-[2.5rem] p-8">
              <p className="text-xs uppercase tracking-[0.32em] text-[#d9c6b2]">Where we&apos;re headed</p>
              <h2 className="page-subtitle mt-4 text-[#fffaf1]">Circular infrastructure for every clothing decision.</h2>
              <p className="mt-5 text-sm leading-7 text-[#efe5d8]/78">
                Dreamstill is building the connective layer between closets, repair culture, resale, donation systems,
                municipalities, and recycling networks — with Sorty as the intelligence interface.
              </p>
              <div className="mt-8 flex flex-col gap-3 sm:flex-row">
                <ButtonLink href="/sorty" variant="sage">
                  Explore Sorty
                </ButtonLink>
                <ButtonLink href="/investors" variant="light">
                  For investors
                </ButtonLink>
              </div>
            </div>
          </FadeIn>
        </div>
      </section>
    </div>
  );
}
