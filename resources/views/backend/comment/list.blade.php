@extends('layouts.dashboard')

@section('title', 'Comments List')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Comments List</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        <div class="well">
            <div class="well-title">
                <h5>Comments List</h5>
            </div>
            <div class="well-content">
                <table>
                    <tr>
                        <th>ID</th>						
                        <th>User</th>
                        <th>Post</th>	
                        <th>Comment</th>
                        <th>Reply</th>	
                        <th></th>				
                    </tr>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>						
                        <td>
                            @if($comment->user)
                            {{ $comment->user->name }}
                            @endif
                        </td>						
                        <td>
                            @if($comment->post)
                            {{ $comment->post->title }}
                            @endif
                        </td>						
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->if_reply }}</td>
                        <td>
                            @can('comment_delete')
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
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

<section class="news-pagination">
    <div class="news-pagination-wrapper">{{ $comments->links() }}</div>
</section>

@endsection
