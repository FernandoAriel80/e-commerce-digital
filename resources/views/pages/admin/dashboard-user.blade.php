  <x-layout.laylout>
      <div class="user-container">
          <x-common.dashboard-menu-side />
          <div class="user-data-side">
              <x-common.form.status-message-info />
              <x-common.search :search="request('search')" :url_to="route('dashboard.user.search')" :back_to="route('dashboard.user')" placeholder="Buscar usuario.." />
              <h3>usuarios</h3>

              <x-common.list-table :header_list="['N°','Nombre','Correo','Fecha de creación',]">
                  @foreach ( $users as $user )
                  <tr>
                      <td>{{$loop->index + 1 }}</td>
                      <td>{{$user->first_name}} {{$user->last_name}}</td>
                      <td>{{$user->email }}</td>
                      <td>{{$user->created_at->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                  </tr>
                  @endforeach
              </x-common.list-table>

              <x-common.pagination :objects="$users" />
          </div>
      </div>
  </x-layout.laylout>