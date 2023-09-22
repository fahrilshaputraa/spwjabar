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
    <link href="../assets/css/bootstrap-icons.css" rel="stylesheet" />
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
  <body>
    <section class="vh-100">
      <a href="/" class="position-absolute ms-2 mt-2 fs-3 px-2 text-dark rounded-circle bg-dark bg-opacity-75">
        <i class="bi bi-arrow-left text-white"></i>
      </a>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-sm-5 foto-login px-0">
            <img src="assets/img/Bg_login.png" alt="Login image" class="vh-100 w-100" style="object-fit: cover; object-position: left" />
          </div>
          <div class="col-sm-7 text-black">
            <div class="d-grid h-75 align-items-center justify-content-center px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
              <form class="form-login"  style="width: 30rem" action="/login" method="POST">
                @csrf
                <h1 class="text_login fw-semibold text-center">Log in</h1>
                <p class="mb-5 pb-3 text-center text-muted">Masuk aplikasi untuk mengetahui lebih lanjut.</p>

                <div class="form-outline mb-4">
                  <label class="form-label fw-semibold" for="inputUsername">Username</label>
                  <input type="text" id="inputUsername" autofocus class="form-control form-control-lg @error('username')
                      is-invalid
                  @enderror" name="username" value="{{ old('username') ?? (isset($_COOKIE['username']) ? $_COOKIE['username'] : '') }}"
                  />
                  @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label fw-semibold" for="inputPassword">Password</label>
                  <input type="password" id="inputPassword" value="{{ (isset($_COOKIE['password']) ? $_COOKIE['password'] : '') }}" class="form-control form-control-lg @error('password')
                      is-invalid
                  @enderror" name="password"/>
                  @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-outline mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') || ($_COOKIE['remember'] ?? '') === 'true' ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-primary w-100 btn-block btn-lg fw-semibold" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
