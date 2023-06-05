@extends('layouts.dashboard')

@section('title', 'Posts')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Posts</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('create', \App\Models\Post::class)
        <a href="/dashboard/posts/create" class="button">Add Post</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Post List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Viewed</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                    @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @if ($post->photo)
                            <img src="{{ Storage::url($post->photo->path) }}" height="50" width="100"
                                 alt="{{ $post->title }}">
                            @endif
                        </td>
                        <td>
                            @can('view', \App\Models\Post::class)
                            <a href="/dashboard/posts/{{ $post->id }}" title="{{ $post->title }}">
                                {{ $post->title }}
                            </a>
                            @endcan
                            @cannot('view', \App\Models\Post::class)
                            <p>{{ $post->title }}</p>
                            @endcannot
                        </td>
                        <td>{{ $post->if_published }}</td>
                        <td>{{ $post->viewed }}</td>
                        <td>
                            @if ($post->category)
                            {{ $post->category->title }}
                            @endif
                        </td>
                        <td>
                            @can('update', $post)
                            <a href="/dashboard/posts/{{ $post->id }}/edit" class="action-button-green">
                                Edit
                            </a>
                            @endcan
                            @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">
                                    Trash
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No posts found</td>
                    </tr>
                    @endforelse
                </table>
                <!-- /.Table -->
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

<!-- Pagination -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">{{ $posts->links('vendor.pagination.default') }}</div>
</section>
<!-- /.Pagination -->

@endsection
