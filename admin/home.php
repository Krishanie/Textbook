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
                        <h1 class="m-0" id="tr5">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" id="tr6">Home</a></li>
                            <li class="breadcrumb-item">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php
                                $total_students = "SELECT * FROM students";
                                $total_students_run = mysqli_query($conn, $total_students);
                                $total_students_val = mysqli_num_rows($total_students_run);
                                ?>
                                <h3><?= $total_students_val ?></h3>
                                <p id="tr1">Total Students</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                $total_teachers = "SELECT * FROM teachers";
                                $total_teachers_run = mysqli_query($conn, $total_teachers);
                                $total_teachers_val = mysqli_num_rows($total_teachers_run);
                                ?>
                                <h3><?= $total_teachers_val ?></h3>
                                <p id="tr2">Total Teachers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6">-->
                        <!-- small box -->
                      <!--  <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                $grd = "";
                                $total_books_val = 0;
                                for ($i = 1; $i < 10; $i++) {
                                    $grd = "grd" . $i . "_books";
                                    $total_books = "SELECT * FROM $grd";
                                    $total_books_run = mysqli_query($conn, $total_books);
                                    $total_books_count = mysqli_num_rows($total_books_run);
                                    $total_books_val = $total_books_val + $total_books_count;
                                }
                                ?>
                                <h3><?= $total_books_val ?></h3>

                                <p id="tr3"></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> -->


                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6">
            <!-- small box -->
                    <!--<div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p id="tr4"></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
            </div><!-- /.container-fluid -->
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
    $(document).ready(function() {
       
    });
</script>