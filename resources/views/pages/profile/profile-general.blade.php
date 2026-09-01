  <x-layout.laylout>
      <div class="profile-container">
          <x-common.profile-menu-side />
          <div class="profile-data-side">


              <x-common.form.status-message-info />
              <h3>Datos de perfil</h3>
              <section class="profile-data-side-general-data">
                  <div class="profile-data-side-general-data-container">
                      <span>Datos generales</span>
                      <div>
                          <label for="">Nombre:</label>
                          <p>{{ $user['name'] }}</p>
                      </div>
                      <div>
                          <label for="">Correo:</label>
                          <p>{{ $user['email'] }}</p>
                      </div>
                      <div>
                          <label for="">Verificado:</label>
                          <p>{{ $user['is_verified'] ? 'SI' : 'NO' }}</p>
                      </div>
                  </div>
              </section>
              <section class="profile-data-side-change-password">
                  <div class="profile-data-side-change-password-container">
                      <span>Cambiar contraseña</span>
                      <form class="profile-data-side-change-password-form" action="{{ route('change.password') }}" method="post">
                          @csrf
                          @method('put')
                          <x-common.form.input-form
                              name="old_password"
                              type="password"
                              label="Contraseña actual:*"
                              placeholder="Escriba la contraseña actual." />
                          <x-common.form.input-form name="password" type="password" label="Contraseña nueva:*" placeholder="Escriba la nueva contraseña." />
                          <x-common.form.input-form name="password_confirmation" type="password" label="Confirme nueva contraseña:*" placeholder="Escriba la confirmación de la nueva contraseña." />
                          <button type="submit">Actualizar</button>
                      </form>
                  </div>
              </section>
              <section class="profile-data-side-delete-account">
                  <div class="profile-data-side-delete-account-container">
                      <span>Eliminar cuenta</span>
                      <p>Advertencia: Al eliminar esta cuenta, perderás el acceso permanente a todos tus datos,
                          historial, configuraciones y contenido asociado.</p>
                      <x-common.form.btn-delete-selection
                          btn_name="Eliminar cuenta"
                          title="Eliminar cuenta"
                          text="Advertencia: Al eliminar esta cuenta, perderás el acceso permanente a todos tus datos,
                          historial, configuraciones y contenido asociado."
                          :url_to="route('delete.account')"
                          :url_back="route('profile.general')" />
                  </div>
              </section>
          </div>
      </div>

  </x-layout.laylout>