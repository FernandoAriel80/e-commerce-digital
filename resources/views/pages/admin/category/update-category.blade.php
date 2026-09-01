  <x-layout.laylout>
      <div class="create-category-container">
          <x-common.form.status-message-info />
          <h3>Actualizar categorias</h3>
          <div class="create-category-btn-back">
              <a href="{{ route('dashboard.category') }}">Volver</a>
          </div>
          <form class="create-category-form" action="{{ route('category.update',['id' => $category->id]) }}" method="POST">
              @csrf
              @method('put')
              <x-common.form.input-form
                  label="Nombre:* (ej: diseño grafico)"
                  name="name"
                  placeholder="Nombre de la categoria."
                  type="text"
                  :value="$category->name" />

              <x-common.form.input-form
                  label="Nombre de identificación:* (ej: diseño-grafico)"
                  name="slug"
                  placeholder="Nombre de la url para la categoria."
                  type="text"
                  :value="$category->slug" />

              <x-common.form.input-textarea
                  name="description"
                  placeholder="Descripción de la categoria..."
                  label="Descripción:"
                  :value="$category->description" />
              <button type="submit">Actualizar</button>
          </form>
      </div>
  </x-layout.laylout>