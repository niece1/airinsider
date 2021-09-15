<div class="js-cookie-consent cookie-consent">
    <div class="text-info">
        <p class="cookie-consent__message">
            {{ trans('cookie-consent::texts.message') }}
        </p>
        <a href="{{ route('cookie-policy') }}">
            Learn more 
            <i class="fas fa-hand-pointer"></i>
        </a>
    </div>
    <div class="consent">
        <a class="js-cookie-consent-agree cookie-consent__agree button">
            {{ trans('cookie-consent::texts.agree') }}
        </a>
        <a href="{{ route('privacy-policy') }}" class="settings">Privacy Policy</a>
    </div>
</div>
