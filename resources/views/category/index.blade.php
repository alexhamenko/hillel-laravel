@section('title', __('custom.page_type', ['type' => 'category']))

<x-layout.main>
    @forelse($categories as $category)
        <div class="d-flex justify-content-between mb-3">
            <h2 class="mb-0">{{ $category->title }} latest posts</h2>
            <a href="{{ route('category.show', ['id' => $category->id]) }}"
               class="btn btn-primary ">View all</a>
        </div>
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
    @empty
        <p>{{ __('custom.not_found', ['type' => 'categories']) }}</p>
    @endforelse
    {{ $categories->onEachSide(1)->links() }}

</x-layout.main>
