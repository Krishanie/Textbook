<?php
include('db/conn.php');
session_start();

if (isset($_POST['get_data'])) {

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM teachers WHERE username='$uname'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {

            while ($row = $query_run->fetch_assoc()) {
                $c_password = $row["password"];
                $u_id = $row["id"];
                $name = $row["name"];
            }

            if ($pass == $c_password) {
                $_SESSION['u_id'] = $u_id;
                $_SESSION['name'] = $name;
                echo 200;
            } else {
                echo 400;
            }
        } else {
            echo 400;
        }
    } else {
        echo 300;
    }
}
