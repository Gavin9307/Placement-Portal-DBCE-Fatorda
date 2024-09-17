<?php
    require 'common-functions.php';
    require "conn.php";

    $email = "";
    $password = "";
    $error = "";

    if (isset($_GET["reset_password"])){
        global $conn;
        $email = htmlspecialchars($_POST["email"]);
        $usertype = htmlspecialchars($_POST["usertype"]);


        if (empty($email)) {
            $error = "Email is required.";
        }
        else if (empty($usertype)) {
            $error = "User type is required.";
        } else {
            $Table = "";
            switch ($usertype) {
                case "stu":
                    $Table = "student";
                    $Email = "S_College_Email";
                    $Password = "S_Password";
                    break;
                case "tpo":
                    $Table = "placementcoordinator";
                    $Email = "PC_Email";
                    $Password = "PC_Password";
                    break;
                case "pc":
                    $Table = "placementcoordinator";
                    $Email = "PC_Email";
                    $Password = "PC_Password";
                    break;
                default:
                    $error = "Select user type.";
                    break;
            }
    
            if (empty($error)) {
                $checkEmailQuery = "SELECT $Email FROM $Table WHERE $Email = ?";
                $checkStmt = $conn->prepare($checkEmailQuery);
                $checkStmt->bind_param("s", $email);
                $checkStmt->execute();
                $checkStmt->store_result();
    
                if ($checkStmt->num_rows > 0) {
                    $checkStmt->bind_result($dbEmail);
                    $checkStmt->fetch();

                    $newPassword = generatePassword();
                    $body = "Hello,\n\n"
                        . "Your password has been successfully reset. Below, you will find your new password:\n\n"
                        . "New Password:\n"
                        . "$newPassword\n\n"
                        . "For your security, we recommend that you change this password after logging in.\n\n"
                        . "DBCE Placement";

                    $subject = "Password Reset Confirmation";
                    $name = "DBCE Placement - Password Reset";
                    if (sendMail($dbEmail, $subject,$body,$name)){
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateQuery = "UPDATE $Table SET $Password = ? WHERE $Email = ?";
                        $stmt = $conn->prepare($updateQuery);
                        $stmt->bind_param("ss", $hashedPassword, $dbEmail);
                        $stmt->execute();
                        header("Location: ./forgotpasswordsuccess.php");
                        exit();
                    }
                    else {
                        $error = "Please Try after some time";
                    }
                } else {
                    $error = "Email not registered.";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="style-forgotpassword.css">
    <title>Forgot Password</title>
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
                    <a href="./student-support.php">
                        <li>Contact Us</li>
                    </a>
                    <a href="./sign-in.php">
                        <li>Sign in</li>
                    </a>
                    <a href="./sign-up.php">
                        <li>Sign up</li>
                    </a>
                </ul>
            </div>
        </header>
        <main>
            <div class="main-container-1">
                <img src="./Assets/college-university-students.png" alt="">

                <div class="right-column">
                    <form action="./forgotpassword.php?reset_password" method="post">
                        <h1>Oops!</h1>
                        <h1>Forgot Password ?</h1>
                        <div class="inputbox">
                            <label for="usertype">Sign in as</label><br>
                            <select name="usertype" id="usertype">
                                <option value="stu">Student</option>
                                <option value="tpo">TPO</option>
                                <!-- <option value="pc">Placement Coordinator</option> -->
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="email">Email</label><br>
                            <input name="email" type="text" placeholder="example@dbcegoa.ac.in" required>
                        </div>
                        <br>
                        <button type="submit" class="subbtn">Reset</button>
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
<script defer src="./FontAwesome/JS/all.js"></script>

</html>