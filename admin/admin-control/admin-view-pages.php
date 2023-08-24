<?php
include('../../control/db/conn.php');

if (isset($_POST['get_page_data'])) {

    $get_page_data = "SELECT * FROM view_pages";
    $get_page_data_run = mysqli_query($conn, $get_page_data);
    $data = array();
    $no = 1;
    if ($get_page_data_run) {
        if (mysqli_num_rows($get_page_data_run) > 0) {
            while ($books = $get_page_data_run->fetch_assoc()) {
                foreach ($get_page_data_run as $page) {
                    $no++;
                    $row = array();
                    $row[] = $page['id'];
                    $row[] = $page['page_name'];
                    $row[] = $page['page_find'];
                    $row[] = $page['page_view'];
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

if (isset($_POST['hide_btn'])) {

    $hide_id = $_POST['id'];

    $hide_page = "UPDATE view_pages SET page_view='0' WHERE id='$hide_id'";
    $hide_page_run = mysqli_query($conn, $hide_page);

    if ($hide_page_run) {
        echo 200;
    }
}

if (isset($_POST['show_btn'])) {

    $show_id = $_POST['id'];

    $show_page = "UPDATE view_pages SET page_view='1' WHERE id='$show_id'";
    $show_page_run = mysqli_query($conn, $show_page);

    if ($show_page_run) {
        echo 200;
    }
}
