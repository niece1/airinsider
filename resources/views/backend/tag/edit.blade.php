@extends('layouts.dashboard')

@section('title', 'Edit tag: ' . $tag->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Edit Tag</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/tags" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Edit Tag</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('tags.update', $tag->id) }}" class="create-update" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    <div class="form-wrapper">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') ?? $tag->title }}" class="form-input" autofocus>
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
