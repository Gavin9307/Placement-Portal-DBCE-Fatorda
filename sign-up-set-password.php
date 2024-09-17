<?php
require "conn.php";

$email = "";
$password = "";
$error = "";

if (!isset($_GET["semail"])) {
    header("Location: sign-up.php");
    exit();
}
$email = $_GET["semail"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["add_student"])) {
    global $conn;
    $password = htmlspecialchars($_POST["password"]);
    if (empty($password)) {
        $error = "Password is required.";
    } else if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO student (S_College_Email, S_Password) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ss", $email, $hashedPassword);

        if ($insertStmt->execute()) {

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user_email'] = $email;
            $_SESSION['user_type'] = $usertype;
            header("Location: ./sign-in.php");
            exit();
        } else {
            $error = "Registration failed, please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <link rel="stylesheet" href="style-sign-up.css">
    <title>Placement Portal @ DBCE</title>
</head>

<body>
    <div id="wrapper">

        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="./Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <a href="./index.php">
                        <li>Home</li>
                    </a>
                    <a href="./sign-in.php">
                        <li>Sign in</li>
                    </a>
                    <a href="./student-support.phpang">
                        <li>Contact Us</li>
                    </a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <img src="./Assets/college-university-students.png" alt="">
                <div class="main-right-container">
                    <h2>Welcome !<br />Set Password</h2>
                    <form action="./sign-up-set-password.php?semail=<?php echo $email; ?>&add_student" method="post">
                        <label for="email">Email</label><br>
                        <input name="email" class="user-input" type="email" id="email" value="<?php echo $email; ?>" disabled><br><br>

                        <label for="password">Password</label><br>
                        <input name="password" class="user-input" placeholder="Enter password" type="password" id="password" required><br><br>

                        <button type="submit">Sign up</button>

                        <?php if (!empty($error)): ?>
                            <div style="color: red; font-size: small; text-align:center; margin-top:10px"><?php echo $error; ?></div><br>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </main>

        <?php include 'footer.php' ?>

    </div>
</body>

</html>