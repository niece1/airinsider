@extends('layouts.dashboard')

@section('title', 'Edit: ' . $role->title)

@push('styles')

<!-- Select2 styles -->
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">

@endpush

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Edit Role</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/roles" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Edit Role</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="create-update" enctype="multipart/form-data">
                    @method('PATCH')
                    @include('/dashboard/role/includes.form')
                    <button type="submit" class="button">Save</button>
                    @csrf
                </form>	
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

@endsection

@push('scripts')

<!--Scripts -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.permission-select-for-role').select2();
});
</script>
<!-- /.Scripts -->

@endpush
