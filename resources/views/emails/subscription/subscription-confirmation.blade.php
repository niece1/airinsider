@component('mail::message')

# Confirm your subscription for the {{ config('app.name') }} email list

<p>Hello</p>
<p>Thanks for subscribing to the {{ config('app.name') }} news email list. To complete your subscription, you
    need to confirm you got this email. To do so, please click the link below:
</p>

<a href="{{ route('subscription.update', ['email' => $subscription->email, 
            'remember_token' => $subscription->remember_token]) }}" class="button">
    Confirm
</a>

<p>If you subscribed in error or no longer want to hear from us, click "Unsubscribe" link and you will be
    instantly removed from our list:
</p>

<a href="{{ route('subscription.destroy', ['remember_token' => $subscription->remember_token]) }}">
    Unsubscribe
</a>

<div class="regards">
Regards,<br>
{{ config('app.name') }} team
</div>

@endcomponent
