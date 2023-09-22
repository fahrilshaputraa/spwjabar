<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../assets/img/logo.png" rel="icon" />
    <link href="../assets/img/logo.png" rel="apple-touch-icon" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- endBootstrap -->

    <!-- MyCss -->
    <link rel="stylesheet" href="assets/css/mycss.css" />
    <!-- endMyCss -->

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900;1000&family=Righteous&display=swap" rel="stylesheet" />
    <!-- endFont Google -->

    <title>{{ $title }}</title>
  </head>
  <body class="main-page overflow-hidden">
    <nav class="navbar container-fluid px-5 py-2 bg-transparent fixed-top">
      <h2 class="nav-logo pt-3 fw-bold text-warning">SPW</h2>
    </nav>

    <main>
      <div class="content d-grid align-content-center px-4 text-center">
        <div class="col-lg-6 mx-auto">
          <h1 class="title fw-bold text-success">Data Siswa/Siswi yang Berwirausaha Provinsi Jawa Barat</h1>
          <p class="my-4 text-secondary">
            Program SPW merupakan model pembelajaran yang mendorong siswa untuk memiliki keterampilan melalui praktik usaha. Siswa didorong melakukan praktik wirausaha berbasis daring/online karena dipandang relatif murah dan mudah untuk
            pemula.
          </p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="/login" type="button" class="btn btn-primary px-4 fw-medium">
              Masuk Aplikasi
              <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ms-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="d-grid justify-content-end pe-4">
        <p class="text-dark text-opacity-75 fw-bold copyright">&copy; 2022 RPL SMKN 1 KAWALI</p>
      </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
