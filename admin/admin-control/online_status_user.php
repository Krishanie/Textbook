<?php
include('../../control/db/conn.php');
session_start();


if (isset($_POST['update_user_status'])) {

    $up_id = $_SESSION['u_id'];
    $time = time() + 10;

    $query2 = "UPDATE teachers set last_login='$time' WHERE id='$up_id'";
    $query2_run = mysqli_query($conn, $query2);
}


if (isset($_POST['get_user_status_for_chat'])) {

    $up_id = $_SESSION['u_id'];
    $time = time();
    $html = '';

    $query3 = "SELECT * FROM teachers";
    $query3_run = mysqli_query($conn, $query3);

    $i = 1;
    while ($row = mysqli_fetch_assoc($query3_run)) {
        $img = $row['img'];
        $name = $row['name'];

        $status = 'Offline';
        $class = 'text-danger';
        if ($row['last_login'] > $time) {
            $status = 'Online';
            $class = 'text-success';
        }
        $html .= '<div class="row">
            <div class="col-md-3 col-sm-2">
              <img src="../admin/site_images/u_images/' . $img . '" alt="user" style="width: 55px;" class="img-circle">
            </div>
            <div class="col-md-7 col-sm-7">
              <b><a href="#" class="profile-link" style="font-size: 18px; margin: 0; padding: 0;">'.$name.'</a></b>
              <p style="font-size: 15px; margin: 0; padding: 0;"><i class="fas fa-circle '.$class.'"></i> '.$status.'</p>
              <p class="text-muted" style="font-size: 13px; margin: 0; padding: 0;">...</p>
            </div>
          </div>
          <hr>';
        $i++;
    }

    echo $html;
}
