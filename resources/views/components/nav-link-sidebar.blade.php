@props(['active', 'icon'])

@php
$link_classes = $active
    ? 'nav-link text-white d-flex active'
    : 'nav-link text-white d-flex';

$nav_icon = $icon ?? 'bi-link';
@endphp

<li class="nav-item">
    @if($active)
        <div class="{{ $link_classes }}">
            <i class="bi bi-{{ $nav_icon }} d-flex justify-content-center me-2" style="font-size: 1.5rem;"></i>
            {{ $slot }}
        </div>
    @else
        <a {{ $attributes->merge(['class' => $link_classes]) }}>
            <i class="bi bi-{{ $nav_icon }} d-flex justify-content-center me-2" style="font-size: 1.5rem;"></i>
            {{ $slot }}
        </a>
    @endif
</li>
