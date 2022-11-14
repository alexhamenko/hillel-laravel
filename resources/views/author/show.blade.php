@section('title', "$author->name")

<x-layout.main>
    <h1 class="text-center my-3">{{ $author->name . ' posts' }}</h1>
    <div class="row row-cols-3 g-4 mb-4">
        @forelse($author->posts as $post)
            @include('particles.post-card', [
                'post' => $post,
                'showTags' => true,
                'showCategory' => true,
                'showAuthor' => false,
            ])
        @empty
            <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
        @endforelse
    </div>
    <a href="{{ route('author') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'authors']) }}</a>
</x-layout.main>
