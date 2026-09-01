  <x-layout.laylout>
      <div class="dashboard-container">
          <x-common.dashboard-menu-side />
          <div class="dashboard-data-side">

              <x-common.form.status-message-info />
              <h3>categorias</h3>
              <a class="btn-create-category" href="{{ route('category.create') }}">Crear</a>
              @if ($categories->count() > 0)
              <x-common.list-table :header_list="['Nombre','Descripción','Fecha de creación','Acción']">
                  @foreach ( $categories as $category )
                  <tr>
                      <td>{{$category->name}}</td>
                      <td title="{{ $category->description }}">{{$category->description }}</td>
                      <td>{{$category->created_at->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                      <td>
                          <a class="btn-update-category" href="{{ route('category.update.get',['id' => $category->id]) }}">Actualizar</a>
                          <x-common.form.btn-delete-selection
                              :id="$category->id"
                              btn_name="Eliminar"
                              :title="'Eliminar la categoria ' . $category->name"
                              text="Esta seguro que quiere eliminar esta categoria? "
                              :url_back="route('dashboard.category')"
                              :url_to="route('category.delete',['id' => $category->id])" />
                      </td>
                  </tr>
                  @endforeach
              </x-common.list-table>

              <x-common.pagination :objects="$categories" />
              @else
              <p>No se a cargado categorias</p>
              @endif
          </div>
      </div>
  </x-layout.laylout>