@section('title', __('custom.category_type', ['type' => $category->title]))

<x-layout.main>
    <h1 class="text-center my-3">{{ __('custom.posts_type', ['type' => $category->title]) }}</h1>

    <div class="row row-cols-2 g-4 mb-4">
        @forelse($category->posts as $post)
            @include('particles.post-card-v2', [
                'post' => $post,
                'showCategory' => false,
            ])
        @empty
            <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
        @endforelse
    </div>
    <a href="{{ route('category') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'categories']) }}</a>
</x-layout.main>
