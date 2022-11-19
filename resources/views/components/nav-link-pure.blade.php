@props(['active'])

@php
$link_classes = $active
    ? 'nav-link px-2 text-secondary'
    : 'nav-link px-2 text-white';
@endphp

<li class="nav-item">
    @if($active)
        <span class="{{ $link_classes }}">{{ $slot }}</span>
    @else
        <a {{ $attributes->merge(['class' => $link_classes]) }}>{{ $slot }}</a>
    @endif
</li>
