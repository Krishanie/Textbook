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
                        <h1 class="m-0">Give Book Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="nav-link text-primary" href="#">Home</a></li>
                            <li class="breadcrumb-item active">Give Book Details</li>
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
                        <h3 class="card-title">Give Book For Students | සිසුන් වෙත පොත් ලබා දීම.</h3>
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
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="err-msg"></div>
                        <table class="table table-striped" id="give_book_table">
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
    <div class="modal fade" id="give_books_modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="overlay" id="overlay_modal">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Give Books</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="book_data_stu_id">
                    <div id="student_book_table" class="row row-cols-12 row-cols-lg-8 g-2 g-lg-1 d-flex justify-content-center">


                    </div>
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
        $('#give_book_table').DataTable().clear().destroy();
        table = $("#give_book_table").DataTable({
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
                "url": "admin-control/give-books.php",
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
                        return "<button class=\"btn btn-info btn-sm\" onclick=\"fetch_book_data(" + row[5] + ")\">Book Data</button>"
                    },
                },
            ],
        });
    }

    function check(id, book_id) {
        $('#overlay_modal').css('display', 'block');
        var data = {
            check_give_book: true,
            grade: $('#table_data_grade').val(),
            book_id: book_id,
            ch_id: id,
            stu_id: $('#book_data_stu_id').val(),
        }

        $.ajax({
            type: "POST",
            url: "admin-control/give-books.php",
            data: data,
            success: function(response) {
                // console.log(response);
                $('#overlay_modal').css('display', 'none');
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    fetch_book_data(res.stu_id)
                } else {
                    message('danger', 'System Error, Contact Creator of this Site!')
                }
            }
        });
    }

    function uncheck(id, book_id) {
        $('#overlay_modal').css('display', 'block');
        var data = {
            uncheck_give_book: true,
            grade: $('#table_data_grade').val(),
            book_id: book_id,
            ch_id: id,
            stu_id: $('#book_data_stu_id').val(),
        }

        $.ajax({
            type: "POST",
            url: "admin-control/give-books.php",
            data: data,
            success: function(response) {
                // console.log(response);
                $('#overlay_modal').css('display', 'none');
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    fetch_book_data(res.stu_id)
                } else {
                    message('danger', 'System Error, Contact Creator of this Site!')
                }
            }
        });
    }

    function fetch_book_data(id) {

        $('#student_book_table').html("");
        $('#give_books_modal').modal('show');
        $('#book_data_stu_id').val(id);
        $('#overlay_modal').css('display', 'block');

        var data = {
            get_student_book_data: true,
            grade: $('#table_data_grade').val(),
            id: id,
        }

        $.ajax({
            type: "POST",
            url: "admin-control/give-books.php",
            data: data,
            success: function(response) {
                // console.log(response);
                $('#overlay_modal').css('display', 'none');
                $('#student_book_table').html(response);
            }
        });
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
</script>