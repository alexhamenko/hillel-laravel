@section('title', __('custom.page_type', ['type' => 'posts']))

<x-layout.admin>
    @php $headings = [
        '#',
        __('custom.headings.title'),
        __('custom.headings.body'),
        __('custom.headings.category'),
        __('custom.headings.tags'),
        __('custom.headings.author'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$headings">
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td class="text-truncate" style="max-width: 300px;">{{ $post->body }}</td>
                <td>
                    <a href="{{ route('admin.category.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
                </td>
                <td>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}">{{ $tag->title }}</a>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('author.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                </td>
                <td class="d-grid gap-2">
                    <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary">{{ __('custom.action.view_front') }}</a>
                    @can('view', $post)
                    <a href="{{ route('admin.post.show', ['id' => $post->id]) }}"
                       class="btn btn-info">{{ __('custom.action.show') }}</a>
                    @endcan
                    @can('update', $post)
                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}"
                           class="btn btn-success">{{ __('custom.action.update') }}</a>
                    @endcan
                    @can('delete', $post)
                        <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}"
                           class="btn btn-danger">{{ __('custom.action.delete') }}</a>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}"
                    style="text-align: center">{{ __('custom.not_found', ['type' => 'posts']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    {{ $posts->onEachSide(1)->links() }}

    @can('create', \App\Models\Post::class)
        <a href="{{ route('admin.post.create') }}"
           class="btn btn-primary">{{ __('custom.action.create_type', ['type' => 'post']) }}</a>
    @endcan
</x-layout.admin>
