@section('title', 'Create post')

<x-layout>
    <h1>Create new post</h1>
    <form action="{{ route('admin.post.store') }}" method="post" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea type="text" class="form-control" id="body" name="body"
                      rows="5">{{$_SESSION['data']['body'] ?? '' }}</textarea>
        </div>
        <div class="row g-2">
            <div class="col-md">
                <label for="category_id">Select category</label>
                <select class="form-select" name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md">
                <label for="tags">Select tags</label>
                <select class="form-select" name="tags[]" id="tags" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <a href="{{ route('admin.post') }}" class="btn btn-secondary">Return to the posts list</a>
</x-layout>
