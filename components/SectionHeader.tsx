type SectionHeaderProps = {
  eyebrow: string;
  title: string;
  copy?: string;
  align?: "left" | "center";
};

export function SectionHeader({ eyebrow, title, copy, align = "left" }: SectionHeaderProps) {
  return (
    <div className={align === "center" ? "mx-auto max-w-3xl text-center" : "max-w-3xl"}>
      <p className="text-xs font-semibold uppercase tracking-[0.32em] text-[#8a6d58]">{eyebrow}</p>
      <h2 className="page-subtitle mt-4 md:text-[2.75rem]">
        {title}
      </h2>
      {copy ? <p className="mt-5 text-base leading-8 text-[#5f5b52] md:text-lg">{copy}</p> : null}
    </div>
  );
}
