<?php

$conn = mysqli_connect('localhost','root','','textbook_issuing_system');

if(!$conn){
    echo 'Database Error';
}