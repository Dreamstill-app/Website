"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";

const navItems = [
  { href: "/sorty", label: "Sorty" },
  { href: "/businesses", label: "For Businesses" },
  { href: "/impact", label: "Impact" },
  { href: "/community", label: "Community" },
  { href: "/about", label: "About" },
];

export function SiteHeader() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  return (
    <header className="fixed left-0 right-0 top-0 z-50 px-4 py-4">
      <div className="container-shell">
        <nav className="premium-card flex items-center justify-between rounded-full px-4 py-3 md:px-5">
          <Link href="/" className="group flex items-center gap-3" aria-label="Dreamstill home">
            <span className="grid h-10 w-10 place-items-center rounded-full bg-[#20201d] text-sm font-semibold text-[#fffaf1] shadow-lg shadow-[#20201d]/15 transition-transform duration-300 group-hover:scale-105">
              D
            </span>
            <span className="flex flex-col leading-none">
              <span className="text-sm font-semibold tracking-[0.22em] text-[#20201d]">DREAMSTILL</span>
              <span className="mt-1 hidden text-[0.62rem] uppercase tracking-[0.32em] text-[#6e6a60] sm:block">
                Circular intelligence
              </span>
            </span>
          </Link>

          <div className="hidden items-center gap-1 lg:flex">
            {navItems.map((item) => {
              const active = pathname === item.href;
              return (
                <Link
                  key={item.href}
                  href={item.href}
                  className={`rounded-full px-4 py-2 text-sm transition-all duration-300 ${
                    active
                      ? "bg-[#20201d] text-[#fffaf1] shadow-lg shadow-[#20201d]/10"
                      : "text-[#514f48] hover:bg-white/60 hover:text-[#20201d]"
                  }`}
                >
                  {item.label}
                </Link>
              );
            })}
          </div>

          <div className="hidden items-center gap-2 lg:flex">
            <Link
              href="/contact"
              className="rounded-full border border-[#20201d]/10 bg-white/55 px-4 py-2 text-sm font-medium text-[#20201d] transition hover:-translate-y-0.5 hover:bg-white"
            >
              Partner with us
            </Link>
            <Link
              href="/sorty"
              className="rounded-full bg-[#8da18f] px-4 py-2 text-sm font-semibold text-[#1e241f] shadow-lg shadow-[#8da18f]/30 transition hover:-translate-y-0.5 hover:bg-[#9fb09f]"
            >
              Download Sorty
            </Link>
          </div>

          <button
            type="button"
            className="rounded-full border border-[#20201d]/10 bg-white/60 px-4 py-2 text-sm font-semibold text-[#20201d] lg:hidden"
            aria-expanded={open}
            aria-controls="mobile-menu"
            onClick={() => setOpen((value) => !value)}
          >
            Menu
          </button>
        </nav>

        {open ? (
          <div id="mobile-menu" className="premium-card mt-3 rounded-[2rem] p-4 lg:hidden">
            <div className="grid gap-2">
              {navItems.map((item) => (
                <Link
                  key={item.href}
                  href={item.href}
                  className="rounded-2xl px-4 py-3 text-sm font-medium text-[#20201d] hover:bg-white/60"
                  onClick={() => setOpen(false)}
                >
                  {item.label}
                </Link>
              ))}
              <Link
                href="/contact"
                className="mt-2 rounded-2xl bg-[#20201d] px-4 py-3 text-center text-sm font-semibold text-[#fffaf1]"
                onClick={() => setOpen(false)}
              >
                Start a partnership
              </Link>
            </div>
          </div>
        ) : null}
      </div>
    </header>
  );
}
