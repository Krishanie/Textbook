<?php

$conn = mysqli_connect('localhost','root','','textbook-issue-system');

if(!$conn){
    echo 'Database Error';
}