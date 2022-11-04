@section('title', "$author->name")

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => 'Home',
                'current' => false
            ]
        ]
    ])
@endsection

<x-layout>
    <h1 class="text-center my-3">{{ $author->name . ' posts' }}</h1>
    @php $headings = ['#', 'Title', 'Body', 'Author\'s posts in category', 'Updated At'] @endphp
    <x-table-striped :headings="$headings">
        @forelse($author->posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <th class="text-truncate" style="max-width: 300px;">{{ $post->body }}</th>
                <th class="d-flex justify-content-between">
                    <a href="/author/{{ $post->user->id }}/category/{{ $post->category->id }}">{{ $post->category->title }}</a>
                </th>
                <th>{{ $post->updated_at->format('Y-m-d') }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
    </x-table-striped>
</x-layout>
