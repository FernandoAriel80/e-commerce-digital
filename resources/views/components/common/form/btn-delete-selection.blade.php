@props([
'id' => '',
'btn_name',
'url_to',
'url_back',
'text',
'title'
])

<button class="btn-abrir" id="abrirModalBtn{{ $id }}">{{ $btn_name }}</button>

<div class="modal-overlay" id="modalEliminar{{ $id }}">
    <div class="modal-contenedor">
        <h2>{{ $title }}</h2>
        <p>{{ $text }}</p>

        <div class="modal-acciones">
            <button class="btn-cerrar" id="cerrarModalBtn{{ $id }}">Cancelar</button>
            <form id="formEliminar{{ $id }}" method="POST" action="{{ $url_to }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-eliminar" id="eliminarBtn{{ $id }}">Eliminar</button>
            </form>
        </div>

        <div class="modal-pie">¿Estás seguro?</div>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('modalEliminar{{ $id }}');
        const abrirBtn = document.getElementById('abrirModalBtn{{ $id }}');
        const cerrarBtn = document.getElementById('cerrarModalBtn{{ $id }}');
        const form = document.getElementById('formEliminar{{ $id }}');
        const eliminarBtn = document.getElementById('eliminarBtn{{ $id }}');

        function abrirModal() {
            modal.classList.add('activo');
        }

        function cerrarModal() {
            modal.classList.remove('activo');
        }

        abrirBtn.addEventListener('click', abrirModal);
        cerrarBtn.addEventListener('click', cerrarModal);

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                cerrarModal();
            }
        });

        // El formulario se envía normalmente con DELETE
        form.addEventListener('submit', function(e) {
            eliminarBtn.textContent = 'Eliminando...';
            eliminarBtn.disabled = true;
            // El formulario se envía automáticamente
        });

    })();
</script>