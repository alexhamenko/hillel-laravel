@section('title', __('custom.page_type', ['type' => 'author']))

<x-layout.main>
        @forelse($authors as $author)
            <div class="d-flex justify-content-between mb-3">
                <h2 class="mb-0">{{ $author->name }} latest posts</h2>
                <a href="{{ route('author.show', ['id' => $author->id]) }}"
                   class="btn btn-primary ">View all</a>
            </div>
            <div class="row row-cols-3 g-4 mb-4">
                @forelse($author->posts->take(3) as $post)
                    @include('particles.post-card', [
                        'showTags' => true,
                        'showCategory' => true,
                        'showAuthor' => false,
                    ])
                @empty
                    <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
                @endforelse
            </div>
        @empty
            <p>{{ __('custom.not_found', ['type' => 'authors']) }}</p>
        @endforelse

    {{ $authors->onEachSide(1)->links() }}

</x-layout.main>
