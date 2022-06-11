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
            </div><a class="navbar-brand" href="../index.html">
              <div class="d-flex align-items-center py-3"><img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif">falcon</span>
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
                  <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                    </div>
                  </a>
                  <?php if (session()->role == 'admin') { ?>
                  <a class="nav-link <?= $title == 'Dosen' ? 'active' : '' ?>" href="<?= base_url('dosen') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span class="nav-link-text ps-1">Dosen</span>
                    </div>
                  </a>
                  <a class="nav-link <?= $title == 'Mahasiswa' ? 'active' : '' ?>" href="<?= base_url('mahasiswa') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user"></span></span><span class="nav-link-text ps-1">Mahasiswa</span>
                    </div>
                  </a>
                  <?php } ?>
                  <?php if (session()->role != 'admin') { ?>
                  <a class="nav-link <?= $title == 'Chat' ? 'active' : '' ?>" href="<?= base_url('chat') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                    </div>
                  </a>
                  <a class="nav-link <?= $title == 'Bimbingan' ? 'active' : '' ?>" href="<?= base_url('bimbingan') ?>" role="button" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book"></span></span><span class="nav-link-text ps-1">Bimbingan</span>
                    </div>
                  </a>
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
