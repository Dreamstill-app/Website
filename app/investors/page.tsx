import type { Metadata } from "next";
import { ButtonLink } from "@/components/ButtonLink";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";
import { socialProof, site } from "@/lib/site";
import { createPageMetadata } from "@/lib/metadata";

export const metadata: Metadata = createPageMetadata({
  title: "For investors and funders",
  description:
    "Invest in Dreamstill's circular textile technology platform, community programming, and Sorty product roadmap.",
  path: "/investors",
});

export default function InvestorsPage() {
  return (
    <div className="pt-28">
      <section className="container-shell section-space">
        <FadeIn>
          <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Investors & funders</p>
          <h1 className="page-title mt-5 max-w-4xl">Circular textile infrastructure with measurable community traction.</h1>
          <p className="mt-6 max-w-3xl text-lg leading-8 text-[#5f5b52]">
            Dreamstill combines climate technology (Sorty), high-trust community programming, and corporate experiences —
            creating multiple pathways to revenue, partnership, and impact data.
          </p>
          <div className="mt-8 flex flex-col gap-3 sm:flex-row">
            <ButtonLink href={`mailto:${site.email}?subject=Investor%20conversation`}>Request investor call</ButtonLink>
            <ButtonLink href={site.investorDeck} variant="light">
              Request one-pager
            </ButtonLink>
          </div>
        </FadeIn>
      </section>

      <section className="container-shell section-space">
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          {socialProof.map((item, index) => (
            <FadeIn key={item.label} delay={index * 0.04}>
              <div className="premium-card rounded-[2rem] p-5">
                <p className="font-serif text-3xl font-medium text-[#20201d]">{item.value}</p>
                <p className="mt-3 text-sm leading-6 text-[#625e55]">{item.label}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>

      <section className="container-shell section-space">
        <FadeIn>
          <SectionHeader
            eyebrow="Investment thesis"
            title="Category creation in circular fashion decision infrastructure."
            copy="Textile waste is a systems problem. Dreamstill builds the intelligence layer that helps people, cities, and partners route garments to higher-value pathways."
          />
        </FadeIn>
        <div className="mt-8 grid gap-5 md:grid-cols-3">
          {[
            "BIPOC female-led team with product + community execution",
            "Sorty pilots opening municipal and partner integrations",
            "Experiences revenue funds programming and brand trust",
          ].map((item) => (
            <div key={item} className="premium-card rounded-[2rem] p-6 text-sm leading-7 text-[#625e55]">
              {item}
            </div>
          ))}
        </div>
      </section>
    </div>
  );
}
