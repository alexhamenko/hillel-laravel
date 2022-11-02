@section('title', "$tag->title tag")

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
    <h1 class="text-center my-3">{{ $tag->title . ' posts' }}</h1>
    @php $headings = ['#', 'Title', 'Body', 'Updated At'] @endphp
    <x-table-striped :headings="$headings">
        @forelse($tag->posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <th class="text-truncate" style="max-width: 300px;">{{ $post->body }}</th>
                <th>{{ $post->updated_at->format('Y-m-d') }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
    </x-table-striped>
</x-layout>>
