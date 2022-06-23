<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <?= $this->include('layout/head') ?>

  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>

        <?= $this->include('layout/sidebar') ?>

        <div class="content">
          <?= $this->include('layout/navbar') ?>
          <?= $this->include('layout/breadcumb') ?>
          <?= $this->renderSection('content') ?>
          <?= $this->include('layout/footer') ?>
        </div>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?= $this->include('layout/js') ?>

    <?= $title == 'Dosen' || $title == 'Mahasiswa' ? $this->include('user/user_js') : '' ?>

  </body>

</html>
