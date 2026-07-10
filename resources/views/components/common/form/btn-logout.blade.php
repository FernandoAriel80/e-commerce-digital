<form class="btn-header-logout-container" action="{{ route('logout') }}" method="post">
    @csrf
    <button class="btn-header-logout" type="submit">Cerrar</button>
</form>