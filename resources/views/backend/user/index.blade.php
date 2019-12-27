@extends('layouts.dashboard')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>User's List</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		<div class="well">
			<div class="well-title">
				<h5>User's List</h5>
			</div>

			<div class="well-content">

				<table>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Provider</th>
						<th>Created</th>
						<th>Updated</th>
						<th></th>
					</tr>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>@if($user->provider){{ $user->provider }}@endif</td>
						<td>{{ $user->created_at }}</td>
						<td>{{ $user->updated_at }}</td>
						<td>
							<form action="{{ route('users.destroy', $user->id) }}" method="post">
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