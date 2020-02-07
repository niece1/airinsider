@extends('layouts.dashboard')

@section('title', 'Create permission')

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Create Permission</h1>
	</div>
</section>

<section class="dashboard">
	<div class="dashboard-wrapper">
		<a href="/dashboard/permissions" class="back">Back</a>
		<div class="well">
			<div class="well-title">
				<h5>Create Permission</h5>
			</div>
			<div class="well-content">
				<form action="{{ route('permissions.store') }}" class="create-update" method="post" enctype="multipart/form-data">
					<div class="form-wrapper">
						<label for="title">Title</label>
						<input type="text" name="title" value="{{ old('title') }}" class="form-input" autofocus>
						<div class="form-error">{{ $errors->first('title') }}</div>
					</div>
					<button type="submit" class="button">Save</button>
					@csrf				
				</form>	
			</div>
		</div>
	</div>
</section>

@endsection