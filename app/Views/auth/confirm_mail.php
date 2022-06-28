<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(<?= base_url('assets/img/generic/16.jpg') ?>);background-position: 50% 30%;">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2"><span class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">Undip</span></div>
                  <div class="card-body p-4">
                    <div class="text-center"><img class="d-block mx-auto mb-4" src="<?= base_url('assets/img/icons/spot-illustrations/16.png') ?>" alt="Email" width="100" />
                      <h3 class="mb-2">Please check your email!</h3>
                      <p>An email has been sent to <strong><?= $email ?></strong>. <?= $msg ?>
                      </p><a class="btn btn-primary btn-sm mt-3" href="<?= base_url('login') ?>"><span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4 down-1"></span>Return to login</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?= $this->endSection() ?>
