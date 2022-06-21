<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="row g-3 mb-3">
            <div class="col-xl-7">
              <div class="card bg-transparent-50 overflow-hidden">
                <div class="card-header position-relative">
                  <div class="bg-holder d-none d-md-block bg-card z-index-1" style="background-image:url(<?= base_url('assets/img/illustrations/6.png') ?>);background-size:230px;background-position:right bottom;z-index:-1;">
                  </div>
                  <!--/.bg-holder-->

                  <div class="position-relative z-index-2">
                    <div>
                      <h3 class="text-primary mb-1">
                        <?= (date('H') < '12' ? 'Good Moorning,' : (date('H') >= '12' && date('H') < '17' ? 'Good Afternoon,' : (date('H') >= '17' && date('H') < '19' ? 'Good Evening,' : 'Good Night,'))).'<br>'.$user->name ?>
                        <br>
                      </h3>
                      <p><?= ($user->role == 'dosen' ? 'Dosen' : ($user->role == 'mhs' ? 'Mahasiswa' : 'Admin')).'<br>'.$user->nip_nim.'<br>'.$user->email ?></p>
                    </div>
                  </div>
                </div>
                <?php if (session('role') != 'admin') { ?>
                <div class="card-body p-0">
                  <ul class="mb-0 list-unstyled">
                    <li class="alert mb-0 rounded-0 py-3 px-card alert-danger border-0">
                      <div class="row flex-between-center">
                        <div class="col">
                          <div class="d-flex">
                            <div class="fas fa-circle mt-1 fs--2 text-danger"></div>
                            <p class="fs--1 ps-2 mb-0"><strong>10 chat</strong> belum dibaca</p>
                          </div>
                        </div>
                        <div class="col-auto d-flex align-items-center"><a class="alert-link fs--1 fw-medium" href="<?= base_url('chat') ?>">Lihat chat<i class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                      </div>
                    </li>
                    <li class="alert mb-0 rounded-0 py-3 px-card alert-warning border-0">
                      <div class="row flex-between-center">
                        <div class="col">
                          <div class="d-flex">
                            <div class="fas fa-circle mt-1 fs--2 text-warning"></div>
                            <p class="fs--1 ps-2 mb-0"><strong><?= $submission ?> bimbingan</strong> menunggu persetujuan</p>
                          </div>
                        </div>
                        <div class="col-auto d-flex align-items-center"><a class="alert-link fs--1 fw-medium" href="<?= base_url(session('role').'/bimbingan/submission') ?>">Lihat pengajuan<i class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                      </div>
                    </li>
                  </ul>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="col-xl-5">
              <div class="card h-100">
                <div class="bg-holder bg-card" style="background-image:url(<?= base_url('assets/img/icons/spot-illustrations/corner-4.png') ?>)">
                </div>
                <!--/.bg-holder-->

                <div class="card-header z-index-1" style="padding-bottom:0" >
                  <h5 class="text-primary">Welcome! </h5>
                  <h6 class="text-600">Here are some quick links for you to start </h6>
                </div>
                <div class="card-body z-index-1">
                  <div class="row g-2 h-100 align-items-end">
                    <?php if (session('role') == 'mhs') { ?>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-plus text-success"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" type="button" href="#" data-bs-toggle="modal" data-bs-target="#add">
                            <h6 class="text-800 mb-0">Buat Pengajuan</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Ajukan bimbingan baru</p>
                        </div>
                      </div>
                    </div>
                    <?php } if (session('role') != 'admin') { ?>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-book text-warning"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url(session('role').'/bimbingan/submission') ?>">
                            <h6 class="text-800 mb-0">Pengajuan</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Lihat pengajuan bimbingan</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-book text-info"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url(session('role').'/bimbingan/on-progress') ?>">
                            <h6 class="text-800 mb-0">Bimbingan Berjalan</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Lihat bimbingan berjalan</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-book text-success"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url(session('role').'/bimbingan/completed') ?>">
                            <h6 class="text-800 mb-0">Bimbingan Selesai</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Lihat bimbingan selesai</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-comments text-primary"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url('chat') ?>">
                            <h6 class="text-800 mb-0">Chat</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Lihat semua chat</p>
                        </div>
                      </div>
                    </div>
                    <?php } else if (session('role') == 'admin') { ?>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-user"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url('admin/user/dosen') ?>">
                            <h6 class="text-800 mb-0">Dosen</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Kelola data dosen</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-user"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url('admin/user/mhs') ?>">
                            <h6 class="text-800 mb-0">Mahasiswa</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Kelola data mahasiswa</p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="col-sm-6 col-md-5">
                      <div class="d-flex position-relative">
                        <div class="icon-item icon-item-sm border rounded-3 shadow-none me-2"><span class="fas fa-cog"></span></div>
                        <div class="flex-1">
                          <a class="stretched-link" href="<?= base_url('user/settings') ?>">
                            <h6 class="text-800 mb-0">User Settings</h6>
                          </a>
                          <p class="mb-0 fs--2 text-500">Perbarui profil & password</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if (session('role') != 'admin') { ?>
          <div class="row g-3 mb-3">
            <div class="col-sm-6 col-md-4">
              <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card" style="background-image:url(<?= base_url('assets/img/icons/spot-illustrations/corner-1.png') ?>)">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                  <h6>Pengajuan Bimbingan</h6>
                  <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"><?= $submission ?></div><a class="fw-semi-bold fs--1 text-nowrap" href="<?= base_url(session('role').'/bimbingan/submission') ?>">Lihat semua<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card" style="background-image:url(<?= base_url('assets/img/icons/spot-illustrations/corner-2.png') ?>)">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                  <h6>Bimbingan Berjalan</h6>
                  <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info"><?= $on_progress ?></div><a class="fw-semi-bold fs--1 text-nowrap" href="<?= base_url(session('role').'/bimbingan/on-progress') ?>">Lihat semua<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card" style="background-image:url(<?= base_url('assets/img/icons/spot-illustrations/corner-3.png') ?>)">
                </div>
                <!--/.bg-holder-->

                <div class="card-body position-relative">
                  <h6>Bimbingan Selesai</h6>
                  <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-success"><?= $completed ?></div><a class="fw-semi-bold fs--1 text-nowrap" href="<?= base_url(session('role').'/bimbingan/completed') ?>">Lihat semua<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

          <?php if (session('role') == 'mhs') { ?>
          <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">Pengajuan Bimbingan</h4>
                  </div>
                  <div class="p-4 pb-0">
                    <form method="POST" action="<?= base_url('mhs/bimbingan/add') ?>">
                      <div class="mb-3">
                        <label class="col-form-label" for="dosen">Dosen:</label>
                        <select class="form-select" aria-label="dosen" name="dosen" required>
                          <option value="">Pilih dosen</option>
                          <?php foreach ($dosen as $dosen) { ?>
                          <option value="<?= $dosen->id ?>"><?= $dosen->name.' - '.$dosen->nip_nim ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="jenis">Jenis Bimbingan:</label>
                        <select class="form-select" aria-label="jenis" name="jenis" required>
                          <option value="">Pilih jenis bimbingan</option>
                          <option value="1">Tugas Akhir</option>
                          <option value="2">Kerja Praktik</option>
                          <option value="3">Perlombaan</option>
                          <option value="4">Penelitian</option>
                          <option value="5">Perwalian</option>
                          <option value="6">Lainnya</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="topik">Topik:</label>
                        <textarea class="form-control" id="topik" name="topik" required></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

<?= $this->endSection() ?>
