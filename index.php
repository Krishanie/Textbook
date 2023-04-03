<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="assets/login-page/style.css">
</head>

<?php
include('control/db/conn.php');
$site_data = "SELECT * FROM book_site_data WHERE id='1'";
$site_data_run = mysqli_query($conn, $site_data);
while ($site_datas2 = $site_data_run->fetch_assoc()) {
    $site_logo = $site_datas2['logo'];
}
?>

<body onkeyup="key(event);">


    <div class="login-page">
        <div class="site-logo">
            <center><img src="../admin/site_images/<?= $site_logo ?>" width="120" alt="AdminLTE Logo" class="logo"></center>
        </div>
        <div class="form">
            <h3>Login</h3>
            <div class="login-form">
                <div class="err-msg" id="err-msg"></div>
                <input type="text" id="txt_uname" placeholder="username" />
                <input type="password" id="txt_pass" placeholder="password" />
                <button id="login-btn">Login</button>
                <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
            </div>
        </div>
    </div>
</body>
<script src="assets/js/jquery.min.js"></script>

</html>

<script>
    $(document).ready(function() {
        $('#err-msg').css('display', 'none');

        $(document).on('click', '#login-btn', function() {
            if (validate()) {
                var data = {
                    get_data: true,
                    uname: $('#txt_uname').val(),
                    pass: $('#txt_pass').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "control/login.php",
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if (response == 400) {
                            errors('Incorrect Username or Password!');
                        } else if (response == 200) {
                            errors(0);
                            window.location.href = 'admin/home.php';
                        } else if (response == 300) {
                            errors('Database Error!');
                        }
                    }
                });
            }
        });

    });

    function validate() {
        if ($('#txt_uname').val() == "") {
            errors('Username Required!');
        } else if ($('#txt_pass').val() == "") {
            errors('Password Required!');
        } else {
            errors(0);
            return true;
        }
    }

    function errors(msg) {
        if (msg == 0) {
            $('#err-msg').html("");
            $('#err-msg').css('display', 'none');
        } else {
            $('#err-msg').html(msg);
            $('#err-msg').css('display', 'block');
        }
    }


    function key(event) {
        // console.log(event.which);
        if (event.which == 13) {
            $('#login-btn').click();
        }
    }
</script>