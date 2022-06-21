<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="card mb-3 mb-lg-0">
            <div class="card-header bg-light d-flex justify-content-between">
              <h5 class="mb-0"><?= $title ?></h5>
              <!-- <form>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected="selected">Select Category</option>
                  <option>Health &amp; Wellness</option>
                  <option>Business &amp; Professional</option>
                  <option>Performing &amp; Visual Arts</option>
                  <option>Science &amp; Technology</option>
                  <option>Sports &amp; Fitness</option>
                  <option>Charity &amp; Causes</option>
                  <option>Film &amp; Media</option>
                  <option>Fashion &amp; Beauty</option>
                  <option>Travel &amp; Outdoor</option>
                  <option>Entertainment</option>
                  <option>Other</option>
                </select>
              </form> -->
            </div>
            <div class="card-body fs--1">
              <div class="row">
                <?= $bimbingan ? '' : '<p class="mb-0 fs--1">Tidak ada data</p>' ?>
                <?php foreach ($bimbingan as $bimbingan) { ?>
                <div class="col-md-6 h-100">
                  <div class="d-flex btn-reveal-trigger">
                    <div class="calendar"><span class="calendar-month"><?= date('M',strtotime($bimbingan->created_at)) ?></span><span class="calendar-day"><?= date('d',strtotime($bimbingan->created_at)) ?></span></div>
                    <div class="flex-1 position-relative ps-3">
                      <div class="row">
                        <div class="col">
                          <h6 class="fs-0 mb-0">
                            <a href="#"><?= $bimbingan->topik ?> 
                            <?php if ($bimbingan->status == 0) { ?>
                              <span class="badge rounded-pill badge-soft-warning">Pending</span>
                            <?php } else if ($bimbingan->status == 3) { ?>
                              <span class="badge rounded-pill badge-soft-danger">Rejected</span>
                            <?php } ?>
                            </a>
                          </h6>
                          <p class="mb-1"><?= $bimbingan->jenis == 1 ? 'Tugas Akhir' : ($bimbingan->jenis == 2 ? 'Kerja Praktik' : ($bimbingan->jenis == 3 ? 'Perlombaan' : ($bimbingan->jenis == 4 ? 'Penelitian' : ($bimbingan->jenis == 5 ? 'Perwalian' : 'Lainnya')))) ?></a></p>
                        </div>
                        <div class="col-auto">
                          <div class="dropdown font-sans-serif position-static">
                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-label="Actions" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                            <div class="dropdown-menu dropdown-menu-end border py-0">
                              <div class="bg-white py-2">
                              <?php if ($title == 'Pengajuan Bimbingan' && session('role') == 'dosen') { ?>
                                <a class="dropdown-item text" href="<?= base_url('dosen/bimbingan/approve/'.$bimbingan->id) ?>">Approve</a>
                                <?php if ($bimbingan->status == 0) { ?>
                                <a class="dropdown-item text-danger" href="<?= base_url('dosen/bimbingan/reject/'.$bimbingan->id) ?>">Reject</a>
                                <?php } ?>
                              <?php } else if ($title == 'Pengajuan Bimbingan' && session('role') == 'mhs') { ?>
                                <a class="dropdown-item text" href="#!">Edit</a>
                                <a class="dropdown-item text-danger" href="#!">Delete</a>
                              <?php } else if ($title == 'Bimbingan Berjalan') { ?>
                                <a class="dropdown-item text" href="#!">Detail</a>
                                <?php if (session('role') == 'dosen') { ?>
                                <a class="dropdown-item text" href="<?= base_url('dosen/bimbingan/mark-as-completed/'.$bimbingan->id) ?>">Mark as Completed</a>
                                <a class="dropdown-item text-danger" href="<?= base_url('dosen/bimbingan/cancel-approve/'.$bimbingan->id) ?>">Cancel Approve</a>
                                <?php } ?>
                              <?php } else if ($title == 'Bimbingan Selesai' && session('role') == 'dosen') { ?>
                                <a class="dropdown-item text" href="<?= base_url('dosen/bimbingan/mark-as-on-progress/'.$bimbingan->id) ?>">Mask as On Progress</a>
                              <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="text-1000 mb-0">Mahasiswa: <?= $bimbingan->mhs.' - '.$bimbingan->nim ?></p>
                      <p class="text-1000 mb-0">Dosen: <?= $bimbingan->dosen.' - '.$bimbingan->nip ?></p>
                      <p class="text-1000 mb-0">Tanggal: <?= date('d M Y',strtotime($bimbingan->created_at)) ?></p>
                      <div class="border-dashed-bottom my-3"></div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php if (session('role') == 'mhs') { ?>
          <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <form method="POST" action="<?= base_url('mhs/bimbingan/new') ?>">
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
