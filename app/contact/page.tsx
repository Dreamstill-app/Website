import type { Metadata } from "next";
import { FadeIn } from "@/components/FadeIn";
import { SectionHeader } from "@/components/SectionHeader";

export const metadata: Metadata = {
  title: "Contact and Partnerships",
  description:
    "Contact Dreamstill for municipal partnerships, business partnerships, repair shop listings, media, investors, and circular economy collaboration.",
};

const inquiryTypes = [
  {
    title: "Municipalities",
    copy: "Pilot intelligent textile diversion, local circular maps, and public education.",
  },
  {
    title: "Business partnerships",
    copy: "Explore subscription partnerships for thrift, consignment, resale, and circular economy operations.",
  },
  {
    title: "Repair shops",
    copy: "Join the Sorty ecosystem with local visibility and priority repair pathways.",
  },
  {
    title: "Media",
    copy: "Request interviews, founder background, climate technology context, or brand assets.",
  },
  {
    title: "Investors",
    copy: "Discuss Dreamstill's circular infrastructure vision, product roadmap, and category opportunity.",
  },
];

export default function ContactPage() {
  return (
    <div className="pt-32">
      <section className="container-shell py-16">
        <div className="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
          <FadeIn>
            <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">Contact</p>
            <h1 className="font-serif mt-5 text-6xl leading-[0.94] tracking-[-0.065em] text-[#20201d] md:text-8xl">
              Partner on the future of clothing reuse.
            </h1>
            <p className="mt-7 max-w-2xl text-lg leading-8 text-[#5f5b52]">
              Dreamstill works with municipalities, businesses, repair shops, investors, media, and circular economy
              partners building climate-conscious fashion systems.
            </p>
          </FadeIn>
          <FadeIn delay={0.1}>
            <form className="premium-card rounded-[3rem] p-6 md:p-8">
              <div className="grid gap-5 md:grid-cols-2">
                <label className="grid gap-2 text-sm font-medium text-[#34322d]">
                  Name
                  <input className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]" placeholder="Your name" />
                </label>
                <label className="grid gap-2 text-sm font-medium text-[#34322d]">
                  Email
                  <input className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]" placeholder="you@example.com" type="email" />
                </label>
              </div>
              <label className="mt-5 grid gap-2 text-sm font-medium text-[#34322d]">
                Inquiry type
                <select className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]" defaultValue="">
                  <option value="" disabled>Select one</option>
                  {inquiryTypes.map((type) => (
                    <option key={type.title}>{type.title}</option>
                  ))}
                </select>
              </label>
              <label className="mt-5 grid gap-2 text-sm font-medium text-[#34322d]">
                Message
                <textarea
                  className="min-h-36 rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
                  placeholder="Tell us what you are building, operating, or exploring."
                />
              </label>
              <button
                type="button"
                className="mt-6 w-full rounded-full bg-[#20201d] px-6 py-4 text-sm font-semibold text-[#fffaf1] transition hover:-translate-y-0.5 hover:bg-[#34322d]"
              >
                Send inquiry
              </button>
              <p className="mt-4 text-center text-xs leading-5 text-[#625e55]">
                Form integration can connect to the preferred CRM or email workflow.
              </p>
            </form>
          </FadeIn>
        </div>
      </section>

      <section className="container-shell py-16">
        <FadeIn>
          <SectionHeader
            eyebrow="Inquiry pathways"
            title="Every partner enters through a clear door."
            copy="The contact experience separates municipal, business, repair, media, investor, and partner needs so Dreamstill can respond with the right context."
          />
        </FadeIn>
        <div className="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
          {inquiryTypes.map((type, index) => (
            <FadeIn key={type.title} delay={index * 0.05}>
              <div className="premium-card h-full rounded-[2.25rem] p-6">
                <p className="font-serif text-3xl leading-[1.05] tracking-[-0.035em] text-[#20201d]">{type.title}</p>
                <p className="mt-4 text-sm leading-7 text-[#625e55]">{type.copy}</p>
              </div>
            </FadeIn>
          ))}
        </div>
      </section>
    </div>
  );
}
