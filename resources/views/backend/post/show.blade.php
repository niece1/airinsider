@extends('layouts.dashboard')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>{{ $post->title }}</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		
		<div class="well">
			<div class="well-title">
				<h5>{{ $post->title }}</h5>
			</div>

			<div class="well-content">

				<table>
					<tr>
						<th>ID</th>
						<th>{{ $post->id }}</th>						
					</tr>
					<tr>
						<td>Title</td>
						<td>{{ $post->title }}</td>
					</tr>
					<tr>
						<td>Image</td>
						<td>@if($post->photo)<img src="{{ asset('storage/'.$post->photo->path) }}" height="60" width="90" alt="Photo">@endif</td>
					</tr>									
					<tr>
						<td>Body</td>
						<td>{{ strip_tags($post->body) }}</td>						
					</tr>
					<tr>
						<td>Slug</td>
						<td>{{ $post->slug }}</td>						
					</tr>
					<tr>
						<td>Published</td>
						<td>{{ $post->if_published }}</td>						
					</tr>
					<tr>
						<td>Viewed</td>
						<td>{{ $post->viewed }}</td>						
					</tr>
					<tr>
						<td>Time to read</td>
						<td>{{ $post->time_to_read }} min</td>						
					</tr>
					<tr>
						<td>User</td>
						<td>{{ $post->user->name }}</td>						
					</tr>
					<tr>
						<td>Category</td>
						<td>{{ $post->category->title }}</td>						
					</tr>	
						<!--	<form action="{{ route('posts.destroy', $post->id) }}" method="post">
								@method('DELETE')
								@csrf
								<button type="submit" class="action-button-red">Delete</button>
							</form>-->
				
				</table>

			</div>
		</div>
	</div>

</section>

@endsection