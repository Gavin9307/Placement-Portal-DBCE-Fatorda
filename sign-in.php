<?php
require "conn.php";

$email = "";
$password = "";
$error = "";
$rememberMe = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["login"])) {
    global $conn;
    if(!isset($_POST["usertype"])){
        $error = "Please select user type";
        goto passfail;
    }
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $usertype = htmlspecialchars($_POST["usertype"]);

    if (isset($_POST["remember_me"])) {
        $rememberMe = true;
    }

    if (empty($email)) {
        $error = "Email is required.";
    } else if (empty($password)) {
        $error = "Password is required.";
    } else if (empty($usertype)) {
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
            if ($usertype == "tpo"){
                $checkTpoEmailQuery = "SELECT Admin_Email as adm_email FROM admin WHERE Admin_Email = ?";
                $checkTpoStmt = $conn->prepare($checkTpoEmailQuery);
                $checkTpoStmt->bind_param("s", $email);
                $checkTpoStmt->execute();
                $checkTpoStmt->store_result();
                if ($checkTpoStmt->num_rows > 0) {
                    goto pass;
                }else{
                    $error = "Invalid Email";
                    goto passfail;
                }
            }
            pass:
            $checkEmailQuery = "SELECT $Email, $Password FROM $Table WHERE $Email = ?";
            $checkStmt = $conn->prepare($checkEmailQuery);
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $checkStmt->bind_result($dbEmail, $dbPassword);
                $checkStmt->fetch();
                if (password_verify($password, $dbPassword)) {
                    if (!isset($_SESSION)){
                        session_start();
                    }
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_type'] = $usertype;

                    if ($rememberMe) {
                        setcookie("user_email", $email, time() + 86400 * 30, "/");
                        setcookie("user_type", $usertype, time() + 86400 * 30, "/");
                    }
                    switch ($usertype) {
                        case "stu":
                            $checkRegistrationQuery = "SELECT registration_complete from student WHERE student.S_College_Email = ?;";
                            $checkStmt = $conn->prepare($checkRegistrationQuery);
                            $checkStmt->bind_param("s", $email);
                            $checkStmt->execute();
                            $result = $checkStmt->get_result();
                            $row = $result->fetch_assoc();

                            if($row["registration_complete"] == 0){
                                header("Location: ./update-profile.php");
                                exit();
                            }
                            else {
                                header("Location: ./Students/dashboard.php");
                            }
                            break;
                        case "tpo":
                            header("Location: ./PlacementCoordinator/dashboard.php");
                            break;
                        case "pc":
                            header("Location: ./PlacementCoordinator/dashboard.php");
                            break;
                        default:
                            break;
                    }
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "Email not registered.";
            }
        }
    }
}
passfail:
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    
    <link rel="stylesheet" href="style-sign-in.css">
    <title>Sign-in</title>
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
                    <a href="./index.php"><li>Home</li></a>
                   <a href="./sign-up.php"><li>Sign up</li></a>
                   <a href="./student-support.php"><li>Contact Us</li></a>
                </ul>
            </div>
        </header>
        <main>
            <div class="main-container-1">
                <img src="./Assets/college-university-students.png" alt="">

                <div class="right-column">
                    <form action="./sign-in.php?login" method="post">
                        <h2>Welcome back! <br> Sign in</h2>
                        <div class="inputbox">
                            <label for="usertype">Sign in as</label><br>
                            <select name="usertype" id="usertype">
                                <option value="" disabled selected>Select Type</option>
                                <option value="stu">Student</option>
                                <option value="tpo">TPO</option>
                                <!-- <option value="pc">Placement Coordinator</option> -->
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="email">Email</label><br>
                            <input name="email" type="text" placeholder="example@dbcegoa.ac.in" required>
                        </div>

                        <div class="inputbox">
                            <label for="password">Password</label><br>
                            <input name="password" type="password" placeholder="Password" id="password" required>
                        </div><br>

                        <div class="checkbox-container">
                            <input type="checkbox" name="remember_me" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div><br>
                        <button type="submit" class="subbtn" onclick=" ">Sign in</button>
                        <div class="forgotpassword">
                            <a href="./forgotpassword.php">Forgot Password</a>
                        </div>
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