@section('title', __('custom.action.update_type', ['type' => 'tag']))

<x-layout>
    <h1>{{ __('custom.action.update_type', ['type' => 'tag']) }}</h1>
    <form action="{{ route('admin.tag.update') }}" method="post" class="mb-3">
        @csrf
        <input type="hidden" value="{{ $tag->id }}" name="id">
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('custom.headings.title') }}</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ $tag->title  }}">
            @if($errors->has('title'))
                @foreach($errors->get('title') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">{{ __('custom.headings.slug') }}</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $tag->slug  }}">
            @if($errors->has('slug'))
                @foreach($errors->get('slug') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="mb-3">
            <label for="posts">{{ __('custom.action.select_type', ['type' => 'posts']) }}</label>
            <select class="form-select" name="posts[]" id="posts" multiple>
                @foreach($posts as $post)
                    <option @selected(in_array($post->id, $tag->posts->pluck('id')->toArray())) value="{{$post->id}}">{{$post->title}}</option>
                @endforeach
            </select>
            @if($errors->has('posts'))
                @foreach($errors->get('posts') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <button type="submit" class="btn btn-primary">{{ __('custom.action.submit') }}</button>
    </form>

    <a href="{{ route('admin.tag') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'tags']) }}</a>
</x-layout>
