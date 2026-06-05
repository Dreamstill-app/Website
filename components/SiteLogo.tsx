import Image from "next/image";
import Link from "next/link";

type SiteLogoProps = {
  compact?: boolean;
};

export function SiteLogo({ compact = false }: SiteLogoProps) {
  return (
    <Link href="/" className="group flex items-center gap-3" aria-label="Dreamstill home">
      <span className="relative grid h-10 w-10 shrink-0 place-items-center overflow-hidden rounded-full bg-[#20201d] shadow-lg shadow-[#20201d]/15 transition-transform duration-300 group-hover:scale-105">
        <Image src="/logo-icon.svg" alt="" width={28} height={28} className="h-7 w-7" priority />
      </span>
      {!compact ? (
        <span className="flex flex-col leading-none">
          <span className="text-sm font-semibold tracking-[0.22em] text-[#20201d]">DREAMSTILL</span>
          <span className="mt-1 hidden text-[0.62rem] uppercase tracking-[0.32em] text-[#6e6a60] sm:block">
            Circular textile technology
          </span>
        </span>
      ) : null}
    </Link>
  );
}
