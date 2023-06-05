@extends('layouts.dashboard')

@section('title', 'Trash')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Trash</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">	
        <a href="/dashboard/posts" class="back">To posts</a>
        <div class="well">
            <div class="well-title">
                <h5>Trashed Post List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Deleted</th>
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
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->deleted_at }}</td>
                        <td>{{ $post->viewed }}</td>
                        <td>
                            @if ($post->category)
                            {{ $post->category->title }}
                            @endif
                        </td>
                        <td>
                            @can('restore', \App\Models\Post::class)
                            <form action="{{ route('trash.restore', $post->id) }}" method="POST">							
                                @csrf
                                <button type="submit" class="action-button-green">
                                    Restore
                                </button>
                            </form>
                            @endcan
                            @can('forceDelete', \App\Models\Post::class)
                            <form action="{{ route('trash.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete post?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="action-button-red">
                                    Delete
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

@endsection
