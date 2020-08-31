@extends('layouts.dashboard')

@section('title', 'Edit category: ' . $category->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Edit Category</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/categories" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Edit Category</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" class="create-update" enctype="multipart/form-data">
                    @method('PATCH')
                    <div class="form-wrapper">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') ?? $category->title }}" class="form-input" autofocus>
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
