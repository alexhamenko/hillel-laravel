@section('title', __('custom.page_type', ['type' => $post->title]))

<x-layout.main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('F n, Y') }} by
                            <a href="{{ route('author.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                        </div>
                    </header>
                    <figure class="mb-4"><img class="img-fluid rounded"
                                              src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..."></figure>
                    <section class="mb-5">{{ $post->body }}</section>
                </article>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">Tags</div>
                    <div class="card-body" style="column-count: 2;">
                        @foreach($post->tags as $tag)
                            <a class="d-block w-50" href="{{ route('tag.show', ['id' => $tag->id]) }}">
                                {{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to
                        use, and feature the Bootstrap 5 card component!
                    </div>
                </div>
            </div>
        </div>
    </div>


    <a href="{{ route('post') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'posts']) }}</a>
</x-layout.main>

