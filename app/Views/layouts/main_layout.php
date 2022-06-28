<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <?= $this->include('layouts/partials/head') ?>

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

        <?= $this->include('layouts/partials/sidebar') ?>

        <div class="content">
          <?= $this->include('layouts/partials/navbar') ?>
          <?= $this->include('layouts/partials/breadcumb') ?>
          <?= $this->renderSection('content') ?>
          <?= $this->include('layouts/partials/footer') ?>
        </div>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?= $this->include('layouts/partials/js') ?>
    <?= $this->renderSection('js') ?>

  </body>

</html>
