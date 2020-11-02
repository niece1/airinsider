@if (session()->has('success'))
<div class="alert-success">
    {{ session()->get('success') }}
</div>             
@endif
