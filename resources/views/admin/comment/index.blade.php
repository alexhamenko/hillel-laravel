@section('title', 'Comments page')

<x-layout.admin>
    @php $headings = [
        '#',
        __('custom.headings.body'),
        __('custom.headings.author'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$headings">
        @forelse($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->body }}</td>
                <td>
                    <a href="{{ route('author.show', ['id' => $comment->user_id]) }}">{{ $comment->user->name }}</a>
                </td>
                <td class="d-grid gap-2">
                    @if($comment->commentable instanceof \App\Models\Category)
                        @php $route = 'category.show' @endphp
                    @elseif($comment->commentable instanceof \App\Models\Post)
                        @php $route = 'post.show' @endphp
                    @elseif($comment->commentable instanceof \App\Models\Tag)
                        @php $route = 'tag.show' @endphp
                    @endif

                    <a href="{{ route($route, ['id' => $comment->commentable_id]) }}" class="btn btn-primary">
                        {{ __('custom.action.view_front') }}
                    </a>
                    @can('delete', $comment)
                        <a href="{{ route('admin.comment.delete', ['id' => $comment->id]) }}"
                           class="btn btn-danger">{{ __('custom.action.delete') }}</a>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}"
                    style="text-align: center">{{ __('custom.not_found', ['type' => 'tags']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    {{ $comments->onEachSide(1)->links() }}
</x-layout.admin>
