@section('title', 'Home page')

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => 'Home',
                'current' => true
            ],
            [
                'link' => '/post',
                'name' => 'Posts',
                'current' => false
            ],
            [
                'link' => '/tag',
                'name' => 'Tags',
                'current' => false
            ],
            [
                'link' => '/category',
                'name' => 'Categories',
                'current' => false
            ],
        ]
    ])
@endsection

<x-layout>
    <h1>This is Main Page!</h1>
</x-layout>>
