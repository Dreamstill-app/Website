<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — Sorty by DreamStill</title>
    <style>
        :root { color-scheme: light; }
        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #faf9ff;
            color: #2d2a3e;
            line-height: 1.65;
        }
        .hero {
            background: linear-gradient(135deg, #6C63FF, #9D97FF);
            color: #fff;
            padding: 48px 24px 40px;
            text-align: center;
        }
        .hero h1 { margin: 0 0 6px; font-size: 1.9rem; }
        .hero p { margin: 0; opacity: 0.85; font-size: 0.95rem; }
        main {
            max-width: 760px;
            margin: -20px auto 60px;
            background: #fff;
            border-radius: 16px;
            padding: 36px 40px;
            box-shadow: 0 10px 40px rgba(40, 30, 90, 0.08);
        }
        main h1 { display: none; } /* doc title duplicated in hero */
        main h2, main h3 { color: #1d1a2e; margin-top: 1.8em; }
        main a { color: #6C63FF; }
        footer { text-align: center; padding-bottom: 40px; font-size: 0.85rem; color: #8a86a0; }
        footer a { color: #6C63FF; text-decoration: none; }
        @media (max-width: 640px) { main { padding: 24px 20px; margin-inline: 12px; } }
    </style>
</head>
<body>
    <div class="hero">
        <h1>{{ $title }}</h1>
        <p>Sorty by DreamStill Technologies · Vancouver, BC</p>
    </div>
    <main>
        {!! $content !!}
    </main>
    <footer>
        <a href="{{ route('legal.terms') }}">Terms &amp; Conditions</a> ·
        <a href="{{ route('legal.privacy') }}">Privacy Policy</a> ·
        <a href="{{ route('home') }}">dreamstill.ca</a>
    </footer>
</body>
</html>
