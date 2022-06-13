<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="card">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0" data-anchor="data-anchor">Daftar User <?= $title ?></h5>
                  <p class="mb-0 mt-2 mb-0">Add <code> pagination </code> class for enable number pagination. The following structure will enable number pagination with next and previous button.</p>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div id="tableUser" data-list='{"valueNames":["name","nip/nim","email"],"page":5,"pagination":true}'>
                <div class="row g-2 justify-content-end mb-3">
                  <div class="col-sm-2">
                    <input class="form-control form-control-sm search" type="text" placeholder="Search" aria-label="City">
                  </div>
                  <div class="col-sm-auto">
                    <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#add"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button>
                  </div>
                </div>
                <div class="table-responsive scrollbar">
                  <table class="table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                      <tr>
                        <th class="no-sort text-center">No.</th> 
                        <th class="sort text-center" data-sort="name">Nama</th>
                        <th class="sort text-center" data-sort="nip/nim"><?= $title == 'Dosen' ? 'NIP' : 'NIM' ?></th>
                        <th class="sort text-center" data-sort="email">Email</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php $no = 1; foreach ($user as $user) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="name"><?= $user->name ?></td>
                        <td class="nip/nim text-center"><?= $user->nip_nim ?></td>
                        <td class="email"><?= $user->email ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                  <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                  <ul class="pagination mb-0"></ul>
                  <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">Add New User</h4>
                  </div>
                  <div class="p-4 pb-0">
                    <form method="POST" action="<?= base_url('admin/user/add') ?>">
                      <?= session()->getFlashdata('alert_add_user') ?>
                      <div class="mb-3">
                        <label class="col-form-label" for="role">Role:</label>
                        <select class="form-select" aria-label="role" name="role" required>
                          <option value="">Select role...</option>
                          <option value="dosen" <?= old('role') == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                          <option value="mhs" <?= old('role') == 'mhs' ? 'selected' : '' ?>>Mahasiswa</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="name">Name:</label>
                        <input class="form-control" type="text" id="name" name="name" value="<?= old('name') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="nip/nim">NIP/NIM:</label>
                        <input class="form-control" type="text" id="nip/nim" name="nip/nim" value="<?= old('nip/nim') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="email">Email address:</label>
                        <input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password" value="<?= old('password') ?>" required />
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

<?= $this->endSection() ?>
