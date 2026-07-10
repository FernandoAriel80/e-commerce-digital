<x-layout.auth-layout>
    <x-common.form.status-message-info />
    <div class="forgot-reset-password-container">
        <div class="forgot-reset-password-container-form">
            <h4>Recuperación de contraseña</h4>
            <form action="{{ route('password.update') }}" method="post">
                <input type="hidden" value="{{ $token }}" name="token">
                <div class="forgot-reset-password-form-input">
                    <x-common.form.input-form name="email" type="hidden" value="{{ $_GET['email'] }}" />
                    <x-common.form.input-form name="password" type="password" label="Contraseña:*" placeholder="Escriba la contraseña" />
                    <x-common.form.input-form name="password_confirmation" type="password" label="Confirme contraseña:*" placeholder="Escriba la confirmación de la contraseña " />
                </div>
                <button class="forgot-reset-password-form-btn" type="submit">Guardar</button>
            </form>
        </div>
    </div>
</x-layout.auth-layout>