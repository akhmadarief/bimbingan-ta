<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="card">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0" data-anchor="data-anchor">Pagination with numbering</h5>
                  <p class="mb-0 mt-2 mb-0">Add <code> pagination </code> class for enable number pagination. The following structure will enable number pagination with next and previous button.</p>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="d-flex align-items-center justify-content-end my-3">
                <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#new"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button>
              </div>
              <div id="tableExample2" data-list='{"valueNames":["mhs","dosen","jenis","topik","created_at","status"],"page":5,"pagination":true}'>
                <div class="table-responsive scrollbar">
                  <table class="table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                      <tr>
                        <th class="text-center" data-sort="no">No.</th>
                        <th class="sort text-center" data-sort="mhs">Mahasiswa</th>
                        <th class="sort text-center" data-sort="dosen">Dosen</th>
                        <th class="sort text-center" data-sort="jenis">Jenis</th>
                        <th class="sort text-center" data-sort="topik">Topik</th>
                        <th class="sort text-center" data-sort="created_at">Tanggal</th>
                        <th class="sort text-center" data-sort="status">Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php $no = 1; foreach ($bimbingan as $bimbingan) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="mhs"><?= $bimbingan->mhs ?><br><?= $bimbingan->nim ?></td>
                        <td class="dosen"><?= $bimbingan->dosen ?><br><?= $bimbingan->nip ?></td>
                        <td class="jenis text-center"><?= $bimbingan->jenis ?></td>
                        <td class="topik"><?= $bimbingan->topik ?></td>
                        <td class="created_at text-center"><?= $bimbingan->created_at ?></td>
                        <td class="status text-center">
                          <span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                        </td>
                        <td class="text-center">
                          <div>
                            <a class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Details" href="#"><span class="text-500 fas fa-paper-plane"></span></a>
                            <!-- <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="text-500 fas fa-trash-alt"></span></button> -->
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

          <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
              <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">Buat Bimbingan Baru</h4>
                  </div>
                  <div class="p-4 pb-0">
                    <form method="POST" action="<?= base_url('bimbingan/new') ?>">
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
                          <option value="2">Perlombaan</option>
                          <option value="3">Penelitian</option>
                          <option value="4">Perwalian</option>
                          <option value="5">Lainnya</option>
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

<?= $this->endSection() ?>
