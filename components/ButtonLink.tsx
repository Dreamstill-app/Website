import Link from "next/link";
import type { ReactNode } from "react";

type ButtonLinkProps = {
  href: string;
  children: ReactNode;
  variant?: "dark" | "light" | "sage";
};

export function ButtonLink({ href, children, variant = "dark" }: ButtonLinkProps) {
  const styles = {
    dark: "bg-[#20201d] text-[#fffaf1] shadow-xl shadow-[#20201d]/15 hover:bg-[#34322d]",
    light: "border border-[#20201d]/10 bg-white/60 text-[#20201d] hover:bg-white",
    sage: "bg-[#8da18f] text-[#1f251f] shadow-xl shadow-[#8da18f]/25 hover:bg-[#a1b1a1]",
  };

  return (
    <Link
      href={href}
      className={`inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold transition duration-300 hover:-translate-y-0.5 ${styles[variant]}`}
    >
      {children}
    </Link>
  );
}
