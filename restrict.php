<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!(isset($_SESSION["user_type"]) && isset($_SESSION["user_email"]))) {
    header("Location: ../restricted.php");
    exit();
}