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
              <div id="tableUser" data-list='{"valueNames":["name","nip/nim","email","status"],"page":5,"pagination":true}'>
                <div class="row g-2 justify-content-end mb-3">
                  <div class="col-sm-2">
                    <input class="form-control form-control-sm search" type="text" placeholder="Search" aria-label="City">
                  </div>
                  <div class="col-sm-auto">
                    <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button>
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
                        <th class="sort text-center" data-sort="status">Email Verified</th>
                        <th class="no-sort text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php $no = 1; foreach ($user as $user) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="name"><?= $user->name ?></td>
                        <td class="nip/nim text-center"><?= $user->nip_nim ?></td>
                        <td class="email"><?= $user->email ?></td>
                        <td class="status text-center"><?= $user->email_verified == 1 ? '<span class="badge badge-soft-success">Verified</span>' : '<span class="badge badge-soft-danger">Not verified</span>' ?></td>
                        <td class="text-center">
                          <div>
                            <button class="btn btn-edit p-0" type="button" data-id="<?= $user->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="text-500 fas fa-edit"></span></button>
                            <button class="btn btn-delete p-0" type="button" data-id="<?= $user->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="text-500 fas fa-trash-alt"></span></button>
                          </div>
                        </td>
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

          <!-- Modal Add User -->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <form method="POST" action="<?= base_url('admin/user/add') ?>">
                  <?= csrf_field() ?>
                  <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                      <h4 class="mb-1">Add New User</h4>
                    </div>
                    <div class="p-4 pb-0">
                      <?= session()->getFlashdata('alert_add_user') ?>
                      <div class="mb-3">
                        <label class="col-form-label">Role:</label>
                        <select class="form-select" aria-label="role" name="role" required>
                          <option value="">Select role...</option>
                          <option value="dosen" <?= old('role') == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                          <option value="mhs" <?= old('role') == 'mhs' ? 'selected' : '' ?>>Mahasiswa</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Name:</label>
                        <input class="form-control" type="text" name="name" value="<?= old('name') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">NIP/NIM:</label>
                        <input class="form-control" type="text" name="nip/nim" value="<?= old('nip/nim') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Email address:</label>
                        <input class="form-control" type="email" name="email" value="<?= old('email') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Password:</label>
                        <input class="form-control" type="password" name="password" required />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal Edit User -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <form method="POST" action="<?= base_url('admin/user/edit') ?>">
                  <?= csrf_field() ?>
                  <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                      <h4 class="mb-1">Edit User</h4>
                    </div>
                    <div class="p-4 pb-0">
                      <?= session()->getFlashdata('alert_edit_user') ?>
                      <input type="hidden" id="id" name="id" value="<?= old('id') ?>" required />
                      <div class="mb-3">
                        <label class="col-form-label">Role:</label>
                        <select class="form-select" aria-label="role" id="role" name="role" required>
                          <option value="">Select role...</option>
                          <option value="dosen" <?= $title == 'Dosen' ? 'selected' : '' ?>>Dosen</option>
                          <option value="mhs" <?= $title == 'Mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Name:</label>
                        <input class="form-control" type="text" id="name" name="name" value="<?= old('name') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">NIP/NIM:</label>
                        <input class="form-control" type="text" id="nip_nim" name="nip/nim" value="<?= old('nip/nim') ?>" required />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Email address:</label>
                        <input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required />
                      </div>
                      <div class="mb-0">
                        <label class="col-form-label">Email verified:</label>
                        <div class="col">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" id="verified" type="radio" name="verified" value="1" <?= old('verified') == 1 ? 'checked' : '' ?> />
                            <label class="form-check-label" for="verified">Verified</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" id="notVerified" type="radio" name="verified" value="0" <?= old('verified') == 0 ? 'checked' : '' ?> />
                            <label class="form-check-label" for="notVerified">Not verified</label>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label" for="password">New Password:</label>
                        <input class="form-control" type="password" id="password" name="password" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal Delete User -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1">Delete User</h4>
                  </div>
                  <div class="px-4 py-3">
                    <p class="mb-0">Are you sure want to delete this user?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                  <button class="btn btn-primary btn-confirm" type="button">Hapus</button>
                </div>
              </div>
            </div>
          </div>

<?= $this->endSection() ?>
