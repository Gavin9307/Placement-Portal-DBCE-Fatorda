<?php
require "conn.php";
require './common-functions.php';

$email = "";
$password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["add_student"])) {
    global $conn;
    $email = htmlspecialchars($_POST["email"]);
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
        }
        else {
            $otp = rand(100000, 999999);
            $otp_expiration = time() + (10 * 60);

            $insertOtpQuery = "INSERT INTO otp_table (email, otp, otp_expiration) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertOtpQuery);
            $insertStmt->bind_param("sii", $email, $otp, $otp_expiration);
            $insertStmt->execute();

            $subject = "Your OTP Code";
            $body = "Your OTP code is <strong>$otp</strong>. It is valid for 10 minutes.";
            $name = "DBCE Placement - Sign Up OTP";
            if (sendMail($email, $subject, $body,$name)) {
                $message = "OTP has been sent to your email address.";
                header("Location: sign-up-otp-validate.php?semail=" . $email);
                exit();
            } else {
                $error = "Failed to send OTP. Please try again.";
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
                    <h2>Welcome !<br />Sign up</h2>
                    <form action="./sign-up.php?add_student" method="post">
                        <label for="email">Email</label><br>
                        <input name="email" class="user-input" placeholder="example@dbcegoa.ac.in" type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>
                        
                        <button type="submit">Generate OTP</button>

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
