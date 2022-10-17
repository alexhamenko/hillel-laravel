@extends('layout')

@section('title', 'Home page')

@section('navigation')
    @include('particles.navigation', [
        'links' => [
            [
                'link' => '/',
                'name' => 'Home',
                'current' => false
            ],
            'Posts' => [
                [
                    'link' => '/post',
                    'name' => 'Active',
                    'current' => true
                ],
                [
                    'link' => '/post/trash',
                    'name' => 'Trashed',
                    'current' => false
                ]
            ],
            'Categories' => [
                [
                    'link' => '/category',
                    'name' => 'Active',
                    'current' => false
                ],
                [
                    'link' => '/category/trash',
                    'name' => 'Trashed',
                    'current' => false
                ]
            ],
            'Tags' => [
                [
                    'link' => '/tag',
                    'name' => 'Active',
                    'current' => false
                ],
                [
                    'link' => '/tag/trash',
                    'name' => 'Trashed',
                    'current' => false
                ]
            ],
        ]
    ])
@endsection

<x-layout>
    @isset($_SESSION['success'])
        <div class="alert alert-success" role="alert">{{$_SESSION['success']}}</div>
    @endisset
    @php
        unset($_SESSION['success']);
    @endphp
    <table class="table table-bordered table-striped align-middle">
        <thead>
        <tr class="table-success">
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Category</th>
            <th scope="col">User</th>
            <th scope="col">Updated At</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <th class="text-truncate" style="max-width: 300px;">{{ $post->body }}</th>
                <th>
                    <a href="/category/{{ $post->category->id }}/show">{{ $post->category->title }}</a>
                </th>
                <th>
                    <a href="/user/{{ $post->category->id }}/show">{{ $post->category->title }}</a>
                </th>
                <th>{{ $post->updated_at }}</th>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center">No posts found!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</x-layout>>
