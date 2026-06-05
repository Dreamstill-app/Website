"use client";

import { FormEvent, useState } from "react";

export function NewsletterSignup({ compact = false }: { compact?: boolean }) {
  const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle");
  const [message, setMessage] = useState("");

  async function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setStatus("loading");
    setMessage("");

    const form = event.currentTarget;
    const formData = new FormData(form);
    const email = String(formData.get("email") ?? "");

    try {
      const response = await fetch("/api/newsletter", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
      });

      if (!response.ok) {
        throw new Error("Unable to subscribe right now.");
      }

      setStatus("success");
      setMessage("Thanks — you're on the list. We'll share circular fashion updates and launch news.");
      form.reset();
    } catch {
      setStatus("error");
      setMessage("We couldn't save your email yet. Try again or write to info@dreamstill.ca.");
    }
  }

  return (
    <form
      onSubmit={handleSubmit}
      className={compact ? "grid gap-3 sm:grid-cols-[1fr_auto]" : "premium-card rounded-[2rem] p-6 md:p-8"}
    >
      {!compact ? (
        <div>
          <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6d58]">Stay in the loop</p>
          <h3 className="page-subtitle mt-3">Get circular fashion updates from Dreamstill</h3>
          <p className="mt-3 text-sm leading-7 text-[#625e55]">
            Events, Sorty launch news, and partnership opportunities — no spam, unsubscribe anytime.
          </p>
        </div>
      ) : null}
      <label className="grid gap-2 text-sm font-medium text-[#34322d]">
        {compact ? <span className="sr-only">Email</span> : "Email"}
        <input
          name="email"
          type="email"
          required
          placeholder="you@example.com"
          className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
        />
      </label>
      <button
        type="submit"
        disabled={status === "loading"}
        className="rounded-full bg-[#20201d] px-6 py-3 text-sm font-semibold text-[#fffaf1] transition hover:-translate-y-0.5 hover:bg-[#34322d] disabled:opacity-60"
      >
        {status === "loading" ? "Joining..." : "Join the list"}
      </button>
      {message ? <p className="text-sm leading-6 text-[#625e55] sm:col-span-2">{message}</p> : null}
    </form>
  );
}
