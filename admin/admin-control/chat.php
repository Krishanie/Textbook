<?php
include('../../control/db/conn.php');
$date = date('Y-m-d');
session_start();

if (isset($_POST['get_msgs'])) {
  $up_id = $_SESSION['u_id'];
  $html = '';

  $query1 = "SELECT * FROM chat ORDER BY id";
  $query1_run = mysqli_query($conn, $query1);

  if (mysqli_num_rows($query1_run) > 0) {

    $i = 1;
    while ($row1 = mysqli_fetch_assoc($query1_run)) {
      $sender_id = $row1['sender_id'];
      $msg = $row1['msg'];
      $date = $row1['msg_date_time'];

      $month = substr($date, strpos($date, "-") + 1);
      $month = strtok($month, '-');
      $dateObj   = DateTime::createFromFormat('!m', $month);
      $month = $dateObj->format('F');
      $month = strtok($date, '-') . ' ' . $month . ' ' . substr($date, strpos($date, "-") + 4);

      $query2 = "SELECT * FROM teachers WHERE id='$sender_id'";
      $query2_run = mysqli_query($conn, $query2);

      while ($row2 = mysqli_fetch_assoc($query2_run)) {
        $u_img = '../admin/site_images/u_images/' . $row2['img'];
        $u_name = $row2['name'];
      }
      
      $msg_c = '';

      if ($sender_id == 'system') {

        $query3 = "SELECT * FROM book_site_data";
        $query3_run = mysqli_query($conn, $query3);

        while ($row3 = mysqli_fetch_assoc($query3_run)) {
          $u_img = '../admin/site_images/'.$row3['logo'];
          $u_name = 'System';
          $msg_c = 'bg-warning';
        }
        
      }

      if ($sender_id == $up_id) {
        $html .= '<div class="direct-chat-msg right">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-right">' . $u_name . '</span>
              <span class="direct-chat-timestamp float-left">' . $month . '</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="' . $u_img . '" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text '.$msg_c.'">
            ' . $msg . '
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <input type="hidden" id="msg_count" value="' . mysqli_num_rows($query1_run) . '">';
      } else {
        $html .= '<div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-left">' . $u_name . '</span>
              <span class="direct-chat-timestamp float-right">' . $month . '</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="' . $u_img . '" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text '.$msg_c.'">
              ' . $msg . '
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <input type="hidden" id="msg_count" value="' . mysqli_num_rows($query1_run) . '">';
      }
      $i++;
    }
  } else {
    $html .= '<h6 style="text-align: center; margin-top: 50px; margin-bottom: 50px;">No Messages Found!</h6>';
  }

  echo $html;
}


if (isset($_POST['send_msg'])) {

  $up_id = $_SESSION['u_id'];
  $msg = $_POST['msg'];
  date_default_timezone_set("Asia/Colombo");
  $date = date("Y-m-d h:i a");

  $send_msg = "INSERT INTO chat(sender_id, msg, type, msg_date_time) VALUES ('$up_id','$msg','all','$date')";
  $send_msg_run = mysqli_query($conn, $send_msg);

  if ($send_msg_run) {
    echo 200;
  } else {
    echo 400;
  }
}


if (isset($_POST['get_msg_count'])) {
  $up_id = $_SESSION['u_id'];
  $current_view_count = $_POST['c_view_count'];

  $query1 = "SELECT * FROM chat";
  $query1_run = mysqli_query($conn, $query1);

  if (mysqli_num_rows($query1_run) > $current_view_count) {
    $res = [
      'status' => 200,
      'count' => mysqli_num_rows($query1_run) - $current_view_count,
    ];
  } else {
    $res = [
      'status' => 400,
      'count' => 0,
    ];
  }
  echo json_encode($res);
}
