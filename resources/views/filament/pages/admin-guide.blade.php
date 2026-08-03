<x-filament-panels::page>
    <div class="prose prose-sm dark:prose-invert max-w-4xl space-y-8 [&_h2]:mt-8 [&_h2]:text-lg [&_h2]:font-bold [&_h3]:font-semibold [&_table]:text-sm">

        <div class="rounded-xl bg-primary-50 dark:bg-primary-950/40 p-4 text-sm">
            <strong>This panel is the control room for two things:</strong> the DreamStill website (CMS) and the
            Sorty mobile app. Everything you edit here appears live — on dreamstill.ca or inside the app —
            without touching code. Only accounts with the <em>admin</em> role can log in here.
        </div>

        <section>
            <h2>📊 Dashboard</h2>
            <p>
                Live metrics from the Sorty platform, refreshed every 30 seconds. <strong>Garments sorted</strong>
                counts every AI-analyzed item; <strong>Textiles diverted</strong> and <strong>GHG avoided</strong>
                are computed from the sort decisions using DreamStill's impact factors (avg. 0.5&nbsp;kg per garment;
                CO₂e factors per pathway). The <strong>decision-split donut</strong> shows where garments are routed,
                and the <strong>activity line</strong> shows sorting volume over the last 30 days.
                <em>Use this screen in investor and municipal-partner conversations — it is the impact story, live.</em>
            </p>
        </section>

        <section>
            <h2>✨ Sorts (AI dataset)</h2>
            <p><strong>Where it comes from:</strong> every time an app user photographs a garment, the photos travel to
            our server, the vision AI (Azure gpt-5-mini) inspects them, and our decision tree issues a recommendation
            (Resell / Donate / Repair / Recycle) with plain-English reasons. That whole record lands here.</p>
            <ul>
                <li><strong>Read-only by design</strong> — this is the platform's dataset; admins observe, never edit.</li>
                <li>Click a row to see the photos, damages found, reasons, price estimate, and which engine ran
                    (<em>Vision AI</em> vs <em>Rules only</em> fallback).</li>
                <li><strong>User correction</strong> column: when a user rejects our recommendation and picks their own,
                    it's stored as a training label — this is how the AI improves over time.</li>
                <li><strong>Export dataset (CSV)</strong> (top-right of the list): pseudonymized export (no names/emails)
                    for machine-learning training and partner/municipal reporting.</li>
            </ul>
        </section>

        <section>
            <h2>📍 Partner Locations</h2>
            <p><strong>Used by:</strong> the app's map, the "Find Nearby Locations" step after each sort, and the
            chatbot's local recommendations (it only ever suggests locations from this list — it cannot invent one).</p>
            <ul>
                <li>Each location has a <strong>type</strong> — thrift, repair, donation, recycler, retail take-back —
                    and the app matches types to decisions (e.g. a "Repair" recommendation shows repair + tailors).</li>
                <li><strong>Lat/Lng</strong> drive the distance sorting; get coordinates from Google Maps (right-click →
                    "What's here?").</li>
                <li>Unpublish a location to remove it from the app instantly. <em>Verified at</em> records when you
                    last confirmed its details.</li>
                <li>Future: partner businesses will claim these listings through a paid self-service portal
                    (the <em>Partner user</em> field is reserved for that).</li>
            </ul>
        </section>

        <section>
            <h2>📅 Events</h2>
            <p><strong>Used by:</strong> the app's Community/Events pages and the chatbot ("what's happening this
            week?").</p>
            <ul>
                <li>Events you create here are <strong>approved</strong> immediately.</li>
                <li>App users can also submit events — those arrive with a yellow <strong>pending</strong> badge.
                    Review, then <strong>Approve</strong> (goes live in the app) or <strong>Reject</strong>.</li>
                <li>The <em>link</em> field points users to Eventbrite/Partiful/etc. when they tap the event.</li>
            </ul>
        </section>

        <section>
            <h2>🏆 Challenges</h2>
            <p><strong>Used by:</strong> the app's Challenges page — the gamification loop.</p>
            <ul>
                <li>A challenge has a <strong>metric</strong> (e.g. total sorts, or a specific decision like "repair 3
                    items"), a <strong>target</strong>, and <strong>points</strong> awarded on completion.</li>
                <li>Progress updates automatically whenever a user sorts a garment — no admin work needed.</li>
                <li>Points accumulate on the user's account and are spent on <strong>Rewards</strong> (below).</li>
                <li>Guests see challenges locked — a nudge to create an account.</li>
            </ul>
        </section>

        <section>
            <h2>💡 Facts</h2>
            <p><strong>Used by:</strong> the "Did you know?" banner on the app's home screen. Every tap serves a random
            published fact from this list. Keep each fact to one sentence; add the <em>source</em> and <em>year</em>
            fields so claims stay verifiable (UNEP, WRAP, Ellen MacArthur Foundation, etc.).</p>
        </section>

        <section>
            <h2>🎁 Rewards</h2>
            <p><strong>Used by:</strong> the app's Rewards section. Users spend challenge points to claim them.</p>
            <ul>
                <li>Create a reward with a <strong>points cost</strong>, optional <strong>stock</strong> (blank =
                    unlimited) and <strong>expiry</strong>. Example: "20% off at Hunter &amp; Hare — 250 points".</li>
                <li>When a user claims one, the platform emails <strong>info@dreamstill.ca</strong> with the user's
                    email and the reward, so you can fulfil it (send the code, notify the partner store).</li>
                <li>No published rewards = the app shows "coming soon".</li>
                <li>Guests cannot claim rewards.</li>
            </ul>
        </section>

        <section>
            <h2>💬 Community Tips</h2>
            <p><strong>Used by:</strong> the app's Community page, where users share clothing-care advice
            (optionally with a photo).</p>
            <ul>
                <li>Every submission is first screened by the <strong>AI moderator</strong>: clearly good tips publish
                    instantly; anything doubtful (or when the AI is unreachable) lands here as
                    <strong>pending</strong> for your judgement.</li>
                <li>Approve / Reject with one click; Delete removes it entirely. The <em>moderation note</em> shows
                    why the AI flagged something.</li>
            </ul>
        </section>

        <section>
            <h2>👥 Users</h2>
            <p>Every app account, including guests (is_guest). <strong>Role</strong> controls power:
            <em>user</em> (app only), <em>partner</em> (future portal), <em>admin</em> (this panel — grant carefully!).
            <em>Total points</em> is their challenge balance. Deleting a user soft-deletes for 30 days
            (privacy-law window) before permanent purge.</p>
        </section>

        <section>
            <h2>🌐 Website (CMS): Pages, Form Submissions, Site Settings</h2>
            <ul>
                <li><strong>Pages</strong> — the dreamstill.ca marketing site. Each page is built from sections you can
                    edit, reorder, and publish. The <em>investors</em> page lives here too.</li>
                <li><strong>Form Submissions</strong> — messages from the site's contact form and the app's
                    "Get Involved" form.</li>
                <li><strong>Site Settings</strong> — logo, header/footer, contact details, and the social links
                    (these also feed the app's "Follow Us" links).</li>
            </ul>
        </section>

        <section>
            <h2>🔄 How it all connects</h2>
            <table>
                <thead><tr><th>App user does…</th><th>Shows up here as…</th><th>You do…</th></tr></thead>
                <tbody>
                    <tr><td>Sorts a garment</td><td>New row in <strong>Sorts</strong> + dashboard numbers move</td><td>Nothing — observe &amp; export</td></tr>
                    <tr><td>Rejects the AI's advice</td><td><em>User correction</em> on the sort</td><td>Nothing — it trains the model</td></tr>
                    <tr><td>Submits an event</td><td><strong>Events</strong> → pending badge</td><td>Approve or reject</td></tr>
                    <tr><td>Shares a tip</td><td><strong>Community Tips</strong> (auto-published or pending)</td><td>Review pending ones</td></tr>
                    <tr><td>Claims a reward</td><td><strong>Rewards</strong> claim + email to info@</td><td>Fulfil the reward</td></tr>
                    <tr><td>Completes a challenge</td><td>Points on their <strong>Users</strong> row</td><td>Nothing — automatic</td></tr>
                    <tr><td>Asks the chatbot for places</td><td>—</td><td>Keep <strong>Partner Locations</strong> accurate</td></tr>
                </tbody>
            </table>
        </section>

        <section>
            <h2>🆘 If something looks wrong</h2>
            <ul>
                <li>API health check: <a href="https://dreamstill.ca/api/v1/health" target="_blank">dreamstill.ca/api/v1/health</a>
                    — all three checks should say <code>true</code>.</li>
                <li>"Engine: Rules only" on new sorts means the vision AI was unreachable — the app kept working via
                    the built-in decision rules; check the Azure OpenAI service and keys.</li>
                <li>Pending reviews stat on the Dashboard tells you when events/tips are waiting.</li>
            </ul>
        </section>

    </div>
</x-filament-panels::page>
