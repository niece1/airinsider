@extends('layouts.dashboard')

@section('title', 'Create Tag')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Create Tag</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/tags" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Create Tag</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('tags.store') }}" method="POST" class="create-update" enctype="multipart/form-data">
                    <div class="form-wrapper">
                    @include('/dashboard/tag/includes.form')
                    <button type="submit" class="button">Save</button>
                    @csrf				
                </form>	
            </div>
        </div>
    </div>
</section>
<!-- /.Dashboard -->

@endsection
