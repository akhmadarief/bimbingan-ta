<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

          <div class="card">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0" data-anchor="data-anchor">Daftar Mahasiswa</h5>
                  <!-- <p class="mb-0 mt-2 mb-0">Add <code> pagination </code> class for enable number pagination. The following structure will enable number pagination with next and previous button.</p> -->
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <!-- <div class="d-flex align-items-center justify-content-end my-3">
                <button class="btn btn-falcon-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#new"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button>
              </div> -->
              <div id="tableExample2" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                <div class="table-responsive scrollbar">
                  <table class="table table-bordered table-striped fs--1 mb-0">
                    <thead class="bg-200 text-900">
                      <tr>
                        <th class="sort" data-sort="name">Nama</th>
                        <th class="sort" data-sort="nip">NIM</th>
                        <th class="sort" data-sort="email">Email</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php foreach ($mhs as $mhs) { ?>
                      <tr>
                        <td class="name"><?= $mhs->name ?></td>
                        <td class="nip"><?= $mhs->nip_nim ?></td>
                        <td class="email"><?= $mhs->email ?></td>
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

<?= $this->endSection() ?>
