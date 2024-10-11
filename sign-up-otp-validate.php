<?php
require "conn.php";

$email = "";
$otp = "";
$error = "";

if (!isset($_GET["semail"])) {
    header("Location: sign-up.php");
    exit();
}

$email = $_GET["semail"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["validate-otp"])) {
    global $conn;
    $otp = htmlspecialchars($_POST["otp"]);

    if (empty($otp)) {
        $error = "OTP is required.";
    } else if (!ctype_digit($otp) || strlen($otp) !== 6) {
        $error = "Invalid OTP format.";
    } else {
        $current_time = time();
        $otpQuery = "SELECT otp, otp_expiration FROM otp_table 
                     WHERE email = ? 
                     AND otp_expiration > ? 
                     ORDER BY created_at DESC 
                     LIMIT 1";
        $otpStmt = $conn->prepare($otpQuery);
        $otpStmt->bind_param("si", $email, $current_time); 
        $otpStmt->execute();
        $otpStmt->bind_result($storedOtp, $otpExpiration);
        $otpStmt->fetch();
        $otpStmt->close();

        if ($storedOtp && $storedOtp == $otp) {
            header("Location: sign-up-set-password.php?semail=".$email);
            exit(); 
        } else {
            $error = "Invalid or expired OTP.";
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
                    <a href="./student-support.php">
                        <li>Contact Us</li>
                    </a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <img src="./Assets/college-university-students.png" alt="">
                <div class="main-right-container">
                    <h2>Welcome !<br />Validate OTP</h2>
                    <form action="./sign-up-otp-validate.php?semail=<?php echo $email; ?>&validate-otp" method="post">
                        <label for="email">Email</label><br>
                        <input name="email" class="user-input" type="email" id="email" value="<?php echo $email; ?>" disabled><br><br>
                        
                        <label for="otp">Enter OTP</label><br>
                        <input name="otp" class="user-input" placeholder="Enter the 6 digit OTP" type="text" id="otp" required><br><br>

                        <button type="submit">Submit</button>

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
