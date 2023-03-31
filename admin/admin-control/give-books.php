<?php
include('../../control/db/conn.php');

if (isset($_POST['get_student_book_data'])) {

    $html = "";

    $stu_id = $_POST['id'];
    $grade = $_POST['grade'];
    $grade_table = $grade . "_books";

    $fetch_book = "SELECT * FROM $grade_table";
    $fetch_book_run = mysqli_query($conn, $fetch_book);
    if (mysqli_num_rows($fetch_book_run) > 0) {
        foreach ($fetch_book_run as $book) {

            $book_id = $book["id"];

            $ch_give = "SELECT * FROM will_give_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND give='1'";
            $ch_give_run = mysqli_query($conn, $ch_give);

            if (mysqli_num_rows($ch_give_run) > 0) {
                $ch = 1;
                while ($ch_give = $ch_give_run->fetch_assoc()) {
                    $give_ch_id = $ch_give['id'];
                }
            } else {
                $ch = 0;
                $give_ch_id = 0;
            }

            if ($ch == 0) {
                $html .= '<div onclick="check('  . $give_ch_id . ', '  . $book_id . ')" class="card text-center" style="margin-left: 5px;" id="tick_box_' . $book["id"] . '">
        <div class="mb-1">' . $book["book_name"] . '</div>
        <div style="pointer-events:none;">
            <i class="fa fa-times-circle text-red btn"></i>
        </div>
    </div>';
            } else {
                $html .= '<div onclick="uncheck(' . $give_ch_id . ', '  . $book_id . ')" class="card text-center" style="margin-left: 5px;" id="tick_box_' . $book["id"] . '">
        <div class="mb-1">' . $book["book_name"] . '</div>
        <div style="pointer-events:none;">
            <i class="fa fa-check-circle text-success btn"></i>
        </div>
    </div>';
            }
        }
    } else {
        $html .= '<h5>No Books Found!</h5>';
    }

    echo $html;
}



if (isset($_POST['check_give_book'])) {

    $stu_id = $_POST['stu_id'];
    $book_id = $_POST['book_id'];
    $ch_id = $_POST['ch_id'];
    $grade = $_POST['grade'];

    $ch_give2 = "SELECT * FROM will_give_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND book_grade='$grade'";
    $ch_give2_run = mysqli_query($conn, $ch_give2);

    if (mysqli_num_rows($ch_give2_run) >  0) {
        $ch_give_book = "UPDATE will_give_books SET give='1' WHERE stu_id='$stu_id' AND book_id='$book_id' AND book_grade='$grade'";
        $ch_give_book_run = mysqli_query($conn, $ch_give_book);
    } else {
        $ch_give_book = "INSERT INTO will_give_books(book_id, stu_id, book_grade, give) VALUES ('$book_id','$stu_id','$grade','1')";
        $ch_give_book_run = mysqli_query($conn, $ch_give_book);
    }

    if ($ch_give_book_run) {

        $grade_table = $grade . "_books";

        $get_book_stock = "SELECT * FROM " . $grade_table . " WHERE id='$book_id'";
        $get_book_stock_run = mysqli_query($conn, $get_book_stock);
        while ($get_book_stock = $get_book_stock_run->fetch_assoc()) {
            $last_book1 = $get_book_stock['leftover_books'] - 1;
        }

        $change_book_stock = "UPDATE " . $grade_table . " SET leftover_books='$last_book1' WHERE id='$book_id'";
        $change_book_stock_run = mysqli_query($conn, $change_book_stock);

        $res = [
            'status' => 200,
            'stu_id' => $stu_id,
        ];
    } else {
        $res = [
            'status' => 400,
        ];
    }
    echo json_encode($res);
}


if (isset($_POST['uncheck_give_book'])) {

    $stu_id = $_POST['stu_id'];
    $book_id = $_POST['book_id'];
    $ch_id = $_POST['ch_id'];
    $grade = $_POST['grade'];

    $ch_give2 = "SELECT * FROM will_give_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND book_grade='$grade'";
    $ch_give2_run = mysqli_query($conn, $ch_give2);

    if (mysqli_num_rows($ch_give2_run) >  0) {
        $ch_give_book = "UPDATE will_give_books SET give='0' WHERE stu_id='$stu_id' AND book_id='$book_id' AND book_grade='$grade'";
        $ch_give_book_run = mysqli_query($conn, $ch_give_book);
    } else {
        $ch_give_book = "INSERT INTO will_give_books(book_id, stu_id, book_grade, give) VALUES ('$book_id','$stu_id','$grade','0')";
        $ch_give_book_run = mysqli_query($conn, $ch_give_book);
    }

    if ($ch_give_book_run) {
        
        $grade_table = $grade . "_books";

        $get_book_stock = "SELECT * FROM " . $grade_table . " WHERE id='$book_id'";
        $get_book_stock_run = mysqli_query($conn, $get_book_stock);
        while ($get_book_stock = $get_book_stock_run->fetch_assoc()) {
            $last_book1 = $get_book_stock['total_books'] + 1;
        }

        $change_book_stock = "UPDATE " . $grade_table . " SET total_books='$last_book1' WHERE id='$book_id'";
        $change_book_stock_run = mysqli_query($conn, $change_book_stock);

        $res = [
            'status' => 200,
            'stu_id' => $stu_id,
        ];
    } else {
        $res = [
            'status' => 400,
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['get_table_data'])) {

    $grade = $_POST['grade'];

    $get_book_data = "SELECT * FROM students WHERE grade='$grade'";
    $get_book_data_run = mysqli_query($conn, $get_book_data);
    $data = array();
    $no = 1;
    if ($get_book_data_run) {
        if (mysqli_num_rows($get_book_data_run) > 0) {
            while ($books = $get_book_data_run->fetch_assoc()) {
                foreach ($get_book_data_run as $book) {
                    $no++;
                    $row = array();
                    $row[] = $book['index_no'];
                    $row[] = $book['name'];
                    $row[] = $book['grade'];
                    $row[] = $book['class'];
                    $row[] = $book['language'];
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
