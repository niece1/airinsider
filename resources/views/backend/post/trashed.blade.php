@extends('layouts.dashboard')

@section('title', 'Trashed posts')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Trashed</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">	
		<a href="/dashboard/posts" class="back">Back</a>	
		<div class="well">
			<div class="well-title">
				<h5>Trashed Post List</h5>
			</div>
			<div class="well-content">
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
					@foreach ($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>@if($post->photo)<img src="{{ asset('storage/'.$post->photo->path) }}" height="60" width="90" alt="Photo">@endif</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->deleted_at }}</td>
						<td>{{ $post->viewed }}</td>
						<td>{{ $post->category->title }}</td>
						<td>
							<form action="{{ route('restore', $post->id) }}" method="post">							
							@csrf
							<button type="submit" class="action-button-green">Restore</button>
						</form>
						<form action="{{ route('expunge', $post->id) }}" method="post" onsubmit="return confirm('Delete post?')">
							@method('DELETE')
							@csrf
							<button type="submit" class="action-button-red">Delete</button>
						</form>
						<!--Modal-->

					</td>
				</tr>

				@endforeach
			</table>

		</div>
	</div>
</div>
</section>



@endsection