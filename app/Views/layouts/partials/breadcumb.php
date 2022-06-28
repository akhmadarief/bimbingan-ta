          <nav class="my-3 fs--1" style="--falcon-breadcrumb-divider: '»'" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <?php if ($title != 'Dashboard') { ?>
              <li class="breadcrumb-item"><a href="<?= base_url(session('role').'/dashboard') ?>">Dashboard</a></li>
              <?php } ?>
              <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
            </ol>
          </nav>
