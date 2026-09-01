  <x-layout.laylout>
      <div class="create-category-container">
          <x-common.form.status-message-info />
          <h3>Crear categorias</h3>
          <div class="create-category-btn-back">
              <a href="{{ route('dashboard.category') }}">Volver</a>
          </div>
          <form class="create-category-form" action="{{ route('category.create.post') }}" method="POST">
              @csrf
              <x-common.form.input-form
                  label="Nombre:* (ej: diseño grafico)"
                  name="name"
                  placeholder="Nombre de la categoria."
                  type="text" />

              <x-common.form.input-form
                  label="Nombre de identificación:* (ej: diseño-grafico)"
                  name="slug"
                  placeholder="Nombre de la url para la categoria."
                  type="text" />

              <x-common.form.input-textarea
                  name="description"
                  placeholder="Descripción de la categoria..."
                  label="Descripción:" />
              <button type="submit">Crear</button>
          </form>
      </div>
  </x-layout.laylout>