@section('title', "$author->name posts in $category->title category")

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
    <h1 class="text-center my-3">{{ $author->name . ' posts in ' . $category->title . ' category' }}</h1>
    @php $headings = ['#', 'Title', 'Body', 'Tags', 'Updated At'] @endphp
    <x-table-striped :headings="$headings">
        @forelse($posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <th class="text-truncate" style="max-width: 300px;">{{ $post->body }}</th>
                <td>
                    @foreach($post->tags as $tag)
                        <a href="/author/{{ $post->user->id }}/category/{{ $post->category->id }}/tag/{{ $tag->id }}">{{ $tag->title }}</a>
                    @endforeach
                </td>
                <th>{{ $post->updated_at->format('Y-m-d') }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
    </x-table-striped>
</x-layout>
