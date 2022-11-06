@section('title', __('custom.action.create_type', ['type' => 'post']))

<x-layout>
    <h1>{{ __('custom.action.create_type', ['type' => 'post']) }}</h1>
    <form action="{{ route('admin.post.store') }}" method="post" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('custom.headings.title') }}</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="{{ old('title') }}">
            @if($errors->has('title'))
                @foreach($errors->get('title') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">{{ __('custom.headings.body') }}</label>
            <textarea class="form-control"
                      id="body"
                      name="body"
                      rows="5">{{ old('body') }}</textarea>
            @if($errors->has('body'))
                @foreach($errors->get('body') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row g-2">
            <div class="col-md">
                <label for="category_id">{{ __('custom.action.select_type', ['type' => 'category']) }}</label>
                <select class="form-select" name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))`
                    @foreach($errors->get('category_id') as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endisset
            </div>
            <div class="col-md">
                <label for="tags">{{ __('custom.action.select_type', ['type' => 'tags']) }}</label>
                <select class="form-select" name="tags[]" id="tags" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    @foreach($errors->get('tags') as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('custom.action.submit') }}</button>
    </form>

    <a href="{{ route('admin.post') }}" class="btn btn-secondary">{{ __('custom.return_to_list', ['type' => 'posts']) }}<</a>
</x-layout>
