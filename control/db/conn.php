<?php

$conn = mysqli_connect('localhost','root','','textbook_issuing_system_new_version');

if(!$conn){
    echo 'Database Error';
}