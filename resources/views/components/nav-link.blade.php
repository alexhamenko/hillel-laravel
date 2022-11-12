@props(['active', 'icon'])

@php
$link_classes = $active
    ? 'nav-link pb-0 pt-3 text-secondary'
    : 'nav-link pb-0 pt-3 text-white';

$nav_icon = $icon ?? 'bi-link';
@endphp

<li>
    @if($active)
        <div class="{{ $link_classes }}">
            <i class="bi bi-{{ $nav_icon }} d-flex justify-content-center" style="font-size: 1.5rem;"></i>
            {{ $slot }}
        </div>
    @else
        <a {{ $attributes->merge(['class' => $link_classes]) }}>
            <i class="bi bi-{{ $nav_icon }} d-flex justify-content-center" style="font-size: 1.5rem;"></i>
            {{ $slot }}
        </a>
    @endif
</li>
