@extends('layouts.dashboard')
//@section('title', 'Edit post' . $post->title)

@push('styles')
    <script src="https://cdn.tiny.cloud/1/9ypmvdehk28ku79envub5bb7sytgxc1udy8ixiq07axom6xb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea',
        plugins: "link image"
      });
    </script>
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endpush

@section('content')


@endsection

@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endpush