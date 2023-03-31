<?php
include('../../control/db/conn.php');

if (isset($_POST['get_data'])) {

    $title = $_POST['site_title'];
    $name = $_POST['site_name'];

    if (isset($_FILES['my_image'])) {
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error    = $_FILES['my_image']['error'];

        if ($error === 0) {
            if ($img_size > 1000000) {
                $em = "Sorry, your file is too large.";
                $res = [
                    'status' => 300,
                    'msg' => $em,
                ];
                echo json_encode($res);
                exit();
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {

                    $new_img_name = uniqid("site_logo-", true) . '.' . $img_ex_lc;

                    $img_upload_path = "../site_images/" . $new_img_name;

                    move_uploaded_file($tmp_name, $img_upload_path);

                    $get_pre = "SELECT * FROM book_site_data WHERE id=1";
                    $get_pre_run = mysqli_query($conn, $get_pre);
                    while ($pre_l = $get_pre_run->fetch_assoc()) {
                        $pre_logo = $pre_l['logo'];
                    }

                    $query = "UPDATE `book_site_data` SET `name`='$name',`title`='$title',`logo`='$new_img_name'  WHERE id=1";
                    $query_run = mysqli_query($conn, $query);

                    $res = [
                        'status' => 200,
                    ];

                    unlink('../site_images/'.$pre_logo);

                    echo json_encode($res);
                    exit();
                } else {
                    $em = "You can't upload files of this type";
                    $res = [
                        'status' => 300,
                        'msg' => $em,
                    ];
                    echo json_encode($res);
                    exit();
                }
            }
        } else {
            $em = "unknown error occurred!";
            $res = [
                'status' => 300,
                'msg' => $em,
            ];
            echo json_encode($res);
            exit();
        }
    } else {
        $query = "UPDATE `book_site_data` SET `name`='$name',`title`='$title' WHERE id=1";
        $query_run = mysqli_query($conn, $query);

        $res = [
            'status' => 200,
        ];

        echo json_encode($res);
        exit();
    }
}
