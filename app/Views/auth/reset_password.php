<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(<?= base_url('assets/img/generic/20.jpg') ?>);">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2"><span class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">Undip</span></div>
                  <div class="card-body p-4">
                    <h3 class="text-center">Reset password</h3>
                    <form class="mt-3" method="POST">
                      <?php if (isset($validation)) { ?>
                      <div class="alert alert-danger" role="alert" style="padding-bottom: 0"><?= $validation->listErrors() ?></div>
                      <?php } ?>
                      <?= csrf_field() ?>
                      <div class="mb-3">
                        <label class="form-label" for="split-reset-password">New Password</label>
                        <input class="form-control" type="password" id="split-reset-password" name="password" required />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="split-reset-confirm-password">Confirm Password</label>
                        <input class="form-control" type="password" id="split-reset-confirm-password" name="confirm_password" required />
                      </div>
                      <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Set password</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?= $this->endSection() ?>
