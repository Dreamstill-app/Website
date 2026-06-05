import Link from "next/link";
import { site } from "@/lib/site";

const links = [
  { label: "Instagram", href: site.social.instagram },
  { label: "LinkedIn", href: site.social.linkedin },
  { label: "Facebook", href: site.social.facebook },
] as const;

export function SocialLinks({ className = "" }: { className?: string }) {
  return (
    <div className={`flex flex-wrap gap-3 ${className}`}>
      {links.map((link) => (
        <Link
          key={link.href}
          href={link.href}
          target="_blank"
          rel="noreferrer"
          className="rounded-full border border-[#20201d]/10 bg-white/55 px-4 py-2 text-sm font-medium text-[#514f48] transition hover:bg-white hover:text-[#20201d]"
        >
          {link.label}
        </Link>
      ))}
    </div>
  );
}
