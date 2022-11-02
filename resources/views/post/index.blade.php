@section('title', 'Posts page')

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => 'Home',
                'current' => false
            ],
            [
                'link' => '/post',
                'name' => 'Posts',
                'current' => true
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
    @php $headings = ['#', 'Title', 'Body', 'Category', 'Tags', 'Author', 'Actions'] @endphp
    <x-table-striped :headings="$headings">
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td class="text-truncate" style="max-width: 300px;">{{ $post->body }}</td>
                <td>
                    <a href="/category/{{ $post->category->id }}">{{ $post->category->title }}</a>
                </td>
                <td>
                    @foreach($post->tags as $tag)
                        <a href="/tag/{{ $tag->id }}">{{ $tag->title }}</a>
                    @endforeach
                </td>
                <td>
                    <a href="/author/{{ $post->user->id }}">{{ $post->user->name }}</a>
                </td>
                <td class="d-grid gap-2">
                    <a href="{{ route('admin.post.show', ['id' => $post->id]) }}" class="btn btn-primary">Show</a>
                    <a href="{{ route('admin.post.update') }}" class="btn btn-success">Update</a>
                    <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
    </x-table-striped>
    {{ $posts->onEachSide(1)->links() }}

    <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Create New Post</a>
</x-layout>
