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
            <div class="bg-holder" style="background-image:url(<?= base_url('assets/img/generic/19.jpg') ?>);">
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
                        <h3><?= $title ?></h3>
                      </div>
                      <?php if ($title == 'Register') { ?>
                      <div class="col-auto fs--1 text-600"><span class="mb-0 fw-semi-bold">Already User?</span> <span><a href="<?= base_url('login') ?>">Login</a></span></div>
                      <?php } ?>
                    </div>
                    <form method="POST">
                      <?= session()->getFlashdata('alert') ?>
                      <?php if ($title == 'Register') { ?>
                      <div class="mb-3">
                        <label class="form-label" for="split-role">Role</label>
                        <select class="form-select" id="split-role" name="role" required>
                          <option value="">Select your role...</option>
                          <option value="dosen" <?= old('role') == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                          <option value="mhs" <?= old('role') == 'mhs' ? 'selected' : '' ?>>Mahasiswa</option>
                        </select>
                      </div>
                      <?php } ?>
                      <div class="mb-3">
                        <label class="form-label" for="split-name">Name</label>
                        <input class="form-control" type="text" autocomplete="on" id="split-name" name="name" value="<?= $google_user->name ?? old('name') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="nip/nim">NIP/NIM</label>
                        <input class="form-control" type="text" autocomplete="on" id="nip/nim" name="nip/nim" value="<?= old('nip/nim') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="split-email">Email address</label>
                        <input class="form-control" type="email" autocomplete="on" id="split-email" name="email" value="<?= $google_user->email ?? old('email') ?>" required <?= $title == 'Register with Google' ? 'disabled' : '' ?>/>
                      </div>
                      <?php if ($title == 'Register') { ?>
                      <div class="row gx-2">
                        <div class="mb-3 col-sm-6">
                          <label class="form-label" for="split-password">Password</label>
                          <input class="form-control" type="password" autocomplete="on" id="split-password" name="password" value="<?= old('password') ?>" required />
                        </div>
                        <div class="mb-3 col-sm-6">
                          <label class="form-label" for="split-confirm-password">Confirm Password</label>
                          <input class="form-control" type="password" autocomplete="on" id="split-confirm-password" name="confirm_password" value="<?= old('confirm_password') ?>" required />
                        </div>
                      </div>
                      <?php } ?>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cover-register-checkbox" required />
                        <label class="form-label" for="cover-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                      </div>
                      <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Register</button>
                      </div>
                    </form>
                    <?php if ($title == 'Register') { ?>
                    <div class="position-relative mt-4">
                      <hr class="bg-300" />
                      <div class="divider-content-center">or register with</div>
                    </div>
                    <div class="mt-2">
                      <a class="btn btn-outline-google-plus btn-sm d-block w-100" href="<?= base_url('google/auth') ?>"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a>
                    </div>
                    <?php } ?>
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
