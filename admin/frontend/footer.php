<?php
if (isset($_SESSION['u_id'])) {
?>

    <footer class="main-footer">
        <strong>Copyright &copy; 2023 <a href="https://www.defencesc.lk/">DefenceSC.lk</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Creator</b> Vibodha Sasmitha
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../admin/assets/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../admin/assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> -->
    <!-- Bootstrap 4 -->
    <script src="../admin/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../admin/assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- overlayScrollbars -->
    <script src="../admin/assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../admin/assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../admin/assets/dist/js/pages/dashboard.js"></script>
    <!-- Toastr -->
    <script src="../admin/assets/toastr/toastr.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../admin/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin/assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../admin/assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../admin/assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../admin/assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../admin/assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../admin/assets/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../admin/assets/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../admin/assets/datatables-buttons/js/buttons.colVis.min.js"></script>
    </body>

    </html>

    <script>
        $(document).ready(function() {

            select_lang();

            $('#full_site_lang').on('change', function() {
                $.ajax({
                    type: "POST",
                    url: "../admin/admin-control/admins.php",
                    data: {
                        change_admin_lang: true,
                        'lang': $(this).val(),
                    },
                    success: function(response) {
                        // console.log(response);
                        location.reload();
                    }
                });
            });
        });

        function select_lang() {
            $.ajax({
                type: "POST",
                url: "../admin/admin-control/admins.php",
                data: {
                    get_admin_lang: true,
                },
                success: function(response) {
                    // console.log(response);
                    $('#full_site_lang option[value=' + response + ']').attr('selected', 'selected');
                }
            });
        }

        function key(event) {
            // console.log(event.which);
        }

        function message(type, msg) {
            if (type == 'success') {
                toastr.success(msg);
            }
            if (type == 'info') {
                toastr.info(msg);
            }
            if (type == 'danger') {
                toastr.error(msg);
            }
            if (type == 'warning') {
                toastr.warning(msg);
            }
        }
    </script>

<?php
} else {
    header('Location: ../index.php');
}
?>