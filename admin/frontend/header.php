<?php
if (isset($_SESSION['u_id'])) {
    include('../control/db/conn.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        $site_data = "SELECT * FROM book_site_data WHERE id='1'";
        $site_data_run = mysqli_query($conn, $site_data);
        while ($site_datas2 = $site_data_run->fetch_assoc()) {
            $site_title = $site_datas2['title'];
            $site_logo = $site_datas2['logo'];
        }
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $site_title ?></title>
        <link rel="icon" type="image/x-icon" href="../admin/site_images/<?= $site_logo ?>">

        <!-- Google Font: Source Sans Pro -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <!-- iCheck -->
        <link rel="stylesheet" href="assets/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="assets/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed" onkeyup="key(event);">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>


                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <select id="full_site_lang" class="form-control me-4">
                        <option value="en" selected>ENG</option>
                        <option value="sin">SIN</option>
                    </select>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Get First Grade Only -->
            <?php
            $grade_data = "SELECT * FROM available_grades ORDER BY id DESC";
            $grade_data_run = mysqli_query($conn, $grade_data);
            while ($link_row = mysqli_fetch_assoc($grade_data_run)) {
                $first_grade_only = $link_row['value'];
            }
            ?>
            <input type="hidden" id="first_grade_only" value="<?= $first_grade_only ?>">



            <input type="hidden" id="msg_view_count">



        <?php
    } else {
        header('Location: ../index.php');
    }
        ?>