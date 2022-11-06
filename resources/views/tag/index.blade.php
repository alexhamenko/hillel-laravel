@section('title', __('custom.page_type', ['type' => 'tag']))

<x-layout>
    @php $headings = [
        '#',
        __('custom.headings.title'),
        __('custom.headings.slug'),
        __('custom.headings.posts'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$headings">
        @forelse($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <th>
                    @foreach($tag->posts as $post)
                        <a href="{{ route('admin.post.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
                    @endforeach
                </th>
                <td class="d-grid gap-2">
                    <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}" class="btn btn-primary">{{ __('custom.action.show') }}</a>
                    <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}" class="btn btn-success">{{ __('custom.action.update') }}</a>
                    <a href="{{ route('admin.tag.delete', ['id' => $tag->id]) }}" class="btn btn-danger">{{ __('custom.action.delete') }}</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">{{ __('custom.not_found', ['type' => 'tags']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    {{ $tags->onEachSide(1)->links() }}

    <a href="{{ route('admin.tag.create') }}" class="btn btn-primary">{{ __('custom.action.create_type', ['type' => 'tag']) }}</a>
</x-layout>
