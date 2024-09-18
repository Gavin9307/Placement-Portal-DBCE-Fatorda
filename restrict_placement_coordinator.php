<?php

if ($_SESSION["user_type"] != "stu"){
    header("Location: ../restricted.php");
    exit();
}