@extends('layouts.dashboard')

@section('title', 'Edit user: ' . $user->name)

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Edit User</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		
		<div class="well">
			<div class="well-title">
				<h5>Edit User</h5>
			</div>

			<div class="well-content">

				<form action="{{ route('users.update', $user->id) }}" class="create-update" method="post" enctype="multipart/form-data">
					@method('PATCH')
					<div class="form-wrapper">
						<label for="title">Title</label>
						<input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-input" readonly>
					</div>

					<div class="form-wrapper">
						<p class="attach-role">Attach role</p>
						@foreach($roles as $role)
						<label class="checkbox-container">{{ $role->title }}
						<input class="checkbox" type="checkbox" name="role_id[]" value="{{ $role->id }}"{{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : ''}}>
						<span class="checkmark"></span>
						</label><br>
						@endforeach
					</div>
					<button type="submit" class="button">Save</button>
					@csrf				
				</form>	

			</div>
		</div>
	</div>
</section>

@endsection