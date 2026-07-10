@props([
'name',
'type' => 'text',
'value' => '',
'label' => '',
'placeholder' => '',
])

@php
$id = $name . '_' . uniqid();
@endphp

<div>
    @if($label)
    <label for="{{ $id }}">{{ $label }}</label>
    @endif

    <div class="input-form-container">
        <input
            class="input-form-input"
            type="{{ $type}}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}">

        @if($type === 'password')
        <div
            class="toggle-password"
            data-target="{{ $id }}">
            <img src="https://img.icons8.com/?size=100&id=7tg2iJatDNzj&format=png&color=000000" alt="Imagen de ojo">
        </div>
        @endif
    </div>

    @error($name)
    <span class="form-span-error">{{ $message }}</span>
    @enderror
</div>

<script>
    // Función que inicializa los botones
    function initPasswordToggles() {
        var buttons = document.querySelectorAll('.toggle-password');

        for (var i = 0; i < buttons.length; i++) {
            if (buttons[i].getAttribute('data-initialized') === 'true') {
                continue;
            }

            buttons[i].setAttribute('data-initialized', 'true');
            buttons[i].addEventListener('click', function(e) {
                e.preventDefault();
                var targetId = this.getAttribute('data-target');
                var input = document.getElementById(targetId);

                if (input) {
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.innerHTML  = '<img src="https://img.icons8.com/?size=100&id=LGlblwSTygN5&format=png&color=000000" alt="Imagen de ojo">';
                    } else {
                        input.type = 'password';
                        this.innerHTML  = '<img src="https://img.icons8.com/?size=100&id=7tg2iJatDNzj&format=png&color=000000" alt="Imagen de ojo">';
                    }
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPasswordToggles);
    } else {
        initPasswordToggles();
    }
</script>