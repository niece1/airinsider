@extends('layouts.dashboard')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Post List</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        @can('post_create')
        <a href="/dashboard/posts/create" class="button">Add Post</a>
        @endcan
        <div class="well">
            <div class="well-title">
                <h5>Post List</h5>
            </div>
            <div class="well-content">
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
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>@if($post->photo)<img src="{{ asset('storage/'.$post->photo->path) }}" height="60" width="90" alt="Photo">@endif</td>
                        <td>
                            @can('post_view')
                            <a href="/dashboard/posts/{{ $post->id }}">{{ $post->title }}</a>
                            @endcan
                            @cannot('post_view')
                            <p>{{ $post->title }}</p>
                            @endcannot
                        </td>
                        <td>{{ $post->if_published }}</td>
                        <td>{{ $post->viewed }}</td>
                        <td>@if($post->category){{ $post->category->title }}@endif</td>
                        <td>
                            @can('post_edit')
                            <a href="/dashboard/posts/{{ $post->id }}/edit" class="action-button-green">Edit</a>
                            @endcan
                            @can('post_trash')
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">Trash</button>
                            </form>
                            @endcan
                        </td>
                    </tr>				
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts->links() }}
    </div>
</section>

@endsection
