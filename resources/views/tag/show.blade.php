@section('title', __('custom.tag_type', ['type' => $tag->title]))

<x-layout.main>
    <h1 class="text-center my-3">{{ __('custom.posts_type', ['type' => $tag->title]) }}</h1>

    <div class="row row-cols-3 g-4 mb-4">
        @forelse($tag->posts as $post)
            @include('particles.post-card', [
                'post' => $post,
                'showTags' => true,
                'showCategory' => true,
                'showAuthor' => true,
            ])
        @empty
            <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
        @endforelse
    </div>

    @include('particles.comment-form', [
        'actionRoute' => 'tag.add.comment',
        'actionId' => $tag->id,
        'comments' => $tag->comments,
    ])

    <a href="{{ route('tag') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'tags']) }}</a>
</x-layout.main>
