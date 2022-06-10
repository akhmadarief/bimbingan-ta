<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="row">
            <div class="col-12">
              <div class="card mb-3 btn-reveal-trigger">
                <div class="card-header position-relative min-vh-25 mb-8">
                  <div class="cover-image">
                    <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(../../assets/img/generic/4.jpg);">
                    </div>
                    <!--/.bg-holder-->

                    <input class="d-none" id="upload-cover-image" type="file" />
                    <label class="cover-image-file-input" for="upload-cover-image"><span class="fas fa-camera me-2"></span><span>Change cover photo</span></label>
                  </div>
                  <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                    <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img src="../../assets/img/team/2.jpg" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                      <input class="d-none" id="profile-image" type="file" />
                      <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span class="bg-holder overlay overlay-0"></span><span class="z-index-1 text-white dark__text-white text-center fs--1"><span class="fas fa-camera"></span><span class="d-block">Update</span></span></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="mb-0">Profile Settings</h5>
                </div>
                <div class="card-body bg-light">
                  <form class="row g-3" method="POST" action="<?= base_url('user/update-profile') ?>">
                    <input name="id" type="hidden" value="<?= $user->id ?>" />
                    <div class="col-lg-12">
                      <?= session()->getFlashdata('alert_profile') ?>
                      <label class="form-label" for="name">Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="<?= $user->name ?>" required />
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label" for="nip/nim"><?= $user->role == 'dosen' ? 'NIP' : ($user-> role == 'mhs' ? 'NIM' : 'ID') ?></label>
                      <input class="form-control" id="nip/nim" name="nip/nim" type="text" value="<?= $user->nip_nim ?>" required />
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label" for="email">Email Address <span class="text-danger fs--2"><i>*tidak dapat diubah</i></span></label>
                      <input class="form-control" id="email" type="email" value="<?= $user->email ?>" disabled />
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                      <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-4 ps-lg-2">
              <div class="sticky-sidebar">
                <div class="card">
                  <div class="card-header">
                    <h5 class="mb-0">Change Password</h5>
                  </div>
                  <div class="card-body bg-light">
                    <form method="POST" action="<?= base_url('user/update-password') ?>">
                      <input name="id" type="hidden" value="<?= $user->id ?>" />
                      <div class="mb-3">
                        <?= session()->getFlashdata('alert_password') ?>
                        <label class="form-label" for="old-password">Old Password</label>
                        <input class="form-control" id="old-password" name="old_password" type="password" required />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="new-password">New Password</label>
                        <input class="form-control" id="new-password" name="new_password" type="password" required />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="confirm-password">Confirm Password</label>
                        <input class="form-control" id="confirm-password" name="confirm_password" type="password" required />
                      </div>
                      <button class="btn btn-primary d-block w-100" type="submit">Update Password </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?= $this->endSection() ?>
