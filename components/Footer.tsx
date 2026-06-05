import Link from "next/link";
import { SiteLogo } from "@/components/SiteLogo";
import { SocialLinks } from "@/components/SocialLinks";
import { site } from "@/lib/site";

const footerGroups = [
  {
    title: "Platform",
    links: [
      { href: "/sorty", label: "Sorty app" },
      { href: "/portfolio", label: "Experiences" },
      { href: "/impact", label: "Impact" },
      { href: "/investors", label: "For investors" },
    ],
  },
  {
    title: "Company",
    links: [
      { href: "/about", label: "About" },
      { href: "/community", label: "Community" },
      { href: "/contact", label: "Contact" },
    ],
  },
  {
    title: "Partners",
    links: [
      { href: "/businesses#municipalities", label: "Municipalities" },
      { href: "/businesses", label: "Businesses" },
      { href: "/portfolio#calendly", label: "Book a call" },
    ],
  },
];

export function Footer() {
  return (
    <footer className="container-shell section-space pb-8 pt-12">
      <div className="dark-card rounded-[2.5rem] p-8 md:p-12">
        <div className="grid gap-10 lg:grid-cols-[1.35fr_1fr]">
          <div>
            <SiteLogo compact />
            <h2 className="page-subtitle mt-6 max-w-2xl text-[#fffaf1]">
              Ready to work together? Let&apos;s build circular textile systems that feel human.
            </h2>
            <p className="mt-5 max-w-xl text-base leading-7 text-[#efe5d8]/78">
              Book an experience, request a Sorty pilot, or explore partnerships for municipalities, investors, and
              circular fashion collaborators.
            </p>
            <div className="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                className="inline-flex items-center justify-center rounded-full bg-[#8da18f] px-6 py-3 text-sm font-semibold text-[#1e241f] transition hover:-translate-y-0.5"
              >
                Get in touch
              </Link>
              <Link
                href="/portfolio#calendly"
                className="inline-flex items-center justify-center rounded-full border border-white/15 bg-white/8 px-6 py-3 text-sm font-semibold text-[#fffaf1] transition hover:bg-white/12"
              >
                Book an experience
              </Link>
            </div>
            <p className="mt-6 text-sm text-[#efe5d8]/72">
              <a href={`mailto:${site.email}`} className="underline decoration-[#d9c6b2]/50 underline-offset-4">
                {site.email}
              </a>{" "}
              · {site.phone}
            </p>
            <SocialLinks className="mt-6" />
          </div>

          <div className="grid gap-8 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">
            {footerGroups.map((group) => (
              <div key={group.title}>
                <p className="text-xs uppercase tracking-[0.28em] text-[#d9c6b2]">{group.title}</p>
                <div className="mt-4 grid gap-3 text-sm text-[#fffaf1]/74">
                  {group.links.map((link) => (
                    <Link key={link.href} href={link.href} className="transition hover:text-[#fffaf1]">
                      {link.label}
                    </Link>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="mt-12 border-t border-white/10 pt-6 text-xs leading-6 text-[#fffaf1]/48">
          <p>
            Land acknowledgement: Dreamstill operates in Vancouver, BC on the traditional, ancestral, and unceded
            territories of the Musqueam, Squamish, and Tsleil-Waututh Nations.
          </p>
          <p className="mt-4 flex flex-col gap-2 uppercase tracking-[0.22em] md:flex-row md:items-center md:justify-between">
            <span>© {new Date().getFullYear()} {site.legalName}</span>
            <span>Reuse before recycling.</span>
          </p>
        </div>
      </div>
    </footer>
  );
}
