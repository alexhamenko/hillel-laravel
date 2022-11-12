<div class="col">
    <div class="card text-center h-100">
        <div class="card-header">
            <h5 class="card-title">
                <a href="{{ route('post.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
            </h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush h-100">
                <li class="list-group-item h-100">
                    <p class="card-text">{{ $post->body }}</p>
                </li>
                @if($showTags)
                    <li class="list-group-item" style="z-index: 2">
                        @foreach($post->tags as $tag)
                            <a class="badge rounded-pill bg-primary text-decoration-none d-inline-flex justify-content-between align-items-center"
                               href="{{ route('tag.show', ['id' => $tag->id]) }}">
                                <i class="bi bi-hash pe-1"></i> {{ $tag->title }}
                            </a>
                        @endforeach
                    </li>
                @endif
            </ul>
        </div>

        @if($showCategory || $showAuthor)
            @php
                $width = $showCategory && $showAuthor ? 'w-50' : 'w-100';
            @endphp
            <div class="card-footer d-flex" style="z-index: 2">
                @if($showCategory)
                    <small class="text-muted px-2 {{ $width }}">
                        {{ __('custom.headings.category') }} <br>
                        <a href="{{ route('category.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
                    </small>
                @endif
                @if($showCategory && $showAuthor)
                    <div class="vr"></div>
                @endif
                @if($showAuthor)
                    <small class="text-muted px-2 {{ $width }}">
                        {{ __('custom.headings.author') }} <br>
                        <a href="{{ route('author.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                    </small>
                @endif
            </div>
        @endif
    </div>
</div>
