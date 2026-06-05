"use client";

import Image from "next/image";
import { useState } from "react";

type EventImageProps = {
  src: string;
  fallback: string;
  alt: string;
  className?: string;
  fill?: boolean;
  priority?: boolean;
};

export function EventImage({ src, fallback, alt, className = "", fill = true, priority = false }: EventImageProps) {
  const [currentSrc, setCurrentSrc] = useState(src);

  return (
    <Image
      src={currentSrc}
      alt={alt}
      fill={fill}
      priority={priority}
      className={`object-cover ${className}`}
      sizes="(max-width: 768px) 100vw, 50vw"
      onError={() => {
        if (currentSrc !== fallback) {
          setCurrentSrc(fallback);
        }
      }}
    />
  );
}
