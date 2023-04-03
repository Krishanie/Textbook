<?php
include('../../control/db/conn.php');
require('../../admin/assets/excel-library/php-excel-reader/excel_reader2.php');
require('../../admin/assets/excel-library/SpreadsheetReader.php');
$date = date('Y-m-d');

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

                    $admin_grade = $book['grade'];

                    $find_grade_data = "SELECT * FROM available_grades WHERE value='$admin_grade'";
                    $find_grade_data_run = mysqli_query($conn, $find_grade_data);
                    while ($admin_grade_for = mysqli_fetch_assoc($find_grade_data_run)) {
                        $grade_for_table = $admin_grade_for['grade'];

                        $row[] = $grade_for_table;
                    }

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


if (isset($_POST['get_edit_student_data'])) {

    $student_id = $_POST['student_id'];

    $get_student_data_modal = "SELECT * FROM students WHERE id='$student_id'";
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

    $student_id = $_POST['student_id'];
    $index_no = $_POST['index_no'];
    $student_name = $_POST['student_name'];
    $student_language = $_POST['student_language'];
    $student_grade = $_POST['student_grade'];
    $student_class = $_POST['student_class'];

    $update_student = "UPDATE students SET name='$student_name',index_no='$index_no',grade='$student_grade',class='$student_class',language='$student_language' WHERE id='$student_id'";
    $update_student_run = mysqli_query($conn, $update_student);

    if ($update_student_run) {
        $res = [
            'status' => 200,
            'msg' => 'Student Updated Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Student Not Updated, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['add_data'])) {

    $index_no = $_POST['index_no'];
    $student_name = $_POST['student_name'];
    $student_language = $_POST['student_language'];
    $student_grade = $_POST['student_grade'];
    $student_class = $_POST['student_class'];

    $add_student = "INSERT INTO students(name, index_no, grade, class, language, added_date) VALUES ('$student_name','$index_no','$student_grade','$student_class','$student_language','$date')";
    $add_student_run = mysqli_query($conn, $add_student);

    if ($add_student_run) {
        $res = [
            'status' => 200,
            'msg' => 'Student Added Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Student Not Added, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['delete_student'])) {

    $student_id = $_POST['student_id'];

    $delete_stock = "DELETE FROM students WHERE id='$student_id'";
    $delete_stock_run = mysqli_query($conn, $delete_stock);

    if ($delete_stock_run) {
        $res = [
            'status' => 200,
            'msg' => 'Student Deleted Successfully!',
        ];
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Student Not Deleted, Try Again Later!',
        ];
    }
    echo json_encode($res);
}



if (isset($_POST['excel_import'])) {

    $grade = $_POST['grade'];

    $file_array = explode(".", $_FILES["excel_sheet"]["name"]);
    if ($file_array[1] == "xls" || $file_array[1] == "xlsx") {

        $r_num = uniqid("imported-", true);
        $uploadFilePath = '../../admin/import_docs/' . $r_num . '-' . basename($_FILES['excel_sheet']['name']);
        move_uploaded_file($_FILES['excel_sheet']['tmp_name'], $uploadFilePath);
        $Reader = new SpreadsheetReader($uploadFilePath);
        $totalSheet = count($Reader->sheets());

        /* For Loop for all sheets */
        $exist_stu = [];
        $row = array();
        $num_exists = 0;

        for ($i = 0; $i < $totalSheet; $i++) {

            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row) {
                $name = isset($Row[0]) ? $Row[0] : '';
                $index_no = isset($Row[1]) ? $Row[1] : '';
                $class = isset($Row[2]) ? $Row[2] : '';
                $language = isset($Row[3]) ? $Row[3] : '';
                $grade = $grade;
                $ch_stu_exist = "SELECT * FROM students WHERE index_no='$index_no' AND grade='$grade' AND `language`='$language' AND class='$class'";
                $ch_stu_exist_run = mysqli_query($conn, $ch_stu_exist);
                if (mysqli_num_rows($ch_stu_exist_run) > 0) {
                    while ($stus = $ch_stu_exist_run->fetch_assoc()) {
                        $row[] = $stus['name'];
                        $num_exists = $num_exists + 1;
                    }
                } else {
                    $query = "INSERT INTO `students`(`name`, `index_no`, `grade`, `class`, `language`) VALUES ('$name','$index_no','$grade','$class','$language')";
                    $query_run = mysqli_query($conn, $query);
                }
            }
            unlink($uploadFilePath);
            $exist_stu[] = $row;
            if (isset($query_run) == true) {
                $res = [
                    'status' => 200,
                    'msg' => 'Students Imported Successfully!',
                    'exists' => $exist_stu,
                    'num_exists' => $num_exists,
                ];
                echo json_encode($res);
            } else if ($ch_stu_exist_run) {
                $res = [
                    'status' => 200,
                    'msg' => 'Students Imported Successfully!',
                    'exists' => $exist_stu,
                    'num_exists' => $num_exists,
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'status' => 400,
                    'msg' => 'Excel File Error or System Error!',
                ];
                echo json_encode($res);
            }
        }
    } else {
        $res = [
            'status' => 400,
            'msg' => 'Please Select "xlsx" File!',
        ];
        echo json_encode($res);
    }
}
