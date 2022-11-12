<header class="p-3 bg-dark text-white fixed-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('home') }}" class="d-flex align-items-center mb-2 mb-lg-0 me-3 text-white text-decoration-none">
                @include('particles.logo')
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @auth
                    <x-nav-link href="{{ route('admin.panel') }}"
                                :active="request()->routeIs('admin.panel', 'admin.panel.*')"
                                icon="speedometer2">
                        {{ __('custom.headings.admin_panel') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.post') }}"
                                :active="request()->routeIs('admin.post', 'admin.post.*')"
                                icon="journal-text">
                        {{ __('custom.headings.posts') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.category') }}"
                                :active="request()->routeIs('admin.category', 'admin.category.*')"
                                icon="inboxes-fill">
                        {{ __('custom.headings.categories') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.tag') }}"
                                :active="request()->routeIs('admin.tag', 'admin.tag.*')"
                                icon="tags">
                        {{ __('custom.headings.tags') }}
                    </x-nav-link>
                @else
                    <x-nav-link href="{{ route('home') }}"
                                :active="request()->routeIs('home')"
                                icon="house-door">
                        {{ __('custom.headings.home') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('post') }}"
                                :active="request()->routeIs('post', 'post.*')"
                                icon="journal-text">
                        {{ __('custom.headings.posts') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('category') }}"
                                :active="request()->routeIs('category', 'category.*')"
                                icon="inboxes-fill">
                        {{ __('custom.headings.categories') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('tag') }}"
                                :active="request()->routeIs('tag', 'tag.*')"
                                icon="tags">
                        {{ __('custom.headings.tags') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('author') }}"
                                :active="request()->routeIs('author', 'author.*')"
                                icon="person-circle">
                        {{ __('custom.headings.authors') }}
                    </x-nav-link>
                @endauth
            </ul>

            <div class="text-end">
                @auth
                    <a href="{{ route('auth.logout') }}">
                        <button type="button" class="btn btn-outline-light me-2">{{ __('custom.headings.logout') }}</button>
                    </a>
                @else
                    <a href="{{ route('auth.login') }}">
                        <button type="button" class="btn btn-outline-light me-2">{{ __('custom.headings.login') }}</button>
                    </a>
                @endauth

                @include('particles.language-switcher')
            </div>
        </div>
    </div>
</header>
