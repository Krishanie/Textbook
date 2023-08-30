<?php

$conn = mysqli_connect('localhost','root','','textbook-issue-system');

if(!$conn){
    echo 'Database Error';
}

$timezone = new DateTimeZone('Asia/Colombo'); 
$date = new DateTime('now', $timezone);
$todayDateAll = $date->format('Y-m-d H:i:s A');