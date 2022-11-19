<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <form class="mb-4 d-flex align-items-start"
                  action="{{ route($actionRoute, ['id' => $actionId]) }}"
                  method="post">
                @csrf
                <textarea class="form-control me-5"
                          rows="3"
                          aria-label="Comment"
                          placeholder="Join the discussion and leave a comment!"
                          name="body"
                          id="body"></textarea>
                <button class="btn btn-primary text-nowrap" type="submit">{{ __('custom.action.add_type', ['type' => 'comment']) }}</button>
            </form>
            @forelse($comments as $comment)
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="...">
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold">{{$comment->user->name ?? 'Anonymous'}}</div>
                        {{ $comment->body }}
                    </div>
                </div>
            @empty
                <p>{{ __('custom.there_are_no_type', ['type' => 'comments']) }}</p>
            @endforelse
        </div>
    </div>
</section>
