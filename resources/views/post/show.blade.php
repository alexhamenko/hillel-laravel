@section('title', __('custom.page_type', ['type' => $post->title]))

<x-layout>
    <h1>{{ $post->title }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item">{{ __('custom.headings.body') }}: {{ $post->body }}</li>
        <li class="list-group-item">{{ __('custom.headings.category') }}:
            <a href="{{ route('admin.category.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
        </li>
        <li class="list-group-item">{{ __('custom.headings.tags') }}:
            @foreach($post->tags as $tag)
                <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}">{{ $tag->title }}</a>
            @endforeach
        </li>
        <li class="list-group-item">{{ __('custom.headings.author') }}:
            <a href="{{ route('admin.author.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
        </li>
        <li class="list-group-item">{{ __('custom.headings.created_at') }}: {{ $post->created_at }}</li>
        <li class="list-group-item">{{ __('custom.headings.updated_at') }}: {{ $post->updated_at }}</li>
    </ul>
    <a href="{{ route('admin.post') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'posts']) }}</a>
</x-layout>

