<?php

// If user is not authenticated we redirecrt to Patient Portal login page.

session_start();
if (!isset($_SESSION['email']) || (trim($_SESSION['email']) == '')) {
    header("location: index.php");
    exit();
}
$session_id = $_SESSION['email'];