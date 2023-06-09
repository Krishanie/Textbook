<?php
if (isset($_SESSION['u_id'])) {
    include('../control/db/conn.php')
?>
    <?php
    $uid = $_SESSION['u_id'];
    $user_data = "SELECT * FROM teachers WHERE id='$uid'";
    $user_data_run = mysqli_query($conn, $user_data);
    while ($row = $user_data_run->fetch_assoc()) {
        $user_lang = $row["lang"];
        $user_name = $row["name"];
        $user_grade = $row["grade"];
        $user_role = $row["role"];
        $user_img = $row["img"];
    }

    $site_data = "SELECT * FROM book_site_data WHERE id='1'";
    $site_data_run = mysqli_query($conn, $site_data);
    while ($site_datas2 = $site_data_run->fetch_assoc()) {
        $site_name = $site_datas2['name'];
    }
    ?>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
            <center><img src="../admin/site_images/<?= $site_logo ?>" alt="AdminLTE Logo" class="brand-image elevation-3" width="50" height="50" style="opacity: .8; padding:0; margin:10px 0 0 0;"><br></center>

            <a href="#" class="brand-link" style="text-decoration: none;">
                <span class="brand-text font-weight-light" style="width: 50px;"><?= $site_name ?></span>
            </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../admin/site_images/u_images/<?= $user_img ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block" style="text-decoration: none;"><?= $user_name ?><br><?= $user_role ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    <?php
                    $page_data = "SELECT * FROM view_pages";
                    $page_data_run = mysqli_query($conn, $page_data);
                    foreach ($page_data_run as $page) {
                        $row = array();
                        $row[] = $page['id'];
                        $row[] = $page['page_name'];
                        $row[] = $page['page_find'];
                        $row[] = $page['page_view'];
                        $data[] = $row;
                    }

                    ?>

                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Dashboard
                                    <?php
                                    } else {
                                    ?>
                                        උපකරණ පුවරුව
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[0][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Dashboard
                                    <?php
                                    } else {
                                    ?>
                                        උපකරණ පුවරුව
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="site_edit.php" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Site Data
                                    <?php
                                    } else {
                                    ?>
                                        අඩවි දත්ත
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[1][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="site_edit.php" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Site Data
                                    <?php
                                    } else {
                                    ?>
                                        අඩවි දත්ත
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>

                    <input type="hidden" id="admin_grade_inp" value="<= $admin_grd ?>">


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="book_stock.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-book"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Book Stock
                                    <?php
                                    } else {
                                    ?>
                                        පොත් ගබඩාව
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[2][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="book_stock.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-book"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Book Stock
                                    <?php
                                    } else {
                                    ?>
                                        පොත් ගබඩාව
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="students.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන්
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[3][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="students.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන්
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="give_books.php" class="nav-link">
                                <i class="nav-icon fas fa-redo-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Distribution of books to students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන් සඳහා පොත් ලබා දීම
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[4][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="give_books.php" class="nav-link">
                                <i class="nav-icon fas fa-redo-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Distribution of books to students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන් සඳහා පොත් ලබා දීම
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="take_books.php" class="nav-link">
                                <i class="nav-icon fas fa-undo-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Take Books From Students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන්ගෙන් පොත් භාරගන්න
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[5][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="take_books.php" class="nav-link">
                                <i class="nav-icon fas fa-undo-alt"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Take Books From Students
                                    <?php
                                    } else {
                                    ?>
                                        සිසුන්ගෙන් පොත් භාරගන්න
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="admins.php" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Admins
                                    <?php
                                    } else {
                                    ?>
                                        පරිපාලකවරු
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[6][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="admins.php" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Admins
                                    <?php
                                    } else {
                                    ?>
                                        පරිපාලකවරු
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="grade_connection.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-network-wired"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Grade Connection
                                    <?php
                                    } else {
                                    ?>
                                        ශ්‍රේණියේ සම්බන්ධතාවය
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[7][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="grade_connection.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-network-wired"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Grade Connection
                                    <?php
                                    } else {
                                    ?>
                                        ශ්‍රේණියේ සම්බන්ධතාවය
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($user_role == 'main-admin') { ?>
                        <li class="nav-item">
                            <a href="admin-view-pages.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-eye"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Admin View Pages
                                    <?php
                                    } else {
                                    ?>
                                        දෙවන පරිපාලකවරුන්ට පෙනෙන පිටු
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } else if ($data[8][3] == 1) { ?>
                        <li class="nav-item">
                            <a href="admin-view-pages.php" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-eye"></i>
                                <p>
                                    <?php
                                    if ($user_lang == 'en') {
                                    ?>
                                        Admin View Pages
                                    <?php
                                    } else {
                                    ?>
                                        දෙවන පරිපාලකවරුන්ට පෙනෙන පිටු
                                    <?php
                                    }
                                    ?>
                                    <!-- <span class="badge badge-info right">2</span> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>


                    <li class="nav-item">
                        <a href="./admin-control/logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-bold"></i>
                            <p>
                                Logout
                                <!-- <span class="badge badge-info right">2</span> -->
                            </p>
                        </a>
                    </li>

                    <div style="margin-bottom: 100px;"></div>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

<?php
} else {
    header('Location: ../index.php');
}
?>