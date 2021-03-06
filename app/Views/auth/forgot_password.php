<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder overlay" style="background-image:url(<?= base_url('assets/img/generic/17.jpg') ?>);background-position: 50% 76%;">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2"><span class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">Undip</span></div>
                  <div class="card-body p-4">
                    <div class="text-center">
                      <h4 class="mb-0"> Forgot your password?</h4><small>Enter your email and we'll send you a reset link.</small>
                      <form class="mb-3 mt-4" method="POST">
                        <?= session()->getFlashdata('alert') ?>
                        <?= csrf_field() ?>
                        <input class="form-control" type="email" name="email" placeholder="Email address" required />
                        <div class="mb-3"></div>
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Send reset link</button>
                      </form><a class="fs--1 text-600" href="#!">I can't recover my account using this page<span class="d-inline-block ms-1">&rarr;</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?= $this->endSection() ?>
