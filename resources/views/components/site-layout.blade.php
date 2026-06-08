@props([
    'pageTitle' => null,
    'metaDescription' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
])

@php
    $pageTitle = $pageTitle ?? config('app.name', 'DreamStill CMS');
@endphp

@include('layouts.site', [
    'pageTitle' => $pageTitle,
    'metaDescription' => $metaDescription,
    'ogTitle' => $ogTitle,
    'ogDescription' => $ogDescription,
    'ogImage' => $ogImage,
    'slot' => $slot,
])
