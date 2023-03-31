<?php
include('../../control/db/conn.php');

if (isset($_POST['get_table_data'])) {

    $get_grade_connection_data = "SELECT * FROM grade_connections";
    $get_grade_connection_data_run = mysqli_query($conn, $get_grade_connection_data);
    $data = array();
    $no = 1;
    if ($get_grade_connection_data_run) {
        if (mysqli_num_rows($get_grade_connection_data_run) > 0) {
            while ($books = $get_grade_connection_data_run->fetch_assoc()) {
                foreach ($get_grade_connection_data_run as $book) {
                    $no++;
                    $row = array();

                    $bn_grd = $book['grade_name'];
                    $get_grade_name = "SELECT * FROM available_grades WHERE value='$bn_grd'";
                    $get_grade_name_run = mysqli_query($conn, $get_grade_name);
                    while ($grd_cnt = $get_grade_name_run->fetch_assoc()) {
                        $grd_grade_name = $grd_cnt['grade'];
                    }

                    $row[] = $grd_grade_name;

                    $tk_grd = $book['take_grade'];
                    $get_grade_name = "SELECT * FROM available_grades WHERE value='$tk_grd'";
                    $get_grade_name_run = mysqli_query($conn, $get_grade_name);
                    while ($grd_cnt = $get_grade_name_run->fetch_assoc()) {
                        $grd_take_grade = $grd_cnt['grade'];
                    }
                    if($tk_grd == 'none'){
                        $grd_take_grade = 'None';
                    }

                    $row[] = $grd_take_grade;

                    $gv_grd = $book['give_grade'];
                    $get_grade_name = "SELECT * FROM available_grades WHERE value='$gv_grd'";
                    $get_grade_name_run = mysqli_query($conn, $get_grade_name);
                    while ($grd_cnt = $get_grade_name_run->fetch_assoc()) {
                        $grd_give_grade = $grd_cnt['grade'];
                    }
                    if($gv_grd == 'none'){
                        $grd_give_grade = 'None';
                    }

                    $row[] = $grd_give_grade;

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

if (isset($_POST['get_edit_grade_conn_data'])) {

    $grade_conn_id = $_POST['grade_conn_id'];

    $get_book_data_modal = "SELECT * FROM grade_connections WHERE id='$grade_conn_id'";
    $get_book_data_modal_run = mysqli_query($conn, $get_book_data_modal);

    if ($get_book_data_modal_run) {
        if (mysqli_num_rows($get_book_data_modal_run) > 0) {
            $stock_data = mysqli_fetch_array($get_book_data_modal_run);
        }
    }

    $res = [
        'status' => 200,
        'data' => $stock_data
    ];

    //output to json format
    echo json_encode($res);
}


if (isset($_POST['edit_data'])) {

    $conn_id = $_POST['conn_id'];

    $give_grade = $_POST['give_grade'];
    $take_grade = $_POST['take_grade'];

    $update_stock = "UPDATE grade_connections SET take_grade='$take_grade',give_grade='$give_grade' WHERE id='$conn_id'";
    $update_stock_run = mysqli_query($conn, $update_stock);

    if ($update_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Connection Updated Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Connection Not Updated, Try Again Later!',
        ];
    }
    echo json_encode($res);
}

