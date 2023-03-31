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

            $ch_take = "SELECT * FROM will_take_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND `take`='1'";
            $ch_take_run = mysqli_query($conn, $ch_take);

            if (mysqli_num_rows($ch_take_run) > 0) {
                $ch = 1;
                while ($ch_take = $ch_take_run->fetch_assoc()) {
                    $take_ch_id = $ch_take['id'];
                }
            } else {
                $ch = 0;
                $take_ch_id = 0;
            }

            if ($ch == 0) {
                $html .= '<div onclick="check('  . $take_ch_id . ', '  . $book_id . ')" class="card text-center" style="margin-left: 5px;" id="tick_box_' . $book["id"] . '">
        <div class="mb-1">' . $book["book_name"] . '</div>
        <div style="pointer-events:none;">
            <i class="fa fa-times-circle text-red btn"></i>
        </div>
    </div>';
            } else {
                $html .= '<div onclick="uncheck(' . $take_ch_id . ', '  . $book_id . ')" class="card text-center" style="margin-left: 5px;" id="tick_box_' . $book["id"] . '">
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



if (isset($_POST['check_take_book'])) {

    $stu_id = $_POST['stu_id'];
    $book_id = $_POST['book_id'];
    $ch_id = $_POST['ch_id'];
    $grade = $_POST['grade'];

    $ch_take2 = "SELECT * FROM will_take_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND book_grade='$grade'";
    $ch_take2_run = mysqli_query($conn, $ch_take2);

    if (mysqli_num_rows($ch_take2_run) >  0) {
        $ch_take_book = "UPDATE will_take_books SET take='1' WHERE stu_id='$stu_id' AND book_id='$book_id' AND book_grade='$grade'";
        $ch_take_book_run = mysqli_query($conn, $ch_take_book);
    } else {
        $ch_take_book = "INSERT INTO will_take_books(book_id, stu_id, book_grade, take) VALUES ('$book_id','$stu_id','$grade','1')";
        $ch_take_book_run = mysqli_query($conn, $ch_take_book);
    }

    if ($ch_take_book_run) {

        $grade_table = $grade . "_books";

        $get_book_stock = "SELECT * FROM " . $grade_table . " WHERE id='$book_id'";
        $get_book_stock_run = mysqli_query($conn, $get_book_stock);
        while ($get_book_stock = $get_book_stock_run->fetch_assoc()) {
            $last_book1 = $get_book_stock['leftover_books'] + 1;
            $last_book2 = $get_book_stock['total_books'] + 1;
        }

        $change_book_stock = "UPDATE " . $grade_table . " SET total_books='$last_book2', leftover_books='$last_book1' WHERE id='$book_id'";
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


if (isset($_POST['uncheck_take_book'])) {

    $stu_id = $_POST['stu_id'];
    $book_id = $_POST['book_id'];
    $ch_id = $_POST['ch_id'];
    $grade = $_POST['grade'];

    $ch_take2 = "SELECT * FROM will_take_books WHERE book_id='$book_id' AND stu_id='$stu_id' AND book_grade='$grade'";
    $ch_take2_run = mysqli_query($conn, $ch_take2);

    if (mysqli_num_rows($ch_take2_run) >  0) {
        $ch_take_book = "UPDATE will_take_books SET take='0' WHERE stu_id='$stu_id' AND book_id='$book_id' AND book_grade='$grade'";
        $ch_take_book_run = mysqli_query($conn, $ch_take_book);
    } else {
        $ch_take_book = "INSERT INTO will_take_books(book_id, stu_id, book_grade, take) VALUES ('$book_id','$stu_id','$grade','0')";
        $ch_take_book_run = mysqli_query($conn, $ch_take_book);
    }

    if ($ch_take_book_run) {

        $grade_table = $grade . "_books";

        $get_book_stock = "SELECT * FROM " . $grade_table . " WHERE id='$book_id'";
        $get_book_stock_run = mysqli_query($conn, $get_book_stock);
        while ($get_book_stock = $get_book_stock_run->fetch_assoc()) {
            $last_book1 = $get_book_stock['total_books'] - 1;
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
