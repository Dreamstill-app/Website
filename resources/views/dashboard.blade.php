<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">DreamStill Admin</p>
                <h2 class="text-2xl font-semibold text-stone-900">Quick access</h2>
            </div>
            <a href="{{ url('/admin/pages') }}" class="inline-flex items-center rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-amber-500 hover:text-stone-950">
                Open pages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <section class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
                <h3 class="text-3xl font-semibold text-stone-900">You're signed in.</h3>
                <p class="mt-4 text-base leading-7 text-stone-600">
                    Use the admin panel to manage pages, site settings, and submissions.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ url('/admin/pages') }}" class="inline-flex items-center rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-amber-500 hover:text-stone-950">
                        Manage pages
                    </a>
                    <a href="{{ url('/admin') }}" class="inline-flex items-center rounded-full border border-stone-300 px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-stone-900 transition hover:border-amber-500 hover:text-amber-700">
                        Open admin home
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
