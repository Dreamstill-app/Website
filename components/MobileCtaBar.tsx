import Link from "next/link";

export function MobileCtaBar() {
  return (
    <div className="fixed inset-x-0 bottom-0 z-40 border-t border-[#20201d]/10 bg-[#fffaf1]/92 px-4 py-3 backdrop-blur lg:hidden">
      <div className="container-shell grid grid-cols-2 gap-3">
        <Link
          href="/portfolio#calendly"
          className="rounded-full bg-[#20201d] px-4 py-3 text-center text-xs font-semibold uppercase tracking-[0.16em] text-[#fffaf1]"
        >
          Book experience
        </Link>
        <Link
          href="/contact"
          className="rounded-full border border-[#20201d]/12 bg-white px-4 py-3 text-center text-xs font-semibold uppercase tracking-[0.16em] text-[#20201d]"
        >
          Contact us
        </Link>
      </div>
    </div>
  );
}
