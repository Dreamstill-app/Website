"use client";

import { useState } from "react";
import { EventImage } from "@/components/EventImage";
import { heroSlides } from "@/lib/site";

export function FeatureSlider() {
  const [active, setActive] = useState(0);
  const slide = heroSlides[active];

  return (
    <div className="premium-card noise-border overflow-hidden rounded-[3rem] p-4 md:p-5">
      <div className="relative min-h-[420px] overflow-hidden rounded-[2.5rem]">
        <EventImage
          src={slide.image}
          fallback={slide.fallback}
          alt={slide.title}
          priority={active === 0}
          className="transition duration-700"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-[#20201d]/78 via-[#20201d]/20 to-transparent" />
        <div className="absolute inset-x-5 bottom-5 rounded-[1.75rem] border border-white/15 bg-white/14 p-5 text-[#fffaf1] backdrop-blur-md">
          <p className="text-xs uppercase tracking-[0.28em] text-[#fffaf1]/72">Dreamstill in action</p>
          <h2 className="page-subtitle mt-2 text-[#fffaf1]">{slide.title}</h2>
          <p className="mt-3 max-w-xl text-sm leading-7 text-[#fffaf1]/82">{slide.copy}</p>
        </div>
      </div>
      <div className="mt-4 flex flex-wrap gap-2">
        {heroSlides.map((item, index) => (
          <button
            key={item.title}
            type="button"
            onClick={() => setActive(index)}
            className={`rounded-full px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] transition ${
              active === index
                ? "bg-[#20201d] text-[#fffaf1]"
                : "border border-[#20201d]/10 bg-white/55 text-[#514f48] hover:bg-white"
            }`}
            aria-pressed={active === index}
          >
            {index + 1}
          </button>
        ))}
      </div>
    </div>
  );
}
