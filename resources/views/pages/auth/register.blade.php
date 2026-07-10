<x-layout.auth-layout>
    <x-common.form.status-message-info />
    <div class="login-register-container">
        <a
            class="logo-link-index"
            href="{{ route('home') }}">
            <img src="{{ asset('images/logos/basic-logo.png') }}" alt="Logo">
        </a>
        <form action="{{ route('register.post') }}" method="post">
            <h3>Registrarse</h3>
            @csrf
            <div class="login-register-form-input">
                <x-common.form.input-form name="first_name" type="text" label="Nombre:*" placeholder="Escriba el nombre" />
                <x-common.form.input-form name="last_name" type="text" label="Apellido:*" placeholder="Escriba el apellido" />
                <x-common.form.input-form name="email" type="email" label="Correo:*" placeholder="Escriba el correo" />
                <x-common.form.input-form name="password" type="password" label="Contraseña:*" placeholder="Escriba la contraseña" />
                <x-common.form.input-form name="password_confirmation" type="password" label="Confirme contraseña:*" placeholder="Escriba la confirmación de la contraseña " />
            </div>
            <div class="form-captcha-btn">
                <x-common.form.input-recaptcha />
            </div>
            <button class="login-register-form-btn" type="submit"> Registrarme</button>
            <div class="auth-container-links">
                <div class="auth-a-form">
                    <a href="{{ route('login') }}">Inicia sesión</a>
                </div>
            </div>

        </form>

    </div>
</x-layout.auth-layout>