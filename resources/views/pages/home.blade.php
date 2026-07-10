<x-layout.laylout>
    <x-common.form.status-message-info />

    @auth
    @if (!auth()->user()->hasVerifiedEmail())
    <div class="alert alert-warning">
        ⚠️ Tu correo no está verificado.
        <a href="{{ route('verification.notice') }}">Verificar ahora</a>
    </div>
    @endif
    @endauth
    <p>home</p>
</x-layout.laylout>