@extends('layouts.dashboard')

@section('title', $post_item->title)

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <div class="heading">Read more</div>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/posts/" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>{{ $post_item->title }}</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <td>ID</td>
                        <td>{{ $post_item->id }}</td>						
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $post_item->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $post_item->description }}</td>
                    </tr>								
                    <tr>
                        <td>Body</td>
                        <td class="table-body">{!! clean($post_item->body) !!}</td>						
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            @if ($post_item->photo)
                            <img src="{{ Storage::url($post_item->photo->path) }}" height="50" width="100"
                                 alt="{{ $post_item->title }}">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Photo source</td>
                        <td>{{ $post_item->photo_source }}</td>
                    </tr>
                    <tr>
                        <td>Slug</td>
                        <td>{{ $post_item->slug }}</td>						
                    </tr>
                    <tr>
                        <td>Published</td>
                        <td>{{ $post_item->if_published }}</td>						
                    </tr>
                    <tr>
                        <td>Viewed</td>
                        <td>{{ $post_item->viewed }}</td>						
                    </tr>
                    <tr>
                        <td>Time to read</td>
                        <td>{{ $post_item->time_to_read }} min</td>						
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>
                            @if ($post_item->user)
                            {{ $post_item->user->name }}
                            @endif
                        </td>						
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            @if ($post_item->category)
                            {{ $post_item->category->title }}
                            @endif
                        </td>						
                    </tr>
                    <tr>
                        <td>Tags</td>
                        <td>
                            @foreach ($post_item->tags as $tag)
                            <span class="badge">{{ $tag->title . " " }}</span>
                            @endforeach
                        </td>						
                    </tr>
                    <tr>
                        <td>Publish time</td>
                        <td>
                            {{ $post_item->publish_date_time }}
                        </td>						
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td>{{ $post_item->created_at }}</td>						
                    </tr>
                    <tr>
                        <td>Updated</td>
                        <td>{{ $post_item->updated_at }}</td>						
                    </tr>							
                </table>
                <!-- /.Table -->
            </div>
        </div>
        @can('delete', $post_item)
        <form action="{{ route('posts.destroy', $post_item->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="delete-show-page">Delete</button>
        </form>
        @endcan
    </div>
</section>
<!-- /.Dashboard -->

@endsection
