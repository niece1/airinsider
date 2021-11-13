@component('mail::message')

<strong>Name:</strong> {{ $data['name'] }}<br>
<strong>Email:</strong> {{ $data['email'] }}<br>
<strong>Message:</strong> {{ $data['message'] }}<br>

@endcomponent
