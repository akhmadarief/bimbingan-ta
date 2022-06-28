        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">
              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            </div><a class="navbar-brand" href="<?= base_url() ?>">
              <div class="d-flex align-items-center py-3"><img class="me-2" src="<?= base_url('assets/img/undip.png') ?>" alt="" width="40" /><span class="font-sans-serif">Undip</span>
              </div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                  <!-- label-->
                  <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Pages
                    </div>
                    <div class="col ps-0">
                      <hr class="mb-0 navbar-vertical-divider" />
                    </div>
                  </div>
                  <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" href="<?= base_url(session('role').'/dashboard') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                    </div>
                  </a>
                  <?php if (session()->role == 'admin') { ?>
                  <a class="nav-link dropdown-indicator" href="#user" role="button" data-bs-toggle="collapse" aria-expanded="<?= ($title == 'Dosen' || $title == 'Mahasiswa') ? 'true' : 'false' ?>" aria-controls="user">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span class="nav-link-text ps-1">User</span>
                    </div>
                  </a>
                  <ul class="nav collapse <?= ($title == 'Dosen' || $title == 'Mahasiswa') ? 'show' : 'false' ?>" id="user">
                    <li class="nav-item">
                      <a class="nav-link <?= $title == 'Dosen' ? 'active' : '' ?>" href="<?= base_url('admin/user/dosen') ?>" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Dosen</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= $title == 'Mahasiswa' ? 'active' : '' ?>" href="<?= base_url('admin/user/mhs') ?>" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Mahasiswa</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <?php } ?>
                  <?php if (session()->role == 'dosen' || session()->role == 'mhs') { ?>
                  <a class="nav-link <?= $title == 'Chat' ? 'active' : '' ?>" href="<?= base_url('chat') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                    </div>
                  </a>
                  <a class="nav-link dropdown-indicator" href="#bimbingan" role="button" data-bs-toggle="collapse" aria-expanded="<?= ($title == 'Pengajuan Bimbingan' || $title == 'Bimbingan Berjalan' || $title == 'Bimbingan Selesai') ? 'true' : 'false' ?>" aria-controls="bimbingan">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book"></span></span><span class="nav-link-text ps-1">Bimbingan</span>
                    </div>
                  </a>
                  <ul class="nav collapse <?= ($title == 'Pengajuan Bimbingan' || $title == 'Bimbingan Berjalan' || $title == 'Bimbingan Selesai') ? 'show' : 'false' ?>" id="bimbingan">
                    <li class="nav-item">
                      <a class="nav-link <?= $title == 'Pengajuan Bimbingan' ? 'active' : '' ?>" href="<?= base_url(session()->role.'/bimbingan/submission') ?>" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Pengajuan</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= $title == 'Bimbingan Berjalan' ? 'active' : '' ?>" href="<?= base_url(session()->role.'/bimbingan/on-progress') ?>" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Berjalan</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= $title == 'Bimbingan Selesai' ? 'active' : '' ?>" href="<?= base_url(session()->role.'/bimbingan/completed') ?>" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Selesai</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                  <?php } ?>
                  <a class="nav-link <?= $title == 'User Settings' ? 'active' : '' ?>" href="<?= base_url('user/settings') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cog"></span></span><span class="nav-link-text ps-1">Settings</span>
                    </div>
                  </a>
                  <a class="nav-link <?= $title == 'Logout' ? 'active' : '' ?>" href="<?= base_url('logout') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-sign-out-alt"></span></span><span class="nav-link-text ps-1">Logout</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
