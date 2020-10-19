@component('mail::message')

<strong>Имя:</strong> {{ $data['name'] }}<br>
<strong>Email:</strong> {{ $data['email'] }}<br>
<strong>Сообщение:</strong> {{ $data['message'] }}<br>

@endcomponent
