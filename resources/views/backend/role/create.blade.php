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
					@include('/backend/role/includes.form')
					<button type="submit" class="button">Submit</button>
					@csrf				
				</form>	

			</div>
		</div>
	</div>
</section>

@endsection