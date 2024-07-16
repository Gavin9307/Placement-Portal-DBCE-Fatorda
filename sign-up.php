<?php
require "conn.php";

$email = "";
$password = "";
$error = "";
$rememberMe = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["add_student"])) {
    global $conn;
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    if (isset($_POST["remember_me"])) {
        $rememberMe = $_POST["remember_me"];
    }
    $pattern = "/^[a-zA-Z0-9._%+-]+@dbcegoa.ac.in$/";

    if (empty($email)) {
        $error = "Email is required.";
    } else if (!preg_match($pattern, $email)) {
        $error = "Please enter your college email.";
    } else {
        global $conn;
        $checkEmailQuery = "SELECT S_College_Email FROM student WHERE S_College_Email = ?";
        $checkStmt = $conn->prepare($checkEmailQuery);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "Email already registered, please login.";
        } else if (empty($password)) {
            $error = "Password is required.";
        } else if (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO student (S_College_Email, S_Password) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("ss", $email, $hashedPassword);

            if ($insertStmt->execute()) {
                if ($rememberMe) {
                    setcookie("user_email", $email, time() + (86400 * 30), "/"); // 30 days
                }
                header("Location: ./student/dashboard.html");
                exit();
            } else {
                $error = "Registration failed, please try again.";
            }
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
                    <a href="./index.html">
                        <li>Home</li>
                    </a>
                    <a href="./sign-in.html">
                        <li>Sign in</li>
                    </a>
                    <a href="./student-support.html">
                        <li>Contact Us</li>
                    </a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <img src="./Assets/college-university-students.png" alt="">
                <div class="main-right-container">
                    <h2>Welcome !<br />Sign up</h2>
                    <form action="./sign-up.php?add_student" method="post">
                        <label for="email">Email</label><br>
                        <input name="email" class="user-input" placeholder="example@dbcegoa.ac.in" type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

                        <label for="password">Password</label><br>
                        <input name="password" class="user-input" placeholder="password" type="password" id="password" required><br><br>

                        <div class="checkbox-container">
                            <input type="checkbox" name="remember_me" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div><br>
                    
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
