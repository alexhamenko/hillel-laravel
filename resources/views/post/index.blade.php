@section('title', 'Home page')

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => 'Home',
                'current' => true
            ]
        ]
    ])
@endsection

<x-layout>
    @php $headings = ['#', 'Title', 'Body', 'Category', 'Author', 'Updated At'] @endphp
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
                    <a href="/author/{{ $post->user->id }}">{{ $post->user->name }}</a>
                </td>
                <td>{{ $post->updated_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
    </x-table-striped>
</x-layout>>
