<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{ Route::currentRouteName() == 'dash' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('dash') }}">
            <i class="material-icons">dashboard</i>
            <p>Tableau de bord</p>
          </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('profile') }}">
            <i class="material-icons">person</i>
            <p>Profile</p>
          </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'password' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('password') }}">
            <i class="material-icons">lock</i>
            <p>Mot de passe</p>
          </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'patients.index' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('patients.index') }}">
            <i class="material-icons">accessible</i>
            <p>Patients</p>
          </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'appointments.index' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('appointments.index') }}">
                  <i class="material-icons">assignment_turned_in</i>
                  <p>Rendez-vous</p>
              </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'prescriptions.index' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('prescriptions.index') }}">
            <i class="material-icons">assignment</i>
            <p>Prescriptions</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
