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
                        <h1 class="m-0">Site Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Site Data</li>
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
                        <h3 class="card-title">Site Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="err-msg"></div>
                        <?php
                        $site_data = "SELECT * FROM book_site_data WHERE id='1'";
                        $site_data_run = mysqli_query($conn, $site_data);
                        while ($site_datas = $site_data_run->fetch_assoc()) {
                        ?>
                            <form action="admin-control/site_edit.php" id="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="get_data" value="true">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Site Title</label>
                                        <input type="text" class="form-control" id="site_title" value="<?php echo $site_datas['title'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Site Name</label>
                                        <input type="text" class="form-control" id="site_name" value="<?php echo $site_datas['name'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Site Logo</label>
                                        <input type="file" class="form-control" id="myImage">
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        <button type="submit" class="btn btn-success mt-2" id="edit-btn">Edit</button>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script src="assets/js/jquery.min.js"></script>
    <script>
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
                        }else{
                            window.location.href = '../admin/site_edit.php';
                            errors('success', 'Site Data Edit Successfully!');
                        }
                    }

                });
            }
        });

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
    </script>

<?php
    include('frontend/footer.php');
} else {
    header('Location: ../index.php');
}
?>