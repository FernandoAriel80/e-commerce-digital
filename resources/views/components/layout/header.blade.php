<header>
    <div class="header-logo-container">
        <a
            class="logo-link-index"
            href="{{ route('home') }}">
            <img src="{{ asset('images/logos/basic-logo.png') }}" alt="Logo">
        </a>
    </div>
    <div class="header-links-container">
        <a class="header-btn-links" href="{{ route('home') }}">Inicio</a>
        @if (auth()->check() && auth()->user()->hasVerifiedEmail())
        <p>{{ auth()->user()->fullName() }}</p>
        <x-common.btn-menu-header />
        @else
        <a class="header-btn-links" href="{{ route('login') }}">Inicia sesión</a>
        @endif
    </div>
</header>