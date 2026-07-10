<x-layout.auth-layout>
    <x-common.form.status-message-info />

    <div class="forgot-reset-password-container">
        <div class="forgot-reset-password-container-form">
            <p>En caso de que olvido su contraseña tiene que escribir su correo y revisar su entrada de correos.</p>
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="forgot-reset-password-form-input">
                    <x-common.form.input-form name="email" type="email" label="Correo:*" placeholder="Escriba su correo para recuperarlo." />
                </div>
                <button class="forgot-reset-password-form-btn" type="submit">Enviar correo</button>
            </form>
        </div>
    </div>
</x-layout.auth-layout>