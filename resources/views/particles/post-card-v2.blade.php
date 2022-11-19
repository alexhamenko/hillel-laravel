@push('styles')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
    </style>
@endpush
<div class="col">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            @if($showCategory)
                <a href="{{ route('category.show', ['id' => $post->category->id]) }}" style="z-index: 2;">
                    <strong class="d-inline-block mb-2 text-{{ $category_color ?? 'primary' }}">{{ $post->category->title }}</strong>
                </a>
            @endif
            <h3 class="mb-0">{{ $post->title }}</h3>
            <div class="mb-1 text-muted">{{ $post->created_at->format('M n') }}</div>
            <p class="card-text mb-auto">{{ Str::limit($post->body, 80, '...') }}</p>
            <div class="my-3" style="z-index: 2">
                @foreach($post->tags as $tag)
                    <a class="badge rounded-pill bg-primary text-decoration-none d-inline-flex justify-content-between align-items-center"
                       href="{{ route('tag.show', ['id' => $tag->id]) }}">
                        <i class="bi bi-hash pe-1"></i> {{ $tag->title }}
                    </a>
                @endforeach
            </div>
            <a href="{{ route('post.show', ['id' => $post->id]) }}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <svg class="bd-placeholder-img" width="200" height="320" xmlns="http://www.w3.org/2000/svg" role="img"
                 aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>
                    Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c"></rect>
                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>

        </div>
    </div>
</div>
