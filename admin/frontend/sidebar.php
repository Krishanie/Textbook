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
        <a href="index3.html" class="brand-link" style="text-decoration: none;">
            <img src="../admin/site_images/<?= $site_logo ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;"><br>
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

                    <li class="nav-item">
                        <a href="chat.php" class="nav-link">
                            <i class="nav-icon fas fa-comment"></i>
                            <p id="chat_unview_msgs">
                                <?php
                                if ($user_lang == 'en') {
                                ?>
                                    Chat
                                <?php
                                } else {
                                ?>
                                    කතාබස්
                                <?php
                                }
                                ?>
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">SITE EDIT</li>
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


                    <input type="hidden" id="admin_grade_inp" value="<= $admin_grd ?>">


                    <li class="nav-header">BOOK DETAILS</li>
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

                    <li class="nav-header">STUDENT DETAILS</li>
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

                    <li class="nav-item">
                        <a href="give_books.php" class="nav-link">
                            <i class="nav-icon fas fa-redo-alt"></i>
                            <p>
                                <?php
                                if ($user_lang == 'en') {
                                ?>
                                    Give Books For Students
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

                    <li class="nav-header">ADMIN DETAILS</li>
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