@props([
'btn_name',
'url_to',
'url_back',
'text',
'title'
])

<button class="btn-abrir" id="abrirModalBtn">{{ $btn_name }}</button>

<div class="modal-overlay" id="modalEliminar">
    <div class="modal-contenedor">
        <h2>{{ $title }}</h2>
        <p>
            {{ $text }}
        </p>

        <div class="modal-acciones">
            <button class="btn-cerrar" id="cerrarModalBtn">Cancelar</button>
            <button class="btn-eliminar" id="eliminarBtn">Eliminar</button>
        </div>

        <div class="modal-pie">¿Estás seguro?</div>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('modalEliminar');
        const abrirBtn = document.getElementById('abrirModalBtn');
        const cerrarBtn = document.getElementById('cerrarModalBtn');
        const eliminarBtn = document.getElementById('eliminarBtn');

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

        eliminarBtn.addEventListener('click', function() {
            const url = '{{ $url_to }}';

            eliminarBtn.textContent = 'Enviando...';
            eliminarBtn.disabled = true;

            fetch(url, {
                    method: 'DELETE',
                    /*  headers: {
                         'Content-Type': 'application/json',
                         // si necesitas token u otros headers, agrégalos aquí
                         // 'Authorization': 'Bearer tu-token'
                     },
                     // body: JSON.stringify({ motivo: 'prueba' }) */
                })
                .then(({
                    data,
                    ok,
                    status
                }) => {
                    if (ok) {
                        cerrarModal();
                        window.location.href = '{{ route("login") }}';
                    } else {
                        window.location.href = '{{ $url_back }}';
                    }
                })
                .catch(error => {
                    console.error('Error DELETE:', error);
                })
                .finally(() => {
                    eliminarBtn.textContent = 'Eliminar';
                    eliminarBtn.disabled = false;
                });
        });
    })();
</script>