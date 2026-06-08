<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin BUP Genteng')</title>

  <link rel="stylesheet" href="{{ asset('template-admin/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template-admin/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('template-admin/assets/css/style.css') }}">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="{{ route('admin.dashboard') }}">
          <span class="brand-icon">
            <i class="bi bi-water" aria-hidden="true"></i>
          </span>

          <span class="brand-copy">
            <span class="brand-title">BUP Genteng</span>
            <span class="brand-subtitle">Admin CMS</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
          href="{{ route('admin.dashboard') }}">
          <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.bibit.*') ? 'active' : '' }}"
          href="{{ route('admin.bibit.index') }}">
          <span class="nav-icon"><i class="bi bi-box-seam"></i></span>
          <span class="nav-text">Data Bibit</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.monitoring.*') ? 'active' : '' }}"
          href="{{ route('admin.monitoring.index') }}">
          <span class="nav-icon"><i class="bi bi-clipboard-data"></i></span>
          <span class="nav-text">Monitoring</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}"
          href="{{ route('admin.pemesanan.index') }}">
          <span class="nav-icon"><i class="bi bi-cart-check"></i></span>
          <span class="nav-text">Pemesanan</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.profil-balai.*') ? 'active' : '' }}"
          href="{{ route('admin.profil-balai.index') }}">
          <span class="nav-icon"><i class="bi bi-building"></i></span>
          <span class="nav-text">Profil Balai</span>
        </a>

        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
          href="{{ route('admin.users.index') }}">
          <span class="nav-icon">
            <i class="bi bi-people"></i>
          </span>
          <span class="nav-text">Manajemen Akun</span>
        </a>

      </nav>

      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running</span>
      </div>
    </aside>

    <div class="admin-main">
      <nav class="navbar admin-navbar navbar-expand bg-white">
        <div class="container-fluid px-3 px-lg-4">
          <button class="sidebar-toggle"
            type="button"
            data-sidebar-toggle
            aria-controls="adminSidebar"
            aria-expanded="true"
            aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle"
              type="button"
              data-theme-toggle
              aria-label="Switch color theme"
              title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon></i>
            </button>

            <div class="dropdown">
              <button class="profile-button dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <img class="avatar-img avatar-sm"
                  src="{{ asset('template-admin/assets/images/avatar/avatar.jpg') }}"
                  alt="Admin">

                <span class="profile-name d-none d-sm-inline">
                  {{ Auth::user()->name ?? 'Admin' }}
                </span>
              </button>

              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                    Profile
                  </a>
                </li>

                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">

          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon">
                <i class="@yield('page-icon', 'bi bi-speedometer2')" aria-hidden="true"></i>
              </span>

              <div>
                <!-- <p class="eyebrow mb-1">@yield('breadcrumb', 'Admin CM')</p> -->
                <h1 class="h3 mb-1">@yield('page-title', 'Dashboard')</h1>
                <p class="text-muted mb-0">@yield('page-description', 'Sistem pengelolaan data BUP Genteng.')</p>
              </div>
            </div>
          </div>

          @yield('content')

        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 BUP Genteng.</span>
          <span>Admin CMS</span>
        </div>
      </footer>
    </div>
  </div>
  <script>
    window.adminHMDUser = {
      name: "{{ Auth::user()->name }}",
      workspace: "Active Workspace"
    };
  </script>
  <script src="{{ asset('template-admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template-admin/assets/js/main.js') }}"></script>
</body>

</html>