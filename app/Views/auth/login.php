<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <?= $this->include('layout/head') ?>

  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container-fluid">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(<?= base_url('assets/img/generic/14.jpg') ?>);background-position: 50% 20%;">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2"><span class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">Undip</span></div>
                  <div class="card-body p-4">
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <h3>Login</h3>
                      </div>
                      <div class="col-auto fs--1 text-600"><span class="mb-0 fw-semi-bold">New User?</span> <span><a href="<?= base_url('register') ?>">Create account</a></span></div>
                    </div>
                    <form method="POST">
                      <?= session()->getFlashdata('alert') ?>
                      <?= csrf_field() ?>
                      <div class="mb-3">
                        <label class="form-label" for="split-login-email">Email address</label>
                        <input class="form-control" id="split-login-email" type="email" name="email" required />
                      </div>
                      <div class="mb-3">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="split-login-password">Password</label>
                        </div>
                        <input class="form-control" id="split-login-password" type="password" name="password" required />
                      </div>
                      <div class="row flex-between-center">
                        <div class="col-auto">
                          <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="split-checkbox" />
                            <label class="form-check-label mb-0" for="split-checkbox">Remember me</label>
                          </div>
                        </div>
                        <div class="col-auto"><a class="fs--1" href="<?= base_url('forgot-password') ?>">Forgot Password?</a></div>
                      </div>
                      <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in</button>
                      </div>
                    </form>
                    <div class="position-relative mt-4">
                      <hr class="bg-300" />
                      <div class="divider-content-center">or log in with</div>
                    </div>
                    <div class="mt-2">
                      <a class="btn btn-outline-google-plus btn-sm d-block w-100" href="<?= base_url('google/login') ?>"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?= $this->include('layout/js') ?>

  </body>

</html>
