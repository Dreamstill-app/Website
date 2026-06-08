@extends('layouts.site-page')

<x-site-layout :page-title="$page['title']">

@section('content')
<div class="top-ribbon">DreamStill CMS migration • Laravel backend in progress • Public route reserved</div>
    <header class="site-header">
        <div class="site-shell nav-card">
            <a class="brand" href="{{ url('/') }}" aria-label="DreamStill home">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="DreamStill Technologies">
            </a>
            <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="main-navigation">Menu</button>
            <nav class="nav-links" id="main-navigation" data-nav-links aria-label="Main menu">
                <a href="{{ url('/') }}">Home</a>
                <a class="{{ $slug === 'about' ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                <a class="{{ $slug === 'app' ? 'active' : '' }}" href="{{ url('/app') }}">App</a>
                <a class="{{ $slug === 'portfolio' ? 'active' : '' }}" href="{{ url('/portfolio') }}">Experiences</a>
            </nav>
            <a class="button coral" href="{{ url('/contact') }}">Let's talk</a>
        </div>
    </header>

    <main>
        <section class="site-shell section" data-reveal="up">
            <div class="section-heading" data-reveal="up">
                <span class="eyebrow">Page migration</span>
                <h1>{{ $page['heading'] }}</h1>
                <p>{{ $page['summary'] }}</p>
            </div>
            <div class="grid two" data-reveal-group>
                <article class="card solution-card" data-reveal-item>
                    <span class="eyebrow">What is live now</span>
                    <h3>Laravel routing and shared frontend shell</h3>
                    <p>This route already runs through the new Laravel app, uses the DreamStill public assets, and is ready to be connected to editable database content.</p>
                </article>
                <article class="card solution-card" data-reveal-item>
                    <span class="eyebrow">What comes next</span>
                    <h3>Admin-managed sections</h3>
                    <p>This page will be rebuilt as structured, reusable sections so it can be edited from the new admin panel without touching raw HTML files.</p>
                </article>
            </div>
        </section>
    </main>
</x-site-layout>
@endsection
