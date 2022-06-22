<?php if (!empty(session()->getFlashdata('alert_add_user'))) { ?>
    <script type="text/javascript">
      $(window).on("load", function() {
        $("#addModal").modal("show");
      });
    </script>
    <?php } if (!empty(session()->getFlashdata('alert_edit_user'))) { ?>
    <script type="text/javascript">
      $(window).on("load", function() {
        $("#editModal").modal("show");
      });
    </script>
    <?php } ?>

    <script type="text/javascript">
      $(document).on("click", ".btn-edit", function() {
        var id = $(this).data("id");
        var user = $(this).closest("tr");
        var name = user.find("td:eq(1)").text();
        var nip_nim = user.find("td:eq(2)").text();
        var email = user.find("td:eq(3)").text();
        var verified = user.find("td:eq(4)").text() == "Verified" ? 1 : 0;
        $("#id").val(id);
        $("#name").val(name);
        $("#nip_nim").val(nip_nim);
        $("#email").val(email);
        $("input:radio[name=verified]").val([verified]);
        $("#editModal").modal("show");
      });
      $(document).on("click", ".btn-delete", function() {
        var id = $(this).data("id");
        $(".btn-confirm").data("id", id);
        $("#deleteModal").modal("show");
      });
      $(document).on("click", ".btn-confirm", function() {
        var id = $(this).data("id");
        window.location="<?= base_url().'/admin/user/delete/' ?>" + id;
      });
    </script>
