@section('title', 'User Profile')

<x-layout.admin>
    <h1 class="text-center my-3">User Profile</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item">{{ __('custom.headings.name') }}: {{ $user->name }}</li>
        <li class="list-group-item">{{ __('custom.headings.email') }}:
            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        </li>
        <li class="list-group-item">Role: {{ $user->role_name }}</li>
    </ul>
    <h2 class="text-center">My posts</h2>
    @php $postsTableHeadings = [
        '#',
        __('custom.headings.title'),
        __('custom.headings.body'),
        __('custom.headings.category'),
        __('custom.headings.tags'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$postsTableHeadings">
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <a href="{{ route('admin.category.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
                </td>
                <td>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}">{{ $tag->title }}</a>
                    @endforeach
                </td>
                <td class="d-grid gap-2">
                    <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary">{{ __('custom.action.view_front') }}</a>
                    <a href="{{ route('admin.post.show', ['id' => $post->id]) }}" class="btn btn-info">{{ __('custom.action.show') }}</a>
                    <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="btn btn-success">{{ __('custom.action.update') }}</a>
                    <a href="{{ route('admin.post.delete', ['id' => $post->id]) }}" class="btn btn-danger">{{ __('custom.action.delete') }}</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($postsTableHeadings) }}" style="text-align: center">{{ __('custom.not_found', ['type' => 'posts']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>

    <div class="post-pagination">
        {{ $posts->appends(['comments' => $comments->currentPage()])->links() }}
    </div>

    <h2 class="text-center">My comments</h2>
    @php $commentsTableHeadings = [
        '#',
        __('custom.headings.body'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$commentsTableHeadings">
        @forelse($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->body }}</td>
                <td class="d-grid gap-2">
                    @if($comment->commentable instanceof \App\Models\Category)
                        @php $route = 'category.show' @endphp
                    @elseif($comment->commentable instanceof \App\Models\Post)
                        @php $route = 'post.show' @endphp
                    @elseif($comment->commentable instanceof \App\Models\Tag)
                        @php $route = 'tag.show' @endphp
                    @endif

                    <a href="{{ route($route, ['id' => $comment->commentable_id]) }}" class="btn btn-primary">
                        View on front
                    </a>
                    <a href="{{ route('admin.comment.delete', ['id' => $comment->id]) }}"
                       class="btn btn-danger">{{ __('custom.action.delete') }}</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($commentsTableHeadings) }}"
                    style="text-align: center">{{ __('custom.not_found', ['type' => 'tags']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    <div class="comment-pagination">
        {{ $comments->appends(['posts' => $posts->currentPage()])->links() }}
    </div>
</x-layout.admin>
