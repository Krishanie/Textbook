<?php
include('../../control/db/conn.php');
$date = date('Y-m-d');

if (isset($_POST['get_table_data'])) {

    $get_book_data = "SELECT * FROM teachers";
    $get_book_data_run = mysqli_query($conn, $get_book_data);
    $data = array();
    $no = 1;
    if ($get_book_data_run) {
        if (mysqli_num_rows($get_book_data_run) > 0) {
            while ($books = $get_book_data_run->fetch_assoc()) {
                foreach ($get_book_data_run as $book) {
                    $no++;
                    $row = array();
                    $row[] = $book['name'];
                    $row[] = $book['username'];
                    $row[] = $book['role'];
                    $row[] = $book['password'];
                    $row[] = $book["id"];
                    $data[] = $row;
                }
            }
        }
    }

    $output = array(
        "data" => $data,
    );
    //output to json format
    echo json_encode($output);
}


if (isset($_POST['get_edit_admin_data'])) {

    $student_id = $_POST['admin_id'];

    $get_student_data_modal = "SELECT * FROM teachers WHERE id='$student_id'";
    $get_student_data_modal_run = mysqli_query($conn, $get_student_data_modal);

    if ($get_student_data_modal_run) {
        if (mysqli_num_rows($get_student_data_modal_run) > 0) {
            $student_data = mysqli_fetch_array($get_student_data_modal_run);
        }
    }

    $res = [
        'status' => 200,
        'data' => $student_data
    ];

    //output to json format
    echo json_encode($res);
}



if (isset($_POST['edit_data'])) {

    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_username = $_POST['admin_username'];
    $admin_role = $_POST['admin_role'];
    $admin_password = $_POST['admin_password'];

    $update_student = "UPDATE teachers SET name='$admin_name',username='$admin_username',password='$admin_password',role='$admin_role' WHERE id='$admin_id'";
    $update_student_run = mysqli_query($conn, $update_student);

    if ($update_student_run) {
        $res = [
            'status' => 200,
            'msg' => 'Admin Updated Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Admin Not Updated, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['add_data'])) {

    $admin_name = $_POST['admin_name'];
    $admin_username = $_POST['admin_username'];
    $admin_role = $_POST['admin_role'];
    $admin_password = $_POST['admin_password'];

    if ($admin_role == 'main-admin') {
        $img = 'main-default.png';
    }
    if ($admin_role == 'admin') {
        $img = 'default.png';
    } else {
        $img = 'default.png';
    }

    $add_student = "INSERT INTO teachers(name, username, password, img, role) VALUES ('$admin_name','$admin_username','$admin_password', '$img','$admin_role')";
    $add_student_run = mysqli_query($conn, $add_student);

    if ($add_student_run) {
        $res = [
            'status' => 200,
            'msg' => 'Admin Added Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Admin Not Added, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['delete_admin'])) {

    $admin_id = $_POST['admin_id'];

    $delete_stock = "DELETE FROM teachers WHERE id='$admin_id'";
    $delete_stock_run = mysqli_query($conn, $delete_stock);

    if ($delete_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Admin Deleted Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Admin Not Deleted, Try Again Later!',
        ];
    }
    echo json_encode($res);
}
