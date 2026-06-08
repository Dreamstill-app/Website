<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">DreamStill CMS</p>
                <h2 class="text-2xl font-semibold text-stone-900">Website admin</h2>
            </div>
            <a href="{{ url('/admin') }}" class="inline-flex items-center rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-amber-500 hover:text-stone-950">
                Open admin panel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[1.4fr_1fr] lg:px-8">
            <section class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Current progress</p>
                <h3 class="mt-3 text-3xl font-semibold text-stone-900">Laravel admin foundation is now active.</h3>
                <p class="mt-4 max-w-2xl text-base leading-7 text-stone-600">
                    This project is being migrated from static HTML into a Laravel-powered website and CMS so pages,
                    settings, and future APIs can all be managed from one backend.
                </p>
                <div class="mt-8 grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl bg-stone-50 p-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-stone-500">Auth</p>
                        <p class="mt-2 text-lg font-semibold text-stone-900">Breeze login ready</p>
                    </article>
                    <article class="rounded-2xl bg-stone-50 p-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-stone-500">Admin</p>
                        <p class="mt-2 text-lg font-semibold text-stone-900">Filament installed</p>
                    </article>
                    <article class="rounded-2xl bg-stone-50 p-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-stone-500">Frontend</p>
                        <p class="mt-2 text-lg font-semibold text-stone-900">DreamStill assets copied</p>
                    </article>
                </div>
            </section>

            <aside class="rounded-3xl border border-stone-200 bg-stone-900 p-8 text-white shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-300">Next milestones</p>
                <ol class="mt-4 space-y-4 text-sm leading-6 text-stone-200">
                    <li>1. Replace placeholder public landing page with the DreamStill site shell.</li>
                    <li>2. Add database models for pages, sections, settings, and submissions.</li>
                    <li>3. Build admin resources for editing and creating pages.</li>
                    <li>4. Add API endpoints for future Flutter consumption.</li>
                </ol>
            </aside>
        </div>
    </div>
</x-app-layout>
