<div class="dashboard-menu-side-container">
    <div class="dashboard-menu-side-container-children">
        <div class="dashboard-menu-side-btn">
            <svg class="dashboard-menu-side-icon-btn" viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 6h18M3 12h18M3 18h18" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <ul class="dashboard-menu-side-data">
            <li>
                <a class="dashboard-menu-btn" href="{{ route('dashboard.general') }}">General</a>
            </li>
            <li>
                <a class="dashboard-menu-btn" href="{{ route('dashboard.user') }}">Usuarios</a>
            </li>
        </ul>
    </div>

</div>

<script>
    let btnDashboard = document.querySelector('.dashboard-menu-side-icon-btn');
    let menuDashboard = document.querySelector('.dashboard-menu-side-data');

    btnDashboard.addEventListener('click', (e) => {
        e.preventDefault();
        if (menuDashboard.style.display === 'none' || menuDashboard.style.display === '') {
            menuDashboard.style.display = 'flex';
        } else {
            menuDashboard.style.display = 'none';
        }
    })
</script>