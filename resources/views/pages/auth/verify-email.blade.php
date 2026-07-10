<x-layout.auth-layout>
    <x-common.form.status-message-info />
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <h4>Verifica tu correo electrónico</h4>
                    </div>
                    <div>
                        @if (session('message'))
                        <div>
                            {{ session('message') }}
                        </div>
                        @endif

                        <div>
                            <i class="fas fa-envelope"></i>
                            Te hemos enviado un enlace de verificación a tu correo.
                        </div>

                        <p>
                            Revisa tu bandeja de entrada y haz clic en el botón para verificar tu cuenta.
                        </p>

                        <!-- Botón para reenviar el correo -->
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i> Reenviar correo de verificación
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.auth-layout>