<div class="btn-group ms-auto">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <button class="btn btn-primary btn-sm dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                {{ $locale_name }}
            </button>
        @endif
    @endforeach
    <ul class="dropdown-menu dropdown-menu-end p-0">
        @foreach($available_locales as $locale_name => $available_locale)
            @if($available_locale !== $current_locale)
                <li><a class="dropdown-item" href="/language/{{ $available_locale }}">{{ $locale_name }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
