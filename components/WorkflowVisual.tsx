const steps = [
  "Photo input",
  "Garment ID",
  "Condition analysis",
  "Pathway scoring",
  "Local routing",
];

export function WorkflowVisual() {
  return (
    <div className="premium-card rounded-[2.5rem] p-6 md:p-8">
      <div className="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        {steps.map((step, index) => (
          <div key={step} className="flex flex-1 items-center gap-4 lg:flex-col lg:gap-5">
            <div className="grid h-16 w-16 shrink-0 place-items-center rounded-3xl bg-[#20201d] text-lg font-semibold text-[#fffaf1] shadow-xl shadow-[#20201d]/15">
              {index + 1}
            </div>
            <div className="w-full rounded-3xl border border-[#20201d]/8 bg-white/55 p-4 text-left lg:text-center">
              <p className="text-sm font-semibold text-[#20201d]">{step}</p>
              <p className="mt-2 text-xs leading-5 text-[#6a655d]">
                {index === 0 && "A user snaps a garment in seconds."}
                {index === 1 && "AI recognizes category, fabric cues, and resale signals."}
                {index === 2 && "Sorty evaluates visible wear, repairability, and quality."}
                {index === 3 && "Reuse, repair, donation, resale, and recycling are ranked."}
                {index === 4 && "The user is guided to the best nearby circular option."}
              </p>
            </div>
            {index < steps.length - 1 ? (
              <div className="hidden h-px w-12 bg-[#20201d]/15 lg:block" aria-hidden="true" />
            ) : null}
          </div>
        ))}
      </div>
    </div>
  );
}
