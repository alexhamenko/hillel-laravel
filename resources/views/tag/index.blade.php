@section('title', __('custom.page_type', ['type' => 'tag']))

<x-layout.main>
    @forelse($tags as $tag)
        <div class="d-flex justify-content-between mb-3">
            <h2 class="mb-0">{{ $tag->title }} latest posts</h2>
            <a href="{{ route('tag.show', ['id' => $tag->id]) }}"
               class="btn btn-primary ">View all</a>
        </div>
        <div class="row row-cols-3 g-4 mb-4">
            @forelse($tag->posts->take(3) as $post)
                @include('particles.post-card', [
                    'showTags' => true,
                    'showCategory' => true,
                    'showAuthor' => true,
                ])
            @empty
                <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
            @endforelse
        </div>
    @empty
        <p>{{ __('custom.not_found', ['type' => 'tags']) }}</p>
    @endforelse
    {{ $tags->onEachSide(1)->links() }}

</x-layout.main>
