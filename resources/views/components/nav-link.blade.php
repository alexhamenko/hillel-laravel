@props(['active'])

@php
$classes = $active
    ? 'nav-link active'
    : 'nav-link'

@endphp

<li class="nav-item">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>