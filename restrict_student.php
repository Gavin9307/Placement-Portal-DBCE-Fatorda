<?php

if ($_SESSION["user_type"] != "tpo"){
    header("Location: ../restricted.php");
    exit();
}