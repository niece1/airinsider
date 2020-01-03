@extends('layouts.dashboard')

@section('title', 'Edit ' . $post->title)

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
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="title-jumbotron">
  <div class="parallax-text">
    <h1>Edit {{$post->title}}</h1>
  </div>
</section>

<section class="dashboard">

  <div class="dashboard-wrapper">
    
    <div class="well">
      <div class="well-title">
        <h5>Edit Post</h5>
      </div>

      <div class="well-content">

      <form action="{{ route('posts.update', $post->id) }}" class="create-update" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @include('/backend/includes.form')
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
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endpush