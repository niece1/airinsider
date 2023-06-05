@extends('layouts.dashboard')

@section('title', 'Comments')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Comments</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <div class="well">
            <div class="well-title">
                <h5>Comments List</h5>
            </div>
            <div class="well-content">
                <!-- Table -->
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>User</th>
                        <th>Post</th>	
                        <th>Comment</th>
                        <th>Reply</th>	
                        <th></th>				
                    </tr>
                    @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>						
                        <td>
                            @if ($comment->user)
                            {{ $comment->user->name }}
                            @endif
                        </td>						
                        <td>
                            @if ($comment->post)
                            {{ $comment->post->title }}
                            @endif
                        </td>						
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->if_reply }}</td>
                        <td>
                            @can('delete', \App\Models\Comment::class)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete comment?')">
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
                        <td colspan="6">No comments found</td>
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
    <div class="news-pagination-wrapper">{{ $comments->links() }}</div>
</section>
<!-- /.Pagination -->

@endsection
