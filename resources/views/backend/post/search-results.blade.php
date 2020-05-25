@extends('layouts.dashboard')

@section('title', 'Search results')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Search results</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">		
        <div class="well">
            <div class="well-title">
                <h5>{{ $posts->count() }} result(s) for '{{ request()->input('keyword') }}'</h5>
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
                    @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>@if($post->photo)<img src="{{ asset('storage/'.$post->photo->path) }}" height="60" width="90" alt="Photo">@endif</td>
                        <td><a href="/dashboard/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                        <td>{{ $post->if_published }}</td>
                        <td>{{ $post->viewed }}</td>
                        <td>@if($post->category){{ $post->category->title }}@endif</td>
                        <td>
                            <a href="/dashboard/posts/{{ $post->id }}/edit" class="action-button-green">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">Trash</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No posts found</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
