<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @stack('styles')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10">
            <ul class="nav nav-tabs">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">{{ __('custom.headings.home') }}</x-nav-link>
                <x-nav-link href="{{ route('admin.post') }}" :active="request()->routeIs('admin.post')">{{ __('custom.headings.posts') }}</x-nav-link>
                <x-nav-link href="{{ route('admin.category') }}" :active="request()->routeIs('admin.category')">{{ __('custom.headings.categories') }}</x-nav-link>
                <x-nav-link href="{{ route('admin.tag') }}" :active="request()->routeIs('admin.tag')">{{ __('custom.headings.tags') }}</x-nav-link>
            </ul>
        </div>
        <div class="col-2 d-flex align-items-center">
            @include('particles/language-switcher')
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{ $slot }}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
