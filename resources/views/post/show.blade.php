@section('title', 'Posts page')

<x-layout>
    <h1>{{ $post->title }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item">Body: {{ $post->body }}</li>
        <li class="list-group-item">Category:
            <a href="{{ route('admin.category.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
        </li>
        <li class="list-group-item">Tags:
            @foreach($post->tags as $tag)
                <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}">{{ $tag->title }}</a>
            @endforeach
        </li>
        <li class="list-group-item">Created At: {{ $post->created_at }}</li>
        <li class="list-group-item">Updated At: {{ $post->updated_at }}</li>
    </ul>
    <a href="{{ route('admin.post') }}" class="btn btn-secondary">Return to the posts list</a>
</x-layout>>
