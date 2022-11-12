<footer class="bg-dark text-white py-3 mt-auto border-top">
    <div class="container">
        <div class="wrapper d-flex flex-wrap justify-content-between align-items-center">
            <p class="col-md-4 mb-0">© {{ now()->year }} Company, Inc</p>

            <a href="{{ route('home') }}">
                @include('particles.logo', [
                    'width' => 30,
                    'height' => 30,
                ])
            </a>

            <ul class="nav col-md-4 justify-content-end">
                @auth
                    <li class="nav-item"><a href="{{ route('admin.panel') }}" class="nav-link px-2 text-white">{{ __('custom.headings.admin_panel') }}</a></li>
                    <li class="nav-item"><a href="{{ route('admin.post') }}" class="nav-link px-2 text-white">{{ __('custom.headings.posts') }}</a></li>
                    <li class="nav-item"><a href="{{ route('admin.category') }}" class="nav-link px-2 text-white">{{ __('custom.headings.categories') }}</a></li>
                    <li class="nav-item"><a href="{{ route('admin.tag') }}" class="nav-link px-2 text-white">{{ __('custom.headings.tags') }}</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-white">{{ __('custom.headings.home') }}</a></li>
                    <li class="nav-item"><a href="{{ route('post') }}" class="nav-link px-2 text-white">{{ __('custom.headings.posts') }}</a></li>
                    <li class="nav-item"><a href="{{ route('category') }}" class="nav-link px-2 text-white">{{ __('custom.headings.categories') }}</a></li>
                    <li class="nav-item"><a href="{{ route('tag') }}" class="nav-link px-2 text-white">{{ __('custom.headings.tags') }}</a></li>
                    <li class="nav-item"><a href="{{ route('author') }}" class="nav-link px-2 text-white">{{ __('custom.headings.authors') }}</a></li>
                @endauth
            </ul>
        </div>
    </div>
</footer>
