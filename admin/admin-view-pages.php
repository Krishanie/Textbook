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
                        <h1 class="m-0">View Pages Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View Pages Details</li>
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
                        <h3 class="card-title">Admin View Pages</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row" id="page_list">


                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php
    include('frontend/footer.php');
} else {
    header('Location: ../index.php');
}
?>

<script>
    var table;
    $(document).ready(function() {

        fetch_pages();

    });

    function hide_btn(data) {
        $.ajax({
            type: "POST",
            url: "admin-control/admin-view-pages.php",
            data: {
                hide_btn: true,
                id: data,
            },
            success: function(response) {
                if(response == 200){
                    fetch_pages();
                }else{
                    message('danger', 'System Error, Contact Site Developers.');
                }
            }
        });
    }

    function show_btn(data) {
        $.ajax({
            type: "POST",
            url: "admin-control/admin-view-pages.php",
            data: {
                show_btn: true,
                id: data,
            },
            success: function(response) {
                if(response == 200){
                    fetch_pages();
                }else{
                    message('danger', 'System Error, Contact Site Developers.');
                }
            }
        });
    }

    function fetch_pages() {

        $('#page_list').html('');

        $.ajax({
            type: "POST",
            url: "admin-control/admin-view-pages.php",
            data: {
                get_page_data: true
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                console.log(res.data);
                $.each(res.data, function(index, val) {
                    if (val[3] == 1) {
                        $('#page_list').append("<div class='col-md-6'>\
                                    <div class='input-group mb-3'>\
                                        <input type='text' class='form-control is-valid' placeholder='" + val[1] + "' aria-label='" + val[1] + "' aria-describedby='button-addon2' disabled>\
                                        <button class='btn btn-danger' type='button' id='button-addon2' onclick='hide_btn(" + val[0] + ");'>Hide</button>\
                                    </div>\
                                </div>");
                    } else {
                        $('#page_list').append("<div class='col-md-6'>\
                                    <div class='input-group mb-3'>\
                                        <input type='text' class='form-control is-invalid' placeholder='" + val[1] + "' aria-label='" + val[1] + "' aria-describedby='button-addon2' disabled>\
                                        <button class='btn btn-success' type='button' id='button-addon2' onclick='show_btn(" + val[0] + ");'>Show</button>\
                                    </div>\
                                </div>");
                    }
                });
            }
        });
    }
</script>