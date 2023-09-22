<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../assets/img/logo.png" rel="icon" />
    <link href="../assets/img/logo.png" rel="apple-touch-icon" />
    <!-- MyCss -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/css/quill.snow.css" rel="stylesheet" />
    <link href="../assets/css/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/css/remixicon.css" rel="stylesheet" />
    <link href="../assets/css/simple-datatables.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/mycss.css" />
    <!-- endMyCss -->

    <!-- CDN -->
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- EndSelect2 -->
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endSweet Alert -->
    <!-- EndCDN -->

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900;1000&family=Righteous&display=swap" rel="stylesheet" />
    <!-- endFont Google -->
    <title>{{ $title }}</title>
  </head>
  <body>
    @include('sweetalert::alert')
  <div>
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center"><span class="ms-3 d-none d-lg-block">Data Spw</span> </a> 
        <i class="ri-menu-2-fill fs-4 toggle-sidebar-btn"></i>
      </div>
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <!--<img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" />--> <i class="ri-account-circle-fill fs-2"></i> <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <i class="ri-account-circle-fill fs-2"></i>
                  <h6>{{ auth()->user()->name }}</h6>
                  <span>{{ auth()->user()->level->level }}</span>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="/profile"> <i class="bi bi-person"></i> <span>My Profile</span> </a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <form action="/logout" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center">
                    <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span>
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($title == 'Admin') ? '':'collapsed'}}" href="/admin"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title == 'Admin | Disdik' || $title == 'Admin | KCD' || $title == 'Admin | Sekolah') ? '':'collapsed'}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="ri-folder-user-line"></i><span>Data Users</span><i class="bi bi-chevron-down ms-auto"></i> </a>
          <ul id="components-nav" class="nav-content collapse {{ ($title == 'Admin | Disdik' || $title == 'Admin | KCD' || $title == 'Admin | Sekolah') ? 'show':''}}" data-bs-parent="#sidebar-nav">
            <li>
              <a href="/admin/disdik" class="{{ ($title == 'Admin | Disdik') ? 'active':''}}"> <i class="bi bi-dash-lg"></i><span>Admin Disdik</span> </a>
            </li>
            <li>
              <a href="/admin/kcd" class="{{ ($title == 'Admin | KCD') ? 'active':''}}"> <i class="bi bi-dash-lg"></i><span>Admin KCD</span> </a>
            </li>
            <li>
              <a href="/admin/sekolah" class="{{ ($title == 'Admin | Sekolah') ? 'active':''}}"> <i class="bi bi-dash-lg"></i><span>Admin Sekolah</span> </a>
            </li>
          </ul>
        </li>
      </ul>
    </aside>
    @yield('contents')
    <footer id="footer" class="footer"> 
      <div class="copyright">
        &copy; Copyright <strong><span>Disdik Jabar</span></strong
        >.
      </div>
      <div class="credits">Create By <a href="https://freeetemplates.com/">RPL (SMKN 1 KAWALI)</a></div>
    </footer> 
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/apexcharts.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/echarts.min.js"></script>
    <script src="../assets/js/quill.min.js"></script>
    <script src="../assets/js/simple-datatables.js"></script>
    <script src="../assets/js/tinymce.min.js"></script>
    <script src="../assets/js/validate.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
