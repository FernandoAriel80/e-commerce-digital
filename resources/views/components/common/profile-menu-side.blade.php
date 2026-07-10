<div class="profile-menu-side-container">
    <div class="profile-menu-side-container-children">
        <div class="profile-menu-side-btn">
            <svg class="profile-menu-side-icon-btn" viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 6h18M3 12h18M3 18h18" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <ul class="profile-menu-side-data">
            <li>
                <a class="profile-menu-btn" href="{{ route('profile.general') }}">General</a>
            </li>
            <li>
                <a class="profile-menu-btn" href="{{ route('profile.example') }}">Ejemplo</a>
            </li>
        </ul>
    </div>

</div>

<script>
    let btnProfile = document.querySelector('.profile-menu-side-icon-btn');
    let menuProfile = document.querySelector('.profile-menu-side-data');

    btnProfile.addEventListener('click', (e) => {
        e.preventDefault();
        if (menuProfile.style.display === 'none' || menuProfile.style.display === '') {
            menuProfile.style.display = 'flex';
        } else {
            menuProfile.style.display = 'none';
        }
    })
</script>