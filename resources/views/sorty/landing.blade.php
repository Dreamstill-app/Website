<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sorty — AI clothing sorting by DreamStill</title>
    <meta name="description" content="Photograph a garment and Sorty's AI tells you whether to resell, donate, repair, or recycle it — with real drop-off spots near you. Free, in your browser.">
    <meta property="og:title" content="Sorty — every garment deserves a next best life">
    <meta property="og:description" content="AI clothing sorting by DreamStill Technologies. Try it live in your browser.">
    <meta property="og:url" content="{{ url('/sorty') }}">
    <link rel="icon" type="image/png" href="{{ asset('app-demo/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --purple: #6C63FF;
            --purple-light: #9D97FF;
            --orange: #D4762C;
            --ink: #17142A;
            --ink-2: #1F1B33;
            --text: #F2F1F7;
            --text-dim: #B7B3C7;
            --text-faint: #837F96;
            --green: #4ade80;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background:
                radial-gradient(900px 600px at 85% -10%, rgba(108, 99, 255, 0.28), transparent 60%),
                radial-gradient(700px 500px at -10% 40%, rgba(212, 118, 44, 0.12), transparent 55%),
                linear-gradient(160deg, var(--ink) 0%, var(--ink-2) 60%, var(--ink) 100%);
            color: var(--text);
            min-height: 100vh;
        }
        .shell { max-width: 1180px; margin: 0 auto; padding: 0 28px; }

        /* --- Nav --- */
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 26px 0;
        }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand .word {
            font-size: 1.35rem; font-weight: 800; color: #fff; letter-spacing: 0.5px;
        }
        .brand .word em { font-style: normal; color: var(--orange); }
        .brand .sub { font-size: 0.62rem; color: var(--text-faint); letter-spacing: 2.5px; text-transform: uppercase; }
        .nav-links { display: flex; gap: 26px; align-items: center; }
        .nav-links a { color: var(--text-dim); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: #fff; }
        .btn {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 13px 26px; border-radius: 14px; text-decoration: none;
            font-weight: 600; font-size: 0.95rem; transition: transform 0.18s, box-shadow 0.18s;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--purple), var(--purple-light));
            color: #fff; box-shadow: 0 10px 30px rgba(108, 99, 255, 0.35);
        }
        .btn-primary:hover { box-shadow: 0 16px 40px rgba(108, 99, 255, 0.5); }
        .btn-ghost {
            background: rgba(255,255,255,0.06); color: var(--text);
            border: 1px solid rgba(255,255,255,0.14);
        }

        /* --- Hero --- */
        .hero {
            display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 48px;
            align-items: center; padding: 40px 0 80px;
        }
        .badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(108, 99, 255, 0.14); border: 1px solid rgba(108, 99, 255, 0.35);
            color: var(--purple-light); font-size: 0.8rem; font-weight: 600;
            padding: 7px 14px; border-radius: 999px; margin-bottom: 22px;
        }
        .badge .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); box-shadow: 0 0 10px var(--green); animation: pulse 2s infinite; }
        @keyframes pulse { 50% { opacity: 0.4; } }
        h1 { font-size: 3.1rem; line-height: 1.14; font-weight: 800; letter-spacing: -0.5px; }
        h1 .accent {
            background: linear-gradient(90deg, var(--purple-light), #C9C5FF);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
        .hero p.lede { color: var(--text-dim); font-size: 1.06rem; line-height: 1.65; margin: 20px 0 26px; max-width: 30rem; }
        .checks { list-style: none; margin-bottom: 32px; }
        .checks li { display: flex; gap: 12px; align-items: flex-start; color: var(--text-dim); font-size: 0.95rem; margin-bottom: 12px; }
        .checks .tick {
            flex: 0 0 auto; width: 22px; height: 22px; border-radius: 50%;
            background: rgba(74, 222, 128, 0.15); color: var(--green);
            display: grid; place-items: center; font-size: 0.75rem; font-weight: 700; margin-top: 1px;
        }
        .cta-row { display: flex; gap: 14px; flex-wrap: wrap; }
        .cta-note { margin-top: 14px; color: var(--text-faint); font-size: 0.8rem; }

        /* --- Phone --- */
        .phone-wrap { display: flex; justify-content: center; }
        .phone {
            width: 392px; height: 800px; padding: 12px;
            background: #100e1c; border-radius: 46px;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 40px 90px rgba(0,0,0,0.55), 0 0 80px rgba(108,99,255,0.22);
            position: relative;
        }
        .phone iframe {
            width: 100%; height: 100%; border: 0; border-radius: 36px; background: #F8F9FE;
        }
        .phone .notch {
            position: absolute; top: 22px; left: 50%; transform: translateX(-50%);
            width: 110px; height: 24px; background: #100e1c; border-radius: 999px; z-index: 2;
        }
        .phone-caption { text-align: center; margin-top: 16px; color: var(--text-faint); font-size: 0.8rem; }

        /* --- Sections --- */
        section { padding: 72px 0; }
        .kicker { color: var(--purple-light); font-size: 0.8rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 12px; }
        h2 { font-size: 2rem; font-weight: 700; margin-bottom: 14px; }
        .section-lede { color: var(--text-dim); max-width: 40rem; line-height: 1.65; margin-bottom: 40px; }

        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .card {
            background: rgba(255,255,255,0.045); border: 1px solid rgba(255,255,255,0.09);
            border-radius: 20px; padding: 26px; transition: transform 0.2s, border-color 0.2s;
        }
        .card:hover { transform: translateY(-4px); border-color: rgba(108,99,255,0.45); }
        .card .ico {
            width: 46px; height: 46px; border-radius: 13px; display: grid; place-items: center;
            font-size: 1.3rem; margin-bottom: 16px;
            background: linear-gradient(135deg, rgba(108,99,255,0.25), rgba(157,151,255,0.12));
        }
        .card h3 { font-size: 1.05rem; font-weight: 600; margin-bottom: 8px; }
        .card p { color: var(--text-dim); font-size: 0.88rem; line-height: 1.6; }

        /* Steps */
        .steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; counter-reset: step; }
        .step { position: relative; padding: 26px; border-radius: 20px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); }
        .step .num {
            font-size: 2.6rem; font-weight: 800; line-height: 1;
            background: linear-gradient(135deg, var(--purple), var(--purple-light));
            -webkit-background-clip: text; background-clip: text; color: transparent;
            margin-bottom: 14px;
        }
        .step h3 { font-size: 1.02rem; margin-bottom: 8px; }
        .step p { color: var(--text-dim); font-size: 0.88rem; line-height: 1.6; }

        /* Impact */
        .impact {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
            background: linear-gradient(135deg, rgba(108,99,255,0.16), rgba(157,151,255,0.06));
            border: 1px solid rgba(108,99,255,0.3); border-radius: 24px; padding: 40px;
        }
        .impact .stat { text-align: center; }
        .impact .val { font-size: 2.4rem; font-weight: 800; color: #fff; }
        .impact .lbl { color: var(--text-dim); font-size: 0.85rem; margin-top: 4px; }

        /* Partners */
        .partners {
            display: grid; grid-template-columns: 1fr auto; gap: 30px; align-items: center;
            background: rgba(212, 118, 44, 0.08); border: 1px solid rgba(212, 118, 44, 0.28);
            border-radius: 24px; padding: 40px;
        }
        .partners h2 { margin-bottom: 8px; }
        .partners p { color: var(--text-dim); max-width: 36rem; line-height: 1.6; }
        .btn-orange { background: linear-gradient(135deg, var(--orange), #E89B5C); color: #fff; box-shadow: 0 10px 30px rgba(212,118,44,0.3); }

        /* Footer */
        footer { border-top: 1px solid rgba(255,255,255,0.08); margin-top: 40px; padding: 56px 0 0; }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr 1.2fr; gap: 36px; padding-bottom: 44px; }
        .footer-grid h4 { font-size: 0.85rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-faint); margin-bottom: 16px; }
        .footer-grid a { display: block; color: var(--text-dim); text-decoration: none; font-size: 0.9rem; margin-bottom: 10px; transition: color 0.2s; }
        .footer-grid a:hover { color: #fff; }
        .footer-grid p { color: var(--text-dim); font-size: 0.88rem; line-height: 1.65; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08); padding: 22px 0 30px;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
            color: var(--text-faint); font-size: 0.82rem;
        }
        .footer-bottom a { color: var(--purple-light); text-decoration: none; font-weight: 600; }
        .footer-bottom a:hover { text-decoration: underline; }

        /* Reveal animation */
        [data-reveal] { opacity: 0; transform: translateY(26px); transition: opacity 0.7s ease, transform 0.7s ease; }
        [data-reveal].in { opacity: 1; transform: none; }

        @media (max-width: 980px) {
            .hero { grid-template-columns: 1fr; }
            .phone-wrap { order: -1; }
            .phone { width: 340px; height: 700px; }
            .grid-3, .steps, .impact { grid-template-columns: 1fr; }
            .partners { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            h1 { font-size: 2.3rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <!-- ============ NAV ============ -->
        <nav class="nav">
            <a class="brand" href="{{ url('/') }}">
                <div>
                    <div class="word">dream<em>s</em>till</div>
                    <div class="sub">Technologies</div>
                </div>
            </a>
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="#features">Features</a>
                <a href="#how">How it works</a>
                <a href="#partners">Partners</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </div>
            <a class="btn btn-primary" href="{{ url('/demo') }}">Open Sorty ↗</a>
        </nav>

        <!-- ============ HERO ============ -->
        <header class="hero">
            <div>
                <span class="badge"><span class="dot"></span> Live in your browser — no install needed</span>
                <h1>Every garment deserves a <span class="accent">next best life.</span></h1>
                <p class="lede">
                    Photograph any piece of clothing and Sorty's AI tells you — in seconds and in plain
                    English — whether to <strong>resell, donate, repair, or recycle</strong> it, what it's
                    worth, and exactly where to take it near you.
                </p>
                <ul class="checks">
                    <li><span class="tick">✓</span> AI condition assessment with explainable, auditable reasoning</li>
                    <li><span class="tick">✓</span> Real resale, repair, donation &amp; recycling spots across Metro Vancouver</li>
                    <li><span class="tick">✓</span> Track the kilograms you divert and the CO₂e you save</li>
                    <li><span class="tick">✓</span> Free for everyone — challenges, rewards &amp; community included</li>
                </ul>
                <div class="cta-row">
                    <a class="btn btn-primary" href="{{ url('/demo') }}">Try Sorty now — it's free</a>
                    <a class="btn btn-ghost" href="{{ url('/demo') }}">📲 Install the web app</a>
                </div>
                <p class="cta-note">Works on any phone or laptop. To install: open Sorty → Profile → “Install the app”. iOS &amp; Android store apps coming soon.</p>
            </div>
            <div class="phone-wrap" data-reveal>
                <div>
                    <div class="phone">
                        <div class="notch"></div>
                        <iframe src="{{ url('/app-demo/index.html') }}" title="Sorty app — live" loading="lazy"></iframe>
                    </div>
                    <p class="phone-caption">▲ This is the real app, live — go ahead, try it</p>
                </div>
            </div>
        </header>

        <!-- ============ FEATURES ============ -->
        <section id="features">
            <p class="kicker" data-reveal>What Sorty does</p>
            <h2 data-reveal>A personal assistant for your unwanted clothes</h2>
            <p class="section-lede" data-reveal>85% of textiles end up in landfill — most of them could have had another life. Sorty makes the responsible choice the easy choice.</p>
            <div class="grid-3">
                <div class="card" data-reveal>
                    <div class="ico">🧠</div>
                    <h3>AI vision analysis</h3>
                    <p>Snap front &amp; back photos. Frontier vision AI inspects fabric, damage, brand tags and condition — no forms, no guesswork.</p>
                </div>
                <div class="card" data-reveal>
                    <div class="ico">🧭</div>
                    <h3>Explainable decisions</h3>
                    <p>Every recommendation comes with plain-English reasons from our published decision framework — auditable, never a black box.</p>
                </div>
                <div class="card" data-reveal>
                    <div class="ico">💰</div>
                    <h3>Resale value estimates</h3>
                    <p>Brand-aware price bands tell you what an item could fetch on Poshmark, Depop and consignment before you decide.</p>
                </div>
                <div class="card" data-reveal>
                    <div class="ico">📍</div>
                    <h3>Real local drop-offs</h3>
                    <p>Verified thrift, repair, donation, recycling and take-back locations, distance-sorted from wherever you are.</p>
                </div>
                <div class="card" data-reveal>
                    <div class="ico">💬</div>
                    <h3>Ask anything</h3>
                    <p>A streaming AI assistant answers repair, care, resale and donation questions — even from a photo of the garment.</p>
                </div>
                <div class="card" data-reveal>
                    <div class="ico">🏆</div>
                    <h3>Challenges &amp; rewards</h3>
                    <p>Earn points for sorting responsibly and redeem them for perks at local circular businesses.</p>
                </div>
            </div>
        </section>

        <!-- ============ HOW IT WORKS ============ -->
        <section id="how">
            <p class="kicker" data-reveal>How it works</p>
            <h2 data-reveal>Three steps to a clear conscience closet</h2>
            <div class="steps" style="margin-top: 28px;">
                <div class="step" data-reveal>
                    <div class="num">01</div>
                    <h3>Photograph it</h3>
                    <p>Front and back photos — add the brand tag if you want a sharper price estimate.</p>
                </div>
                <div class="step" data-reveal>
                    <div class="num">02</div>
                    <h3>AI assesses it</h3>
                    <p>Condition score, damage detection, brand read, and a resale value band — in seconds.</p>
                </div>
                <div class="step" data-reveal>
                    <div class="num">03</div>
                    <h3>Give it a next life</h3>
                    <p>Resell, donate, repair, or recycle — with the best nearby spots mapped for a single trip.</p>
                </div>
            </div>
        </section>

        <!-- ============ LIVE IMPACT ============ -->
        <section>
            <p class="kicker" data-reveal>Live from the platform</p>
            <h2 data-reveal>Impact, counted in real time</h2>
            <div class="impact" style="margin-top: 28px;" data-reveal>
                <div class="stat"><div class="val" id="stat-sorts">—</div><div class="lbl">garments assessed by our AI</div></div>
                <div class="stat"><div class="val" id="stat-kg">—</div><div class="lbl">kg of textiles diverted from landfill</div></div>
                <div class="stat"><div class="val" id="stat-ghg">—</div><div class="lbl">kg CO₂e avoided through circularity</div></div>
            </div>
        </section>

        <!-- ============ PARTNERS ============ -->
        <section id="partners">
            <div class="partners" data-reveal>
                <div>
                    <p class="kicker">For municipalities, retailers &amp; circular businesses</p>
                    <h2>The data layer for a working circular textile system</h2>
                    <p>
                        The consumer app stays free. Partners get diversion dashboards, aggregated behaviour
                        insights, take-back campaign tooling, and verified referrals to their locations.
                        DreamStill has diverted 2,500+ lbs of textiles through 40+ community events — Sorty
                        scales that impact.
                    </p>
                </div>
                <a class="btn btn-orange" href="{{ url('/contact') }}">Talk to DreamStill</a>
            </div>
        </section>

        <!-- ============ FOOTER ============ -->
        <footer>
            <div class="footer-grid">
                <div>
                    <div class="word" style="font-size: 1.2rem; font-weight: 800;">dream<em style="font-style: normal; color: var(--orange);">s</em>till</div>
                    <p style="margin-top: 12px;">
                        Vancouver-based, BIPOC female-led clean-tech leading the transition to circular
                        fashion through technology, community education, and grassroots climate action.
                    </p>
                </div>
                <div>
                    <h4>DreamStill</h4>
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('/about') }}">About</a>
                    <a href="{{ url('/portfolio') }}">Portfolio</a>
                    <a href="{{ url('/investors') }}">Investors</a>
                    <a href="{{ url('/contact') }}">Contact</a>
                </div>
                <div>
                    <h4>Sorty</h4>
                    <a href="{{ url('/demo') }}">Open the web app</a>
                    <a href="{{ url('/sorty') }}">About Sorty</a>
                    <a href="{{ url('/terms') }}">Terms &amp; Conditions</a>
                    <a href="{{ url('/privacy') }}">Privacy Policy</a>
                </div>
                <div>
                    <h4>Get in touch</h4>
                    <a href="mailto:info@dreamstill.ca">info&#64;dreamstill.ca</a>
                    <a href="tel:+17788888541">778-888-8541</a>
                    <p style="margin-top: 4px;">Vancouver, BC — on the traditional, ancestral, and unceded territories of the Musqueam, Squamish, and Tsleil-Waututh Nations.</p>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© {{ date('Y') }} DreamStill Technologies. All rights reserved.</span>
                <span>Powered by <a href="https://inputly.ai" target="_blank" rel="noopener">Inputly AI</a></span>
            </div>
        </footer>
    </div>

    <script>
        // Mobile visitors go straight into the app (client-side safety net
        // for the server-side UA redirect).
        if (window.innerWidth < 768) {
            window.location.replace('{{ url('/demo') }}');
        }

        // Reveal on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('in'); observer.unobserve(e.target); } });
        }, { threshold: 0.15 });
        document.querySelectorAll('[data-reveal]').forEach((el) => observer.observe(el));

        // Live impact counters from the platform API
        function countUp(el, target, decimals, suffix) {
            const start = performance.now();
            const dur = 1400;
            function tick(now) {
                const p = Math.min((now - start) / dur, 1);
                const eased = 1 - Math.pow(1 - p, 3);
                el.textContent = (target * eased).toFixed(decimals) + (suffix || '');
                if (p < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        }

        fetch('{{ url('/api/v1/impact/global') }}')
            .then((r) => r.json())
            .then(({ data }) => {
                const impactSection = document.querySelector('.impact');
                const fire = () => {
                    countUp(document.getElementById('stat-sorts'), data.sorts_total || 0, 0);
                    countUp(document.getElementById('stat-kg'), data.textiles_kg_diverted || 0, 1);
                    countUp(document.getElementById('stat-ghg'), data.ghg_kg_avoided || 0, 1);
                };
                const io = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) { fire(); io.disconnect(); }
                }, { threshold: 0.4 });
                io.observe(impactSection);
            })
            .catch(() => {});
    </script>
</body>
</html>
