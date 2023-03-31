<?php
include('../../control/db/conn.php');

if (isset($_POST['get_table_data'])) {

    $grade = $_POST['grade'];

    $get_book_data = "SELECT * FROM book_stock WHERE book_grade='$grade'";
    $get_book_data_run = mysqli_query($conn, $get_book_data);
    $data = array();
    $no = 1;
    if ($get_book_data_run) {
        if (mysqli_num_rows($get_book_data_run) > 0) {
            while ($books = $get_book_data_run->fetch_assoc()) {
                foreach ($get_book_data_run as $book) {
                    $no++;
                    $row = array();
                    $row[] = $book['book_serial_id'];
                    $row[] = $book['book_name'];
                    $row[] = $book['book_language'];
                    $row[] = $book['studing_students'];
                    $row[] = $book['extra_requests'];
                    $row[] = $book['leftover_books'];
                    $row[] = $book["book_id"];
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


if (isset($_POST['get_edit_stock_data'])) {

    $stock_id = $_POST['stock_id'];

    $get_book_data_modal = "SELECT * FROM book_stock WHERE book_id='$stock_id'";
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

    $book_stock_id = $_POST['book_stock_id'];

    $s_id = $_POST['s_id'];
    $book_name = $_POST['book_name'];
    $book_language = $_POST['book_language'];
    $book_study_students = $_POST['book_study_students'];
    $book_leftover = $_POST['book_leftover'];
    $book_extra_requests = $_POST['book_extra_requests'];
    $book_total = $_POST['book_total'];

    $update_stock = "UPDATE book_stock SET book_name='$book_name',book_serial_id='$s_id',book_language='$book_language',studing_students='$book_study_students',leftover_books='$book_leftover',extra_requests='$book_extra_requests',total_books='$book_total' WHERE book_id='$book_stock_id'";
    $update_stock_run = mysqli_query($conn, $update_stock);

    if ($update_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Stock Updated Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Stock Not Updated, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['add_data'])) {

    $stock_table = $_POST['stock_table'];

    $s_id = $_POST['s_id'];
    $book_name = $_POST['book_name'];
    $book_language = $_POST['book_language'];
    $book_study_students = $_POST['book_study_students'];
    $book_leftover = $_POST['book_leftover'];
    $book_extra_requests = $_POST['book_extra_requests'];
    $book_total = $_POST['book_total'];

    $add_stock = "INSERT INTO book_stock (book_serial_id, book_name, book_language, book_grade, studing_students, leftover_books, extra_requests, total_books) VALUES ('$s_id','$book_name','$book_language','$stock_table','$book_study_students','$book_leftover','$book_extra_requests','$book_total')";
    $add_stock_run = mysqli_query($conn, $add_stock);

    if ($add_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Stock Added Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Stock Not Added, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['delete_stock'])) {

    $stock_id = $_POST['stock_id'];

    $delete_stock = "DELETE FROM book_stock WHERE book_id='$stock_id'";
    $delete_stock_run = mysqli_query($conn, $delete_stock);

    if ($delete_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Stock Deleted Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Stock Not Deleted, Try Again Later!',
        ];
    }
    echo json_encode($res);
}


if (isset($_POST['ch_empty_books'])) {

    for ($i = 1; $i < 10; $i++) {

        $grade_table = 'grd' . $i . '_books';
        $grade = 'grd' . $i;
        date_default_timezone_set("Asia/Colombo");
        $date = date("Y-m-d h:i a");

        $ch_empty_book_data = "SELECT * FROM " . $grade_table . "";
        $ch_empty_book_data_run = mysqli_query($conn, $ch_empty_book_data);
        $q = 0;
        if (mysqli_num_rows($ch_empty_book_data_run) > 0) {

            foreach ($ch_empty_book_data_run as $e_books) {
                if ($e_books['leftover_books'] <= 5) {

                    $msg = 'Sir, Grade ' . $i . ' ' . $e_books['book_name'] . ' Only ' . $e_books['leftover_books'] . ' books left.';

                    $ch_msg = "SELECT * FROM chat WHERE msg='$msg'";
                    $ch_msg_run = mysqli_query($conn, $ch_msg);

                    if (!mysqli_num_rows($ch_msg_run) > 0) {
                        $send_msg = "INSERT INTO chat(sender_id, msg, type, msg_date_time) VALUES ('system','$msg','all','$date')";
                        $send_msg_run = mysqli_query($conn, $send_msg);
                        $q = $q + 1;
                    }
                }
            }
        }
    }
    echo $q;
}
