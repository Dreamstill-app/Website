"use client";

import { motion } from "framer-motion";

const nodes = [
  { label: "Closet", detail: "A garment is no longer worn.", x: "50%", y: "8%" },
  { label: "Sorty", detail: "Circular intelligence evaluates its next life.", x: "82%", y: "38%" },
  { label: "Reuse", detail: "Resale, repair, donation, or redistribution.", x: "64%", y: "82%" },
  { label: "Recovery", detail: "Recycling only when reuse is no longer viable.", x: "20%", y: "70%" },
  { label: "Community", detail: "Local partners receive better-matched garments.", x: "18%", y: "28%" },
];

export function GarmentLifecycle() {
  return (
    <div className="premium-card relative min-h-[520px] overflow-hidden rounded-[2.5rem] p-6">
      <svg className="absolute inset-0 h-full w-full path-glow" viewBox="0 0 600 520" role="img" aria-label="Circular garment lifecycle diagram">
        <motion.path
          d="M300 70 C475 90 548 242 455 390 C344 538 123 444 102 276 C82 112 190 46 300 70Z"
          fill="none"
          stroke="rgba(86,104,91,0.42)"
          strokeWidth="3"
          strokeDasharray="10 12"
          initial={{ pathLength: 0 }}
          whileInView={{ pathLength: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 1.8, ease: "easeInOut" }}
        />
      </svg>
      {nodes.map((node, index) => (
        <motion.div
          key={node.label}
          className="absolute w-40 -translate-x-1/2 -translate-y-1/2 rounded-[1.8rem] border border-white/60 bg-white/70 p-4 shadow-xl shadow-[#20201d]/8 backdrop-blur"
          style={{ left: node.x, top: node.y }}
          initial={{ opacity: 0, scale: 0.92 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ delay: index * 0.09, duration: 0.55 }}
        >
          <p className="text-sm font-semibold text-[#20201d]">{node.label}</p>
          <p className="mt-2 text-xs leading-5 text-[#625e55]">{node.detail}</p>
        </motion.div>
      ))}
      <div className="absolute left-1/2 top-1/2 grid h-28 w-28 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full bg-[#20201d] text-center text-sm font-semibold uppercase tracking-[0.2em] text-[#fffaf1] shadow-2xl shadow-[#20201d]/20">
        Reuse before recycling
      </div>
    </div>
  );
}
