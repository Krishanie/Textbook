<?php
session_start();
if (isset($_SESSION['u_id'])) {
    include('frontend/header.php');
    include('frontend/sidebar.php');
?>

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Grade Book Connection</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Grade Book Connection</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grade Book Connection</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-striped" id="grade_connection_table">
                            <thead>
                                <th>Grade</th>
                                <th>Take Book Grade</th>
                                <th>Give Book Grade</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>001</td>
                                    <td>Buddhism</td>
                                    <td>S</td>
                                    <td>222</td>
                                    <td>222</td>
                                    <td>222</td>
                                    <td>222</td>
                                </tr> -->
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Edit Data Modal -->
    <div class="modal fade" id="edit_data_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Grade Book Connection</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_book_grade_conn_id">

                    <div class="form-group">
                        <label for="">Take Book Grade</label>
                        <select id="grade_connection_take" class="form-control">
                            <option value="none">None</option>
                            <?php
                            $grade_data = "SELECT * FROM available_grades";
                            $grade_data_run = mysqli_query($conn, $grade_data);
                            $i = 1;
                            foreach ($grade_data_run as $grade) {
                            ?>
                                <option value="<?= $grade['value'] ?>" id="grade_get_<?= $i ?>"><?= $grade['grade'] ?></option>

                            <?php
                                $i = $i + 1;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Give Book Grade</label>
                        <select id="grade_connection_give" class="form-control">
                            <option value="none">None</option>
                            <?php
                            $grade_data = "SELECT * FROM available_grades";
                            $grade_data_run = mysqli_query($conn, $grade_data);
                            $i = 1;
                            foreach ($grade_data_run as $grade) {
                            ?>
                                <option value="<?= $grade['value'] ?>" id="grade_get_<?= $i ?>"><?= $grade['grade'] ?></option>

                            <?php
                                $i = $i + 1;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="edit_grade_conn()" class="btn btn-success">Edit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            var table_data = {
                get_table_data: true
            }
            load_table(table_data);

        });

        $("#edit-btn").click(function(e) {
            e.preventDefault();

            let form_data = new FormData();
            let img = $("#myImage")[0].files;

            // Check image selected or not
            if (validate()) {
                form_data.append('get_data', $('#get_data').val());
                form_data.append('site_title', $('#site_title').val());
                form_data.append('site_name', $('#site_name').val());
                if (img.length > 0) {
                    form_data.append('my_image', img[0]);
                }

                $.ajax({
                    url: 'admin-control/site_edit.php',
                    type: 'post',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var res = jQuery.parseJSON(response);

                        if (res.status == 300) {
                            errors('danger', res.msg);
                        } else {
                            window.location.href = '../admin/site_edit.php';
                            errors('success', 'Grade Book Connection Edit Successfully!');
                        }
                    }

                });
            }
        });

        function load_table(table_data) {
            $('#grade_connection_table').DataTable().clear().destroy();
            table = $("#grade_connection_table").DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "sEmptyTable": "No Data Found"
                },
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "admin-control/grade-connection.php",
                    "type": "POST",
                    "data": table_data,
                },
                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [-1],
                    "render": function(data, type, row) {
                        return "<button class=\"btn btn-success btn-sm\" onclick=\"get_edit_grade_conn_data(" + row[3] + ")\">Edit</button>"
                    },
                }, ],
            });
        }

        function get_edit_grade_conn_data(id) {
            var data = {
                get_edit_grade_conn_data: true,
                grade_conn_id: id,
            };

            $.ajax({
                type: "POST",
                url: "admin-control/grade-connection.php",
                data: data,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    // console.log(response);
                    $('#edit_book_grade_conn_id').val(res.data.id);
                    $('#grade_connection_give option[value=' + res.data.give_grade + ']').attr('selected', 'selected');
                    $('#grade_connection_take option[value=' + res.data.take_grade + ']').attr('selected', 'selected');

                    $('#edit_data_modal').modal('show');
                }
            });
        }

        function edit_grade_conn() {
            var data = {
                edit_data: true,
                conn_id: $('#edit_book_grade_conn_id').val(),
                give_grade: $('#grade_connection_give :selected').val(),
                take_grade: $('#grade_connection_take :selected').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/grade-connection.php",
                data: data,
                success: function(response) {
                    // console.log(response);
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#edit_data_modal').modal('hide');
                        reload_table();
                        message('success', res.msg);

                    } else {
                        message('danger', res.msg);
                    }
                }
            });
        }

        function validate() {
            if ($('#site_title').val() == "") {
                errors('danger', 'Site Title Required!');
            } else if ($('#site_name').val() == "") {
                errors('danger', 'Site Name Required!');
            } else {
                errors(0);
                return true;
            }
        }

        function errors(type, msg) {
            if (type == 0) {
                $('#err-msg').html("");
                $('#err-msg').removeClass();
                $('#err-msg').css('display', 'none');
            } else {
                $('#err-msg').html(msg);
                $('#err-msg').removeClass();
                $('#err-msg').addClass("alert alert-" + type);
                $('#err-msg').css('display', 'block');
            }
        }

        function reload_table() {
            table.ajax.reload(null, false);
        }
    </script>

<?php
    include('frontend/footer.php');
} else {
    header('Location: ../index.php');
}
?>