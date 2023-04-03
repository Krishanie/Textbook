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
                        <h1 class="m-0">Admin Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="nav-link text-primary" href="#">Home</a></li>
                            <li class="breadcrumb-item active">Admin Details</li>
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
                        <h3 class="card-title">Admin Details</h3>
                        <button class="btn btn-primary float-end" id="add_new_stock" onclick="add_modal()">Add New Admin</button>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="err-msg"></div>
                        <table class="table table-striped" id="admins_table">
                            <thead>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Grade</th>
                                <th class="text-center">Action</th>
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
                    <h4 class="modal-title">Edit Admin Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_admin_id">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="edit_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" id="edit_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Admin Role</label>
                        <select id="edit_admin_role" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="main-admin">Main-admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Grade</label>
                        <select id="edit_admin_grades" class="form-control">
                            <option value="0" disabled selected>Select Grade</option>
                            <option value="all">ALL</option>
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
                        <label for="">Password</label>
                        <input type="text" id="edit_password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="edit_data()" class="btn btn-success">Edit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Add Data Modal -->
    <div class="modal fade" id="add_data_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="add_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" id="add_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Admin Role</label>
                        <select id="add_admin_role" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="main-admin">Main-admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Grade</label>
                        <select id="add_admin_grades" class="form-control">
                            <option value="0" disabled selected>Select Grade</option>
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
                        <label for="">Password</label>
                        <input type="text" id="add_password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="add_new_admin()" class="btn btn-primary">Add</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Delete Confirm Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="confirm_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are You Sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="confirm_m_msg">You Want To Delete This Admin?</p>
                    <input type="hidden" id="confirm_val">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirm_m_btn" onclick="delete_admin()">Yes, Delete!</button>
                </div>
            </div>
        </div>
    </div>

<?php
    include('frontend/footer.php');
} else {
    header('Location: ../index.php');
}
?>

<script>
    var table;
    $(document).ready(function() {

        table = $("#admins_table").DataTable({
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
                "url": "admin-control/admins.php",
                "type": "POST",
                "data": {
                    get_table_data: true,
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [-1],
                "render": function(data, type, row) {
                    return "<div class=\"d-flex justify-content-center\"><button class=\"btn btn-success btn-sm\" onclick=\"get_edit_admin_data(" + row[5] + ")\">Edit</button><button class=\"btn btn-danger btn-sm ml-3\" onclick=\"delete_admin_modal(" + row[5] + ")\">Delete</button></div>"
                },
            }, ],
        });

    });

    function get_edit_admin_data(id) {

        var data = {
            get_edit_admin_data: true,
            admin_id: id,
        };

        $.ajax({
            type: "POST",
            url: "admin-control/admins.php",
            data: data,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                console.log(res.data.book_name);
                $('#edit_admin_id').val(res.data.id);
                $('#edit_name').val(res.data.name);
                $('#edit_username').val(res.data.username);
                $('#edit_password').val(res.data.password);
                $('#edit_admin_role option[value=' + res.data.role + ']').attr('selected', 'selected');
                if (res.data.grade == 'all') {
                    $('#edit_admin_grades option[value="all"]').attr('selected', 'selected');
                } else {
                    $('#edit_admin_grades option[value=' + res.data.grade + ']').attr('selected', 'selected');
                }

                $('#edit_data_modal').modal('show');
            }
        });
    }

    function edit_data() {

        if (validate('edit')) {
            // console.log('success');
            var data = {
                edit_data: true,
                admin_id: $('#edit_admin_id').val(),
                admin_name: $('#edit_name').val(),
                admin_username: $('#edit_username').val(),
                admin_role: $('#edit_admin_role :selected').val(),
                admin_grade: $('#edit_admin_grades :selected').val(),
                admin_password: $('#edit_password').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/admins.php",
                data: data,
                success: function(response) {
                    console.log(response);
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
    }

    function add_modal() {
        $('#edit_name').val();
        $('#edit_username').val();
        $('#edit_admin_role option[value=0]').attr('selected', 'selected');
        $('#edit_admin_grades option[value=0]').attr('selected', 'selected');
        $('#edit_password').val();

        $('#add_data_modal').modal('show');
    }

    function add_new_admin() {
        if (validate('add')) {
            var data = {
                add_data: true,
                admin_name: $('#add_name').val(),
                admin_username: $('#add_username').val(),
                admin_role: $('#add_admin_role :selected').val(),
                admin_grade: $('#add_admin_grades :selected').val(),
                admin_password: $('#add_password').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/admins.php",
                data: data,
                success: function(response) {
                    // console.log(response);
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#add_data_modal').modal('hide');
                        reload_table();
                        message('success', res.msg);

                    } else {
                        message('danger', res.msg);
                    }
                }
            });
        }
    }

    function delete_admin_modal(id) {
        $('#confirm_val').val(id);
        $('#confirm_modal').modal('show');
    }

    function delete_admin() {

        var data = {
            delete_admin: true,
            admin_id: $('#confirm_val').val(),
        };

        $.ajax({
            type: "POST",
            url: "admin-control/admins.php",
            data: data,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                // console.log(res.data.book_name);
                if (res.status == 200) {
                    $('#confirm_modal').modal('hide');
                    reload_table();
                    message('success', res.msg);

                } else {
                    message('danger', res.msg);
                }
            }
        });
    }

    function validate(type) {
        if (type == 'edit') {
            var input_n = 'edit_';
        } else {
            var input_n = 'add_';
        }

        if ($('#' + input_n + 'name').val() == 0) {
            message('warning', '"Name" Field Required!');
        } else if ($('#' + input_n + 'username').val() == 0) {
            message('warning', '"Username" Field Required!');
        } else if ($('#' + input_n + 'admin_role :selected').val() == 0) {
            message('warning', '"Admin Role" Field Required!');
        } else if ($('#' + input_n + 'admin_grades :selected').val() == 0) {
            message('warning', '"Admin Grade" Field Required!');
        } else if ($('#' + input_n + 'password').val() == 0) {
            message('warning', '"Password" Field Required!');
        } else {
            return true;
        }
    }

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    function reload_table() {
        table.ajax.reload(null, false);
    }
</script>