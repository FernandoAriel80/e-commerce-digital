@php
$captcha_key = env('RE_CAPTCHA_CLOUDFLARE_PUBLIC_KEY');
@endphp
<div
    class="cf-turnstile"
    data-sitekey="{{ $captcha_key }}"
    data-theme="light"
    data-size="normal"
    data-language="es">
</div>
