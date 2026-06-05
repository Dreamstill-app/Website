import { NextResponse } from "next/server";
import { site } from "@/lib/site";

type ContactPayload = {
  name?: string;
  email?: string;
  organization?: string;
  interest?: string;
  message?: string;
};

export async function POST(request: Request) {
  const body = (await request.json()) as ContactPayload;
  const name = body.name?.trim();
  const email = body.email?.trim();
  const interest = body.interest?.trim() ?? "General inquiry";
  const message = body.message?.trim();

  if (!name || !email || !message) {
    return NextResponse.json({ error: "Missing required fields." }, { status: 400 });
  }

  const endpoint = process.env.CONTACT_WEBHOOK_URL;

  if (endpoint) {
    const webhookResponse = await fetch(endpoint, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        name,
        email,
        organization: body.organization?.trim() ?? "",
        interest,
        message,
        source: "dreamstill-website",
      }),
    });

    if (!webhookResponse.ok) {
      return NextResponse.json({ error: "Webhook delivery failed." }, { status: 502 });
    }
  } else {
    console.info("[contact]", { name, email, interest, organization: body.organization, message });
  }

  return NextResponse.json({
    ok: true,
    routedInterest: interest,
    fallbackEmail: site.email,
  });
}
