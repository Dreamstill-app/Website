"use client";

import { FormEvent, useState } from "react";

const inquiryOptions = [
  "Sorty app pilot",
  "Corporate experience booking",
  "Municipal partnership",
  "Industry partnership",
  "Investor or grant inquiry",
  "Media or speaking",
  "General inquiry",
] as const;

type ContactFormProps = {
  defaultInterest?: (typeof inquiryOptions)[number];
  submitLabel?: string;
};

export function ContactForm({
  defaultInterest = "General inquiry",
  submitLabel = "Send inquiry",
}: ContactFormProps) {
  const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle");
  const [message, setMessage] = useState("");

  async function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setStatus("loading");
    setMessage("");

    const formData = new FormData(event.currentTarget);
    const payload = {
      name: String(formData.get("name") ?? ""),
      email: String(formData.get("email") ?? ""),
      organization: String(formData.get("organization") ?? ""),
      interest: String(formData.get("interest") ?? ""),
      message: String(formData.get("message") ?? ""),
    };

    try {
      const response = await fetch("/api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });

      if (!response.ok) {
        throw new Error("Submission failed");
      }

      setStatus("success");
      setMessage(
        "Thanks for reaching out. We'll review your note and reply by email within 2 business days. Corporate bookings may receive a Calendly link for faster scheduling.",
      );
      event.currentTarget.reset();
    } catch {
      setStatus("error");
      setMessage("Something went wrong. Email us directly at info@dreamstill.ca and we'll follow up.");
    }
  }

  return (
    <form onSubmit={handleSubmit} className="premium-card rounded-[3rem] p-6 md:p-8">
      <div className="grid gap-5 md:grid-cols-2">
        <label className="grid gap-2 text-sm font-medium text-[#34322d]">
          Name
          <input
            name="name"
            required
            className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
            placeholder="Your name"
          />
        </label>
        <label className="grid gap-2 text-sm font-medium text-[#34322d]">
          Email
          <input
            name="email"
            type="email"
            required
            className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
            placeholder="you@example.com"
          />
        </label>
      </div>
      <label className="mt-5 grid gap-2 text-sm font-medium text-[#34322d]">
        Organization (optional)
        <input
          name="organization"
          className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
          placeholder="Company, city, or group"
        />
      </label>
      <label className="mt-5 grid gap-2 text-sm font-medium text-[#34322d]">
        Inquiry type
        <select
          name="interest"
          defaultValue={defaultInterest}
          className="rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
        >
          {inquiryOptions.map((option) => (
            <option key={option} value={option}>
              {option}
            </option>
          ))}
        </select>
      </label>
      <label className="mt-5 grid gap-2 text-sm font-medium text-[#34322d]">
        Message
        <textarea
          name="message"
          required
          className="min-h-36 rounded-2xl border border-[#20201d]/10 bg-white/65 px-4 py-3 outline-none transition focus:border-[#8da18f]"
          placeholder="Tell us what you're building, booking, or exploring."
        />
      </label>
      <button
        type="submit"
        disabled={status === "loading"}
        className="mt-6 w-full rounded-full bg-[#20201d] px-6 py-4 text-sm font-semibold text-[#fffaf1] transition hover:-translate-y-0.5 hover:bg-[#34322d] disabled:opacity-60"
      >
        {status === "loading" ? "Sending..." : submitLabel}
      </button>
      <p className="mt-4 text-center text-xs leading-5 text-[#625e55]">{siteResponseCopy(status, message)}</p>
    </form>
  );
}

function siteResponseCopy(status: "idle" | "loading" | "success" | "error", message: string) {
  if (message) {
    return message;
  }
  if (status === "idle") {
    return "After you submit, our team reviews your note and follows up by email. Prefer to book directly? Use the Calendly link on this page.";
  }
  return "";
}
