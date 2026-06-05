import Link from "next/link";
import { partners } from "@/lib/site";

export function PartnerStrip({ title = "Partners & collaborators" }: { title?: string }) {
  return (
    <div>
      <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6d58]">{title}</p>
      <div className="mt-5 flex flex-wrap gap-3">
        {partners.map((partner) =>
          partner.href ? (
            <Link
              key={partner.name}
              href={partner.href}
              target="_blank"
              rel="noreferrer"
              className="rounded-full border border-[#20201d]/10 bg-white/55 px-5 py-3 text-xs font-semibold uppercase tracking-[0.18em] text-[#625e55] transition hover:-translate-y-0.5 hover:bg-white hover:text-[#20201d]"
            >
              {partner.name}
            </Link>
          ) : (
            <span
              key={partner.name}
              className="rounded-full border border-[#20201d]/10 bg-white/55 px-5 py-3 text-xs font-semibold uppercase tracking-[0.18em] text-[#625e55]"
            >
              {partner.name}
            </span>
          ),
        )}
      </div>
    </div>
  );
}
