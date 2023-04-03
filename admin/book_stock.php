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
                        <h1 class="m-0">Book Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="nav-link text-primary" href="#">Home</a></li>
                            <li class="breadcrumb-item active">Book Stock</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- <?php
                if (isset($_GET['grade'])) {
                ?>
            <input type="hidden" value="1" id="check_if_grade">
        <?php
                } else {
        ?>
            <input type="hidden" value="0" id="check_if_grade">
        <?php
                }
        ?> -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Book Stock Details</h3>
                        <div class="col-md-3 float-end">
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
                        <button class="btn btn-primary float-end" id="add_new_stock" onclick="add_modal()">Add New Stock</button>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="err-msg"></div>
                        <table class="table table-striped" id="book_stock_table">
                            <thead>
                                <th>Serial ID</th>
                                <th>Book Name</th>
                                <th>Language</th>
                                <th>Studing Students</th>
                                <th>Extra Requests</th>
                                <th>Available In Stock</th>
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
                    <h4 class="modal-title">Edit Stock Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_book_stock_id">
                    <input type="hidden" id="edit_book_grade" value="normal">
                    <div class="form-group">
                        <label for="">Serial ID</label>
                        <input type="text" id="edit_s_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Book Name</label>
                        <input type="text" id="edit_book_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Book Language</label>
                        <select id="edit_book_language" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="s">Sinhala</option>
                            <option value="e">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Studing Students Count</label>
                                <input type="text" id="edit_book_study_students" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Leftover Books</label>
                                <input type="text" id="edit_book_leftover" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Extra Requests</label>
                                <input type="text" id="edit_book_extra_requests" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Total Books</label>
                                <input type="text" id="edit_book_total" class="form-control">
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
                    <h4 class="modal-title">Add New Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Grade</label>
                        <select id="add_book_grade" class="form-control">
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
                        <label for="">Serial ID</label>
                        <input type="text" id="add_s_id" class="form-control" placeholder="Enter Serial ID">
                    </div>
                    <div class="form-group">
                        <label for="">Book Name</label>
                        <input type="text" id="add_book_name" class="form-control" placeholder="Enter Book Name">
                    </div>
                    <div class="form-group">
                        <label for="">Book Language</label>
                        <select id="add_book_language" class="form-control">
                            <option value="0" disabled selected>Select Language</option>
                            <option value="s">Sinhala</option>
                            <option value="e">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Studing Students Count</label>
                                <input type="text" id="add_book_study_students" class="form-control" placeholder="Enter Studing Students">
                            </div>
                            <div class="col-md-6">
                                <label for="">Leftover Books</label>
                                <input type="text" id="add_book_leftover" class="form-control" placeholder="Enter Leftover Books">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Extra Requests</label>
                                <input type="text" id="add_book_extra_requests" class="form-control" placeholder="Enter Extra Books">
                            </div>
                            <div class="col-md-6">
                                <label for="">Total Books</label>
                                <input type="text" id="add_book_total" class="form-control" placeholder="Enter Total Books">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="add_new_stock()" class="btn btn-primary">Add</button>
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
                    <button type="button" class="btn btn-danger" id="confirm_m_btn" onclick="delete_stock()">Yes, Delete!</button>
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
        $('#book_stock_table').DataTable().clear().destroy();
        table = $("#book_stock_table").DataTable({
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
                "url": "admin-control/book-stock.php",
                "type": "POST",
                "data": table_data,
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [2],
                    "render": function(data, type, row) {
                        if (row[2] == "s") {
                            return "Sinhala"
                        } else if (row[2] == "e") {
                            return "English";
                        }
                    },
                },
                {
                    "targets": [-1],
                    "render": function(data, type, row) {
                        return "<button class=\"btn btn-success btn-sm\" onclick=\"get_edit_stock_data(" + row[6] + ")\">Edit</button><button class=\"btn btn-danger btn-sm\" onclick=\"delete_stock_modal(" + row[6] + ")\">Delete</button>"
                    },
                },
            ],
        });
    }

    function get_edit_stock_data(id) {

        var data = {
            get_edit_stock_data: true,
            stock_id: id,
        };

        $.ajax({
            type: "POST",
            url: "admin-control/book-stock.php",
            data: data,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                // console.log(response);
                $('#edit_s_id').val(res.data.book_serial_id);
                $('#edit_book_name').val(res.data.book_name);
                $('#edit_book_language option[value=' + res.data.book_language + ']').attr('selected', 'selected');
                $('#edit_book_study_students').val(res.data.studing_students);
                $('#edit_book_leftover').val(res.data.leftover_books);
                $('#edit_book_extra_requests').val(res.data.extra_requests);
                $('#edit_book_total').val(res.data.total_books);
                $('#edit_book_stock_id').val(res.data.book_id);

                $('#edit_data_modal').modal('show');
            }
        });
    }

    function edit_data() {

        if (validate('edit')) {
            // console.log('success');
            var data = {
                edit_data: true,
                s_id: $('#edit_s_id').val(),
                book_name: $('#edit_book_name').val(),
                book_language: $('#edit_book_language :selected').val(),
                book_study_students: $('#edit_book_study_students').val(),
                book_leftover: $('#edit_book_leftover').val(),
                book_extra_requests: $('#edit_book_extra_requests').val(),
                book_total: $('#edit_book_total').val(),
                book_stock_id: $('#edit_book_stock_id').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/book-stock.php",
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
        $('#add_book_grade option[value=0]').attr('selected', 'selected');
        $('#add_s_id').val("");
        $('#add_book_name').val("");
        $('#add_book_language option[value=0]').attr('selected', 'selected');
        $('#add_book_study_students').val("");
        $('#add_book_leftover').val("");
        $('#add_book_extra_requests').val("");
        $('#add_book_total').val("");
        $('#add_book_stock_id').val("");

        $('#add_data_modal').modal('show');
    }

    function add_new_stock() {
        if (validate('add')) {
            var data = {
                add_data: true,
                stock_table: $('#add_book_grade :selected').val(),
                s_id: $('#add_s_id').val(),
                book_name: $('#add_book_name').val(),
                book_language: $('#add_book_language :selected').val(),
                book_study_students: $('#add_book_study_students').val(),
                book_leftover: $('#add_book_leftover').val(),
                book_extra_requests: $('#add_book_extra_requests').val(),
                book_total: $('#add_book_total').val(),
                book_stock_id: $('#add_book_stock_id').val(),
            }

            $.ajax({
                type: "POST",
                url: "admin-control/book-stock.php",
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

    function delete_stock_modal(id) {
        $('#confirm_val').val(id);
        $('#confirm_modal').modal('show');
    }

    function delete_stock() {

        var data = {
            delete_stock: true,
            stock_id: $('#confirm_val').val(),
            stock_table: getUrlParameter('grade'),
        };

        $.ajax({
            type: "POST",
            url: "admin-control/book-stock.php",
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

        if ($('#' + input_n + 's_id').val() == 0) {
            message('warning', '"Serial ID" Field Required!');
        } else if ($('#' + input_n + 'book_grade :selected').val() == 0) {
            message('warning', '"Book Grade" Field Required!');
        } else if ($('#' + input_n + 'book_name').val() == 0) {
            message('warning', '"Book Name" Field Required!');
        } else if ($('#' + input_n + 'book_language :selected').val() == 0) {
            message('warning', '"Book Language" Field Required!');
        } else if ($('#' + input_n + 'book_study_students').val() == 0) {
            message('warning', '"Studing Student Count" Field Required!');
        } else if ($('#' + input_n + 'book_leftover').val() == 0) {
            message('warning', '"Leftover Books" Field Required!');
        } else if ($('#' + input_n + 'book_extra_requests').val() == 0) {
            message('warning', '"Extra Requests" Field Required!');
        } else if ($('#' + input_n + 'book_total').val() == 0) {
            message('warning', '"Total Books" Field Required!');
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
                delete_stock();
            }
            if ($('#edit_data_modal').is(':visible')) {
                edit_data();
            }
            if ($('#add_data_modal').is(':visible')) {
                add_new_stock();
            }
        }
    }
</script>