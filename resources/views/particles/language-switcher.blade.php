<div class="btn-group ms-auto">
    @foreach($available_locales as $available_locale)
        @if($available_locale === $current_locale)
            <button class="btn btn-warning dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                {{ strtoupper($available_locale) }}
            </button>
        @endif
    @endforeach
    <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 100%">
        @foreach($available_locales as $available_locale)
            @if($available_locale !== $current_locale)
                <li><a class="dropdown-item" href="/language/{{ $available_locale }}">{{ strtoupper($available_locale) }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
