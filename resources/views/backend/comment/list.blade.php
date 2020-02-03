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
						<td>{{ $comment->user->name }}</td>						
						<td>@if($comment->post)
							    {{ $comment->post->title }}
						    @endif</td>						
						<td>{{ $comment->body }}</td>
						<td></td>
						<td>
							<form action="{{ route('comments.destroy', $comment->id) }}" method="post">
								@method('DELETE')
								@csrf
								<button type="submit" class="action-button-red" onsubmit="return confirm('Delete comment?')">Delete</button>
							</form>
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
		{{ $comments->links() }}
	</div>
</section>

@endsection