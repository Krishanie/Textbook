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
    <script src="assets/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> -->
    <!-- Bootstrap 4 -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- overlayScrollbars -->
    <script src="assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="assets/dist/js/pages/dashboard.js"></script>
    <!-- Toastr -->
    <script src="assets/toastr/toastr.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/datatables-buttons/js/buttons.colVis.min.js"></script>
    </body>

    </html>

    <script>
        $(document).ready(function() {
            sessionStorage.setItem("site_lang", 'eng');
        });
        updateUserStatus();
        getMsgCount();
        checkBookCount();

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

        function getMsgCount(data) {
            if (data == 'delete') {
                $('#chat_unview_msgs').html('');
                $('#chat_unview_msgs').html('Chat');
            } else {
                var c_c = sessionStorage.getItem("view_msg_count");
                // console.log('run');
                $.ajax({
                    type: "POST",
                    url: "../admin/admin-control/chat.php",
                    data: {
                        get_msg_count: true,
                        c_view_count: c_c,
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $('#chat_unview_msgs').html('');
                            $('#chat_unview_msgs').html('Chat <span class="badge badge-danger right">' + res.count + '</span>');
                        }
                    }
                });
            }

        }

        function updateUserStatus() {
            $.ajax({
                type: "POST",
                url: "../admin/admin-control/online_status_user.php",
                data: {
                    update_user_status: true
                },
                success: function(response) {

                }
            });
        }

        function checkBookCount() {
            $.ajax({
                type: "POST",
                url: "../admin/admin-control/book-stock.php",
                data: {
                    ch_empty_books: true,
                },
                success: function(response) {
                    if (response != 0) {
                        $('#chat_unview_msgs').html('');
                        $('#chat_unview_msgs').html('Chat <span class="badge badge-danger right">' + response + '</span>');
                    }
                }
            });
        }

        setInterval(function() {
            checkBookCount();
        }, 10000);

        var c_page_url = document.URL;
        if (c_page_url != 'http://localhost/textbook-issue-system/admin/chat.php') {
            // console.log(sessionStorage.getItem("view_msg_count"));
            setInterval(function() {
                getMsgCount('none');
            }, 5000);
        } else {
            getMsgCount('delete');
        }

        setInterval(function() {
            updateUserStatus();
        }, 3000);
    </script>

<?php
} else {
    header('Location: ../index.php');
}
?>