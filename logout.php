<?php
session_start();
session_unset();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, '/');
}

if (isset($_COOKIE['user_type'])) {
    setcookie('user_type', '', time() - 3600, '/');
}

header("Location: ./index.php");
exit();