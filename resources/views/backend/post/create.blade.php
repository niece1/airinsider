@extends('layouts.dashboard')

@section('title', 'Create post')

@push('styles')

<script src="https://cdn.tiny.cloud/1/9ypmvdehk28ku79envub5bb7sytgxc1udy8ixiq07axom6xb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: "link image",
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
</script>

@endpush

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Create Post</h1>
    </div>
</section>

<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/posts" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Create Post</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('posts.store') }}" method="POST" class="create-update" enctype="multipart/form-data">
                    @include('/backend/post/includes.form')
                    <button type="submit" class="button">Submit</button>				
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
        $('.tag-select-for-post').select2();
    });
</script>

@endpush
