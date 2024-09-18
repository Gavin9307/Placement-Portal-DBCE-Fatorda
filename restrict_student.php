<?php

if ($_SESSION["user_type"] != "pc"){
    header("Location: ../restricted.php");
    exit();
}