<?php

$host = 'localhost';
$db_user = 'admin';
$db_pass = '305';
$db_name = 'scm';

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}
