<aside class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark position-fixed vh-100" style="width: {{$sidebarWidth}}px;">
    <div class="d-flex align-items-center justify-content-between mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <a href="{{ route('home') }}" class="me-4">
            @include('particles.logo')
        </a>
        <span class="fs-4">{{ config('app.name') }}</span>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <x-nav-link-sidebar href="{{ route('admin.panel') }}"
                    :active="request()->routeIs('admin.panel', 'admin.panel.*')"
                    icon="speedometer2">
            {{ __('custom.headings.admin_panel') }}
        </x-nav-link-sidebar>
        <x-nav-link-sidebar href="{{ route('admin.post') }}"
                    :active="request()->routeIs('admin.post', 'admin.post.*')"
                    icon="journal-text">
            Edit posts
        </x-nav-link-sidebar>
        <x-nav-link-sidebar href="{{ route('admin.category') }}"
                    :active="request()->routeIs('admin.category', 'admin.category.*')"
                    icon="inboxes-fill">
            Edit categories
        </x-nav-link-sidebar>
        <x-nav-link-sidebar href="{{ route('admin.tag') }}"
                    :active="request()->routeIs('admin.tag', 'admin.tag.*')"
                    icon="tags">
            Edit tags
        </x-nav-link-sidebar>
        <x-nav-link-sidebar href="{{ route('admin.comment') }}"
                    :active="request()->routeIs('admin.comment', 'admin.comment.*')"
                    icon="chat-left-text">
            Edit comments
        </x-nav-link-sidebar>
    </ul>
    <hr>
    <div class="d-flex align-items-center">
        @include('particles.profile-dropdown')
        @include('particles.language-switcher')
    </div>
</aside>
