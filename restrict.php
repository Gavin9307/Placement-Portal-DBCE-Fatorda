<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_type'])) {
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_type'] = $_COOKIE['user_type'];
}

if (!(isset($_SESSION["user_type"]) && isset($_SESSION["user_email"]))) {
    header("Location: ../restricted.php");
    exit();
}