import Link from "next/link";

const footerGroups = [
  {
    title: "Platform",
    links: [
      { href: "/sorty", label: "Sorty app" },
      { href: "/businesses", label: "Business partnerships" },
      { href: "/impact", label: "Impact dashboard" },
    ],
  },
  {
    title: "Company",
    links: [
      { href: "/about", label: "About Dreamstill" },
      { href: "/community", label: "Community and events" },
      { href: "/contact", label: "Contact" },
    ],
  },
  {
    title: "Audiences",
    links: [
      { href: "/businesses#thrift", label: "Thrift stores" },
      { href: "/businesses#consignment", label: "Consignment" },
      { href: "/businesses#municipalities", label: "Municipalities" },
    ],
  },
];

export function Footer() {
  return (
    <footer className="container-shell pb-8 pt-20">
      <div className="dark-card rounded-[2.5rem] p-8 md:p-12">
        <div className="grid gap-10 lg:grid-cols-[1.4fr_1fr]">
          <div>
            <p className="text-sm uppercase tracking-[0.32em] text-[#d9c6b2]">Dreamstill</p>
            <h2 className="font-serif mt-5 max-w-2xl text-4xl leading-[1.02] tracking-[-0.04em] md:text-6xl">
              Technology for a circular fashion future.
            </h2>
            <p className="mt-6 max-w-xl text-base leading-7 text-[#efe5d8]/78">
              AI-powered textile circularity for people, stores, cities, and partners working to keep clothing in use longer.
            </p>
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

        <div className="mt-12 flex flex-col gap-4 border-t border-white/10 pt-6 text-xs uppercase tracking-[0.22em] text-[#fffaf1]/48 md:flex-row md:items-center md:justify-between">
          <p>Vancouver built. BIPOC female-led. Climate-conscious fashion systems.</p>
          <p>Reuse before recycling.</p>
        </div>
      </div>
    </footer>
  );
}
