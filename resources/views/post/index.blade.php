@section('title', __('custom.page_type', ['type' => 'posts']))

<x-layout.main>
    <div class="row row-cols-2 g-4 my-3">
        @forelse($posts as $post)

            @include('particles.post-card-v2', [
                'post' => $post,
                'showCategory' => true,
            ])

        @empty
            <p>{{ __('custom.not_found', ['type' => 'posts']) }}</p>
        @endforelse
    </div>

    {{ $posts->onEachSide(1)->links() }}

</x-layout.main>
