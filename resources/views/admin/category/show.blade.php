@section('title', __('custom.category_type', ['type' => $category->title]))

<x-layout.main>
    <h1 class="text-center my-3">{{ __('custom.posts_type', ['type' => $category->title]) }}</h1>
    @php $headings = [
        '#',
        __('custom.headings.title'),
        __('custom.headings.body'),
        __('custom.headings.updated_at')
    ] @endphp
    <x-table-striped :headings="$headings">
        @forelse($category->posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <th class="text-truncate" style="max-width: 300px;">{{ $post->body }}</th>
                <th>{{ $post->updated_at->format('Y-m-d') }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">{{ __('custom.not_found', ['type' => 'posts']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    <a href="{{ route('admin.category') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'categories']) }}</a>
</x-layout.main>
