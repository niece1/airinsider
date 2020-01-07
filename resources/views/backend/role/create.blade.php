@extends('layouts.dashboard')

@section('title', 'Create role')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Create Role</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		
		<div class="well">
			<div class="well-title">
				<h5>Create Role</h5>
			</div>

			<div class="well-content">

				<form action="{{ route('roles.store') }}" class="create-update" method="post" enctype="multipart/form-data">
					<div class="form-wrapper">
						<label for="title">Title</label>
						<input type="text" name="title" value="{{ old('title') }}" class="form-input" autofocus>
						<div class="form-error">{{ $errors->first('title') }}</div>
					</div>
					<button type="submit" class="button">Submit</button>
					@csrf				
				</form>	

			</div>
		</div>
	</div>
</section>

@endsection