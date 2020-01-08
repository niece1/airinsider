@extends('layouts.dashboard')

@section('title', 'Edit role: ' . $role->title)

@push('styles')

<link href="{{ asset('css/select2.css') }}" rel="stylesheet">

@endpush

@section('content')

<section class="title-jumbotron">
	<div class="parallax-text">
		<h1>Edit Role</h1>
	</div>
</section>

<section class="dashboard">

	<div class="dashboard-wrapper">
		
		<div class="well">
			<div class="well-title">
				<h5>Edit Role</h5>
			</div>

			<div class="well-content">

				<form action="{{ route('roles.update', $role->id) }}" class="create-update" method="post" enctype="multipart/form-data">
					@method('PATCH')
					@include('/backend/role/includes.form')
					<button type="submit" class="button">Save</button>				
				</form>	

			</div>
		</div>
	</div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.permission-select-for-role').select2();
});
</script>
@endpush