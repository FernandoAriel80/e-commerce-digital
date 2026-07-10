<x-layout.auth-layout>
    <x-common.form.status-message-info />
    <div class="login-register-container">
        <a
            class="logo-link-index"
            href="{{ route('home') }}">
            <img src="{{ asset('images/logos/basic-logo.png') }}" alt="Logo">
        </a>
        <form action="{{ route('login.post') }}" method="post">
            <h3>Iniciar Sesión</h3>
            @csrf
            <div class="login-register-form-input">
                <x-common.form.input-form name="email" type="email" label="Correo:*" placeholder="Escriba su correo" />
                <x-common.form.input-form name="password" type="password" label="Contraseña:*" placeholder="Escrioba su contraseña" />
            </div>
            <button class="login-register-form-btn" type="submit">Iniciar sesión</button>
            <div class="auth-container-links">
                <div class="auth-a-form">
                    <a href="{{ route('register') }}">¿Aun no te registraste?</a>
                    <a href="{{ route('password.request') }}">¿Olvido su contraseña?</a>
                </div>
                <a
                    class="auth-google-btn"
                    href="{{ route('google.redirect') }}">
                    <img src="https://img.icons8.com/?size=100&id=17949&format=png&color=000000" alt="Imagen de Google">
                    Inicia sesión con google.
                </a>

            </div>
        </form>
    </div>

</x-layout.auth-layout>