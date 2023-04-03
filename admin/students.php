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
                        <h1 class="m-0">Student Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <?php
        if (isset($_GET['grade'])) {
        ?>
            <input type="hidden" value="1" id="check_if_grade">
        <?php
        } else {
        ?>
            <input type="hidden" value="0" id="check_if_grade">
        <?php
        }
        ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Book Stock Details</h3>
                        <div class="col-md-3 mb-1 float-end">
                            <select id="table_data_grade" class="form-control mb-2">
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
                        <button class="btn btn-primary float-end ml-2" id="add_new_stock" onclick="add_modal()">Add New Student</button>
                        <button class="btn btn-success float-end" onclick="imp_excel()">Import From Excel Sheet</button>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="err-msg"></div>
                        <table class="table table-striped" id="students_table">
                            <thead>
                                <th>Index No</th>
                                <th>Student Name</th>
                                <th>Grade</th>
                                <th>Class</th>
                                <th>Language</th>
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
                    <h4 class="modal-title">Edit Student Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_student_id">
                    <div class="form-group">
                        <label for="">Index No</label>
                        <input type="text" id="edit_index_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Student Name</label>
                        <input type="text" id="edit_student_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Student Language</label>
                        <select id="edit_student_language" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="s">Sinhala</option>
                            <option value="e">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Grade</label>
                                <select id="edit_student_grade" class="form-control">
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
                            <div class="col-md-6">
                                <label for="">Class</label>
                                <input type="text" id="edit_student_class" class="form-control">
                            </div>
                        </div>
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
                    <h4 class="modal-title">Add New Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Index No</label>
                        <input type="text" id="add_index_no" class="form-control" placeholder="Enter Index Number">
                    </div>
                    <div class="form-group">
                        <label for="">Student Name</label>
                        <input type="text" id="add_student_name" class="form-control" placeholder="Enter Student Name">
                    </div>
                    <div class="form-group">
                        <label for="">Student Language</label>
                        <select id="add_student_language" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="s">Sinhala</option>
                            <option value="e">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Select Grade</label>
                                <select id="add_student_grade" class="form-control mb-2">
                                    <option value="0" selected disabled>Select Grade</option>
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
                            <div class="col-md-6">
                                <label for="">Class</label>
                                <input type="text" id="add_student_class" class="form-control" placeholder="Enter Class">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="add_new_student()" class="btn btn-primary">Add</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Import Excel Modal -->
    <div class="modal fade" id="add_excel_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Excel Sheet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="admin-control/students.php" id="form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Select Grade</label>
                            <select id="imp_student_grade" class="form-control mb-2">
                                <option value="0" selected disabled>Select Grade</option>
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
                            <label for="">Excel Sheet</label>
                            <input type="file" id="excel_sheet" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="import_now()" class="btn btn-success" id="excel-import-btn">Import</button>
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
                    <p id="confirm_m_msg">You Want To Delete This Stock?</p>
                    <input type="hidden" id="confirm_val">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirm_m_btn" onclick="delete_student()">Yes, Delete!</button>
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
    var delete_com;
    $(document).ready(function() {
        // console.log($('#admin_grade_inp').val());
        var table_data = {
            get_table_data: true,
            grade: $('#table_data_grade').val(),
        }
        load_table(table_data)
        $('#table_data_grade').on('change', function() {
            var table_data = {
                get_table_data: true,
                grade: $('#table_data_grade').val(),
            }
            load_table(table_data)
        });

    });

    function load_table(table_data) {
        $('#students_table').DataTable().clear().destroy();
        table = $("#students_table").DataTable({
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
                "url": "admin-control/students.php",
                "type": "POST",
                "data": table_data,
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [4],
                    "render": function(data, type, row) {
                        if (row[4] == "s") {
                            return "Sinhala"
                        } else if (row[4] == "e") {
                            return "English";
                        }
                    },
                },
                {
                    "targets": [-1],
                    "render": function(data, type, row) {
                        return "<button class=\"btn btn-success btn-sm\" onclick=\"get_edit_student_data(" + row[5] + ")\">Edit</button><button class=\"btn btn-danger btn-sm\" onclick=\"delete_student_modal(" + row[5] + ")\">Delete</button>"
                    },
                },
            ],
        });
    }

    function get_edit_student_data(id) {

        var data = {
            get_edit_student_data: true,
            student_id: id,
        };

        $.ajax({
            type: "POST",
            url: "admin-control/students.php",
            data: data,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                // console.log(res.data.book_name);
                $('#edit_student_id').val(res.data.id);
                $('#edit_index_no').val(res.data.index_no);
                $('#edit_student_name').val(res.data.name);
                $('#edit_student_language option[value=' + res.data.language + ']').attr('selected', 'selected');
                $('#edit_student_grade option[value=' + res.data.grade + ']').attr('selected', 'selected');
                $('#edit_student_class').val(res.data.class);

                $('#edit_data_modal').modal('show');
            }
        });
    }

    function edit_data() {

        if (validate('edit')) {
            // console.log('success');
            var data = {
                edit_data: true,
                student_id: $('#edit_student_id').val(),
                index_no: $('#edit_index_no').val(),
                student_name: $('#edit_student_name').val(),
                student_language: $('#edit_student_language :selected').val(),
                student_grade: $('#edit_student_grade :selected').val(),
                student_class: $('#edit_student_class').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/students.php",
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
    }

    function add_modal() {
        $('#add_index_no').val("");
        $('#add_student_name').val("");
        $('#add_student_language option[value=0]').attr('selected', 'selected');
        $('#add_student_grade option[value=0]').attr('selected', 'selected');
        $('#add_student_class').val("");

        $('#add_data_modal').modal('show');
    }

    function add_new_student() {
        if (validate('add')) {
            var data = {
                add_data: true,
                index_no: $('#add_index_no').val(),
                student_name: $('#add_student_name').val(),
                student_language: $('#add_student_language :selected').val(),
                student_grade: $('#add_student_grade :selected').val(),
                student_class: $('#add_student_class').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/students.php",
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

    function delete_student_modal(id) {
        $('#confirm_val').val(id);
        var delete_com = $('#confirm_modal').modal('show');
    }

    function delete_student() {

        var data = {
            delete_student: true,
            student_id: $('#confirm_val').val(),
        };

        $.ajax({
            type: "POST",
            url: "admin-control/students.php",
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

    function imp_excel() {
        $('#excel-import-btn').html('Import');
        $('#excel-import-btn').attr('disabled', false);

        $('#add_excel_modal').modal('show');
    }

    function import_now() {
        $('#excel-import-btn').html('Importing...');
        $('#excel-import-btn').attr('disabled', true);

        let form_data = new FormData();
        let img = $("#excel_sheet")[0].files;

        // Check image selected or not
        if ($('#imp_student_grade :selected').val() == 0) {
            $('#excel-import-btn').html('Import');
            $('#excel-import-btn').attr('disabled', false);

            message('warning', '"Grade" Field Required!');
        } else if ($("#excel_sheet").val() == "") {
            $('#excel-import-btn').html('Import');
            $('#excel-import-btn').attr('disabled', false);

            message('warning', 'Please Select Excel File!');
        } else {
            form_data.append('excel_import', true);
            form_data.append('grade', $('#imp_student_grade :selected').val());
            form_data.append('excel_sheet', img[0]);

            $.ajax({
                url: 'admin-control/students.php',
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#excel-import-btn').html('Import');
                    $('#excel-import-btn').attr('disabled', false);

                    var res = jQuery.parseJSON(response);
                    console.log(response);
                    if (res.status == 400) {
                        message('danger', res.msg);
                    } else {
                        $('#add_excel_modal').modal('hide');
                        reload_table();
                        message('success', res.msg);
                        if (res.num_exists > 0) {
                            message('info', 'This Students Are Already Exists!<br>' + res.exists);
                        }
                    }
                },
                complete: function(data) {
                    $('#form')[0].reset(); // this will reset the form fields
                }

            });
        }
    }

    function validate(type) {
        if (type == 'edit') {
            var input_n = 'edit_';
        } else {
            var input_n = 'add_';
        }

        if ($('#' + input_n + 'index_no').val() == 0) {
            message('warning', '"Index No" Field Required!');
        } else if ($('#' + input_n + 'student_name').val() == 0) {
            message('warning', '"Student Name" Field Required!');
        } else if ($('#' + input_n + 'student_language :selected').val() == 0) {
            message('warning', '"Student Language" Field Required!');
        } else if ($('#' + input_n + 'student_grade :selected').val() == 0) {
            message('warning', '"Student Grade" Field Required!');
        } else if ($('#' + input_n + 'student_class').val() == 0) {
            message('warning', '"Student Class" Field Required!');
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

    function key(event) {
        // console.log(event.which);
        if (event.which == 13) {
            if ($('#confirm_modal').is(':visible')) {
                delete_student();
            }
            if ($('#add_data_modal').is(':visible')) {
                add_new_student();
            }
            if ($('#add_excel_modal').is(':visible')) {
                import_now();
            }
            if ($('#edit_data_modal').is(':visible')) {
                edit_data();
            }
        }
    }
</script>