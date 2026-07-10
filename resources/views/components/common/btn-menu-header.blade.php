<div class="btn-menu-header">
    <div class="manu-nav-btn">
        <svg class="menu-icon-btn" viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M3 12h18M3 18h18" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <nav class="menu-nav-burger">
        <ul>
            <li class="menu-btn-burger-li">
                <a class="btn-burgger-header" href="{{ route('profile.general') }}">Perfil</a>
            </li>
            <li class="menu-btn-burger-li">
                @if (auth()->user()->isAdmin())
                <a class="btn-burgger-header" href="{{ route('dashboard.general') }}">Admin</a>
                @endif
            </li>
            <li class="menu-btn-burger-li">
                <x-common.form.btn-logout />
            </li>
        </ul>
    </nav>
</div>

<script>
    let btnMenu = document.querySelector('.menu-icon-btn');
    let menu = document.querySelector('.menu-nav-burger');

    btnMenu.addEventListener('click', (e) => {
        e.preventDefault();
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'flex';
        } else {
            menu.style.display = 'none';
        }
    });
</script>