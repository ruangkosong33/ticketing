<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-primary">
      <img src="{{asset('bk/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIGELATIK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('bk/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{request()->is('home*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Management Network</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data Center
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('vpr.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Virtual Private Server</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('whm.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>WHM / C-Panel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Metro
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('intranet.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jaringan Intranet</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Management Device</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                List Device
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('software.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perangkat Lunak</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('hardware.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perangkat Keras</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Management Ticketing</li>

          <li class="nav-item">
            <a href="{{route('category.index')}}" class="nav-link {{request()->is('category*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Kategori Tiket
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('priority.index')}}" class="nav-link {{request()->is('priority*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-map-pin"></i>
              <p>
                Prioritas Tiket
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{route('entrance.index')}}" class="nav-link {{request()->is('entrance*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Daftar Tiket
              </p>
            </a>
          </li>

          @if(Auth::user()->role == 'admin_opd')
          <li class="nav-header">Profile</li>

          <li class="nav-item">
            <a href="{{ route('profile') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Profile
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">Management Pengguna</li>
          <li class="nav-item">
            <a href="{{ route('notifications.index') }}" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifikasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
