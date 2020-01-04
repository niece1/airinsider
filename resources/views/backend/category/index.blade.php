@extends('layouts.dashboard')

@section('title', 'Category List')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Category List</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		<a href="/dashboard/categories/create" class="button">Add Category</a>
		<div class="well">
			<div class="well-title">
				<h5>Category List</h5>
			</div>

			<div class="well-content">

				<table>
					<tr>
						<th>ID</th>						
						<th>Title</th>	
						<th></th>					
					</tr>
					@foreach ($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						
						<td>{{ $category->title }}</td>
						
						<td><a href="/dashboard/categories/{{ $category->id }}/edit" class="action-button-green">Edit</a>
							<form action="{{ route('categories.destroy', $category->id) }}" method="post">
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

@endsection