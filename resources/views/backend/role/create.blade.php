@extends('layouts.dashboard')

@section('title', 'Create role')

@push('styles')

<link href="{{ asset('css/select2.css') }}" rel="stylesheet">

@endpush

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Create Role</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/roles" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Create Role</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('roles.store') }}" method="POST" class="create-update" enctype="multipart/form-data">
                    @include('/backend/role/includes.form')
                    <button type="submit" class="button">Submit</button>
                    @csrf				
                </form>	
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.permission-select-for-role').select2();
});
</script>

@endpush
