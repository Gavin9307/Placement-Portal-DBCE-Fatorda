<?php
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION["reg_complete"]) && $_SESSION["reg_complete"] == "pending") {
    header("Location: ../update-profile.php");
    exit();
}