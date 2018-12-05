<?php
session_start();

session_unset(); // Unset session variables
session_destroy(); // Destroy actual session

header('Location: ../index.php');
exit();
