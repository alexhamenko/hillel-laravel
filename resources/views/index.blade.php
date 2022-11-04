@section('title', 'Home page')

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => __('custom.headings.home'),
                'current' => true
            ],
            [
                'link' => '/post',
                'name' => __('custom.headings.posts'),
                'current' => false
            ],
            [
                'link' => '/tag',
                'name' => __('custom.headings.tags'),
                'current' => false
            ],
            [
                'link' => '/category',
                'name' => __('custom.headings.categories'),
                'current' => false
            ],
        ]
    ])
@endsection

<x-layout>
    <h1>{{ __('custom.this_page', ['type' => 'home']) }}</h1>
</x-layout>
