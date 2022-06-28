    <script src="<?= base_url('vendors/popper/popper.min.js') ?>"></script>
    <script src="<?= base_url('vendors/bootstrap/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('vendors/anchorjs/anchor.min.js') ?>"></script>
    <script src="<?= base_url('vendors/is/is.min.js') ?>"></script>
    <script src="<?= base_url('vendors/fontawesome/all.min.js') ?>"></script>
    <script src="<?= base_url('vendors/lodash/lodash.min.js') ?>"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url('vendors/list.js/list.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/theme.js') ?>"></script>
    <script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('vendors/toastr/toastr.js') ?>"></script>
    <script src="<?= base_url('vendors/glightbox/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/emoji-button.js') ?>"></script>

    <?php if (!empty(session()->getFlashdata('toastr'))) { ?>
    <script type="text/javascript">
      $(document).ready(function(){
        <?= session()->getFlashdata('toastr') ?>;
      });
    </script>
    <?php } ?>
