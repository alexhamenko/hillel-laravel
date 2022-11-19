<footer class="bg-dark text-white py-3 mt-auto border-top">
    <div class="container">
        <div class="wrapper d-flex flex-wrap justify-content-between align-items-center">
            <p class="col-md-5 mb-0">© {{ now()->year }} Company, Inc</p>

            <a href="{{ route('home') }}">
                @include('particles.logo', [
                    'width' => 30,
                    'height' => 30,
                ])
            </a>

            <ul class="nav col-md-5 justify-content-end">
                <x-nav-link-pure href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('custom.headings.home') }}
                </x-nav-link-pure>
                <x-nav-link-pure href="{{ route('post') }}" :active="request()->routeIs('post', 'post.*')">
                    {{ __('custom.headings.posts') }}
                </x-nav-link-pure>
                <x-nav-link-pure href="{{ route('category') }}" :active="request()->routeIs('category', 'category.*')">
                    {{ __('custom.headings.categories') }}
                </x-nav-link-pure>
                <x-nav-link-pure href="{{ route('tag') }}" :active="request()->routeIs('tag', 'tag.*')">
                    {{ __('custom.headings.tags') }}
                </x-nav-link-pure>
                <x-nav-link-pure href="{{ route('author') }}" :active="request()->routeIs('author', 'author.*')">
                    {{ __('custom.headings.authors') }}
                </x-nav-link-pure>
                @can('access-paid-functionality')
                    <x-nav-link-pure href="{{ route('paid.functionality') }}" :active="request()->routeIs('paid.functionality')">
                        {{ __('custom.headings.paid_functionality') }}
                    </x-nav-link-pure>
                @endcan
            </ul>
        </div>
    </div>
</footer>
