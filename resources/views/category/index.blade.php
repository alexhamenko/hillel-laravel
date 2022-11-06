@section('title', __('custom.page_type', ['type' => 'category']))

@push('styles')
    <style>
        .btn.btn-post:hover {
            cursor: default;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endpush

<x-layout>
    @php $headings = [
        '#',
        __('custom.headings.title'),
        __('custom.headings.slug'),
        __('custom.headings.posts'),
        __('custom.headings.actions'),
    ] @endphp
    <x-table-striped :headings="$headings">
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <th>
                    @foreach($category->posts as $post)
                        <div class="btn btn-primary btn-post d-inline-flex mb-2 me-2"
                             style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem;">
                            {{ $post->title }}
                            @if($category->id !== $defaultCategoryId)
                                <a href="/category/{{ $category->id }}/detachpost/{{ $post->id }}"
                                   class="btn btn-close ms-1"></a>
                            @endif
                        </div>
                    @endforeach
                </th>
                <td class="d-grid gap-2">
                    <a href="{{ route('admin.category.show', ['id' => $category->id]) }}" class="btn btn-primary">{{ __('custom.action.show') }}</a>
                    @if($category['id'] !== $defaultCategoryId)
                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-success">{{ __('custom.action.update') }}</a>
                        @if($category->posts()->count() > 0)
                        <div
                            class="d-grid gap-2"
                            data-bs-toggle="tooltip"
                            data-bs-title="Can't delete category related to posts"
                            data-bs-placement="left"
                        >
                            <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                               class="btn btn-danger disabled">{{ __('custom.action.delete') }}</a>
                        </div>
                        @else
                        <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}" class="btn btn-danger">{{ __('custom.action.delete') }}</a>

                        @endif
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headings) }}" style="text-align: center">{{ __('custom.not_found', ['type' => '$categories']) }}</td>
            </tr>
        @endforelse
    </x-table-striped>
    {{ $categories->onEachSide(1)->links() }}

    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{ __('custom.action.create_type', ['type' => 'category']) }}</a>
</x-layout>
