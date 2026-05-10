const pathways = [
  { label: "Resale", score: "92%", tone: "bg-[#8da18f]" },
  { label: "Repair", score: "78%", tone: "bg-[#d3a58d]" },
  { label: "Donate", score: "64%", tone: "bg-[#c6b8a1]" },
  { label: "Recycle", score: "18%", tone: "bg-[#6b725f]" },
];

export function AppMockup() {
  return (
    <div className="relative mx-auto w-full max-w-[420px]">
      <div className="absolute -left-8 top-10 hidden rounded-[2rem] border border-white/50 bg-white/45 p-4 shadow-2xl shadow-[#20201d]/10 backdrop-blur-xl md:block">
        <p className="text-xs uppercase tracking-[0.24em] text-[#777065]">Condition</p>
        <p className="mt-2 text-2xl font-semibold text-[#20201d]">Good</p>
      </div>
      <div className="absolute -right-6 bottom-16 hidden rounded-[2rem] border border-white/50 bg-[#20201d] p-4 text-[#fffaf1] shadow-2xl shadow-[#20201d]/20 md:block">
        <p className="text-xs uppercase tracking-[0.24em] text-[#d9c6b2]">Best next step</p>
        <p className="mt-2 text-2xl font-semibold">Resale</p>
      </div>
      <div className="noise-border relative rounded-[3rem] bg-[#20201d] p-3 shadow-[0_36px_100px_rgba(32,32,29,0.24)]">
        <div className="overflow-hidden rounded-[2.35rem] bg-[#fffaf1]">
          <div className="soft-grid relative min-h-[620px] p-5">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-xs uppercase tracking-[0.28em] text-[#8a6d58]">Sorty scan</p>
                <h3 className="mt-2 text-xl font-semibold text-[#20201d]">Wool blazer</h3>
              </div>
              <span className="rounded-full bg-[#8da18f]/25 px-3 py-1 text-xs font-semibold text-[#4e5d50]">AI ready</span>
            </div>

            <div className="float-slow relative mt-8 h-64 rounded-[2rem] bg-gradient-to-br from-[#dcc2ad] via-[#c5b69d] to-[#6a7566] p-5 shadow-inner">
              <div className="absolute inset-x-16 top-8 h-28 rounded-t-full bg-[#2f302d]/82" />
              <div className="absolute left-20 top-24 h-28 w-12 rotate-12 rounded-full bg-[#2f302d]/82" />
              <div className="absolute right-20 top-24 h-28 w-12 -rotate-12 rounded-full bg-[#2f302d]/82" />
              <div className="absolute bottom-10 left-1/2 h-28 w-36 -translate-x-1/2 rounded-b-[3rem] rounded-t-xl bg-[#2f302d]/88" />
              <div className="absolute bottom-6 left-6 right-6 rounded-2xl bg-white/55 p-3 backdrop-blur">
                <div className="h-2 rounded-full bg-[#20201d]/20" />
                <div className="mt-2 h-2 w-2/3 rounded-full bg-[#20201d]/14" />
              </div>
            </div>

            <div className="mt-6 rounded-[2rem] border border-[#20201d]/8 bg-white/70 p-4">
              <div className="flex items-center justify-between">
                <p className="text-sm font-semibold text-[#20201d]">Circular pathway match</p>
                <p className="text-xs uppercase tracking-[0.22em] text-[#8a6d58]">3 sec</p>
              </div>
              <div className="mt-4 grid gap-3">
                {pathways.map((pathway) => (
                  <div key={pathway.label}>
                    <div className="mb-1 flex items-center justify-between text-xs text-[#5f5b52]">
                      <span>{pathway.label}</span>
                      <span>{pathway.score}</span>
                    </div>
                    <div className="h-2 rounded-full bg-[#20201d]/8">
                      <div className={`h-2 rounded-full ${pathway.tone}`} style={{ width: pathway.score }} />
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="mt-5 grid grid-cols-2 gap-3">
              <div className="rounded-3xl bg-[#20201d] p-4 text-[#fffaf1]">
                <p className="text-xs text-[#d9c6b2]">Nearby match</p>
                <p className="mt-2 text-lg font-semibold">3 resale partners</p>
              </div>
              <div className="rounded-3xl bg-[#8da18f]/25 p-4 text-[#293028]">
                <p className="text-xs text-[#56685b]">Impact</p>
                <p className="mt-2 text-lg font-semibold">Reuse first</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
