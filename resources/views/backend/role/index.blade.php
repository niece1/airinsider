@extends('layouts.dashboard')

@section('title', 'Role List')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Role List</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		<a href="/dashboard/roles/create" class="button">Add Role</a>
		<div class="well">
			<div class="well-title">
				<h5>Role List</h5>
			</div>

			<div class="well-content">

				<table>
					<tr>
						<th>ID</th>						
						<th>Title</th>
						<th>Permissions</th>	
						<th></th>					
					</tr>
					@foreach ($roles as $role)
					<tr>
						<td>{{ $role->id }}</td>						
						<td>{{ $role->title }}</td>
						<th></th>
						<td><a href="/dashboard/roles/{{ $role->id }}/edit" class="action-button-green">Edit</a>
							<form action="{{ route('roles.destroy', $role->id) }}" method="post">
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