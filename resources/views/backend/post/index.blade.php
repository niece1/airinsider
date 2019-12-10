@extends('layouts.dashboard')

@section('content')
<section class="dashboard">

	<section class="contact-jumbotron">
		<div class="parallax-text">
			<h1>Post List</h1>
		</div>
	</section>

	<div class="dashboard-wrapper">
		<a href="/posts/create" class="button">Add Post</a>
		<div class="well">
			<div class="well-title">
				<h5>Post List</h5>
			</div>

			<div class="well-table">

				<table>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Published</th>
						<th>Viewed</th>
						<th>Category</th>
						<th></th>
					</tr>
					@foreach ($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->published }}</td>
						<td>{{ $post->viewed }}</td>
						<td>{{ $post->category_id }}</td>
						<td><a href="/posts/{{ $post->id }}" class="action-button-blue">View</a>
							<a href="/posts/{{ $post->id }}/edit" class="action-button-green">Edit</a>
							<form action="/posts/{{ $post->id }}" method="post">
								@method('DELETE')
								@csrf
								<button type="submit" class="action-button-red">Delete</button>
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
		{{ $posts->links() }}
	</div>
</section>
@endsection