"use client";

import { animate, motion, useInView, useMotionValue, useReducedMotion, useTransform } from "framer-motion";
import { useEffect, useRef } from "react";

type AnimatedCounterProps = {
  value: number;
  suffix?: string;
  prefix?: string;
  decimals?: number;
};

export function AnimatedCounter({ value, suffix = "", prefix = "", decimals = 0 }: AnimatedCounterProps) {
  const ref = useRef<HTMLSpanElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });
  const reduceMotion = useReducedMotion();
  const motionValue = useMotionValue(reduceMotion ? value : 0);
  const rounded = useTransform(motionValue, (latest) => {
    return `${prefix}${latest.toLocaleString("en-US", {
      maximumFractionDigits: decimals,
      minimumFractionDigits: decimals,
    })}${suffix}`;
  });

  useEffect(() => {
    if (!isInView || reduceMotion) {
      motionValue.set(value);
      return;
    }

    const controls = animate(motionValue, value, {
      duration: 1.3,
      ease: [0.22, 1, 0.36, 1],
    });

    return controls.stop;
  }, [isInView, motionValue, reduceMotion, value]);

  return <motion.span ref={ref}>{rounded}</motion.span>;
}
