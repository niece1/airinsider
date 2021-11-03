@extends('layouts.dashboard')

@section('title', 'Create Post')

@push('styles')

<!--Scripts -->
<script src="https://cdn.tiny.cloud/1/9ypmvdehk28ku79envub5bb7sytgxc1udy8ixiq07axom6xb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: 'link autolink image lists emoticons',
        toolbar: 'numlist bullist emoticons link image',
        formats: {
            h1: { block: 'h1', styles: { 'font-weight': 'normal', 'font-size': '2.3rem' } },
            h2: { block: 'h2', styles: { 'font-weight': 'normal', 'font-size': '2.2rem' } },
            h3: { block: 'h3', styles: { 'font-weight': 'normal', 'font-size': '2.1rem' } },
            h4: { block: 'h4', styles: { 'font-weight': 'normal', 'font-size': '2rem' } },
            h5: { block: 'h5', styles: { 'font-weight': 'normal', 'font-size': '1.9rem' } },
            h6: { block: 'h6', styles: { 'font-weight': 'normal', 'font-size': '1.7rem' } },
        },
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
</script>
<!-- /.Scripts -->

@endpush

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Create Post</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Dashboard -->
<section class="dashboard">
    <div class="dashboard-wrapper">
        <a href="/dashboard/posts" class="back">Back</a>
        <div class="well">
            <div class="well-title">
                <h5>Create Post</h5>
            </div>
            <div class="well-content">
                <form action="{{ route('posts.store') }}" method="POST" class="create-update" enctype="multipart/form-data">
                    @include('/dashboard/post/includes.form')
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
        $('.tag-select-for-post').select2();
    });
</script>
<!-- /.Scripts -->

@endpush
