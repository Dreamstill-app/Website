import { NextResponse } from "next/server";

export async function POST(request: Request) {
  const body = (await request.json()) as { email?: string };
  const email = body.email?.trim();

  if (!email) {
    return NextResponse.json({ error: "Email is required." }, { status: 400 });
  }

  const endpoint = process.env.NEWSLETTER_WEBHOOK_URL;

  if (endpoint) {
    const webhookResponse = await fetch(endpoint, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, source: "dreamstill-newsletter" }),
    });

    if (!webhookResponse.ok) {
      return NextResponse.json({ error: "Webhook delivery failed." }, { status: 502 });
    }
  } else {
    console.info("[newsletter]", email);
  }

  return NextResponse.json({ ok: true });
}
