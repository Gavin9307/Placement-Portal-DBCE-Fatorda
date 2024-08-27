<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $usertype = $_SESSION["user_type"];
    $useremail = $_SESSION["user_email"];

    $fetchQuery = 'SELECT PC.PC_Email AS pcemail,PC.PC_Fname as fname,PC.PC_Mname as mname,PC.PC_Lname as lname,PC.PC_Contact_no as contact,PC.PC_Profile_pic AS image FROM placementcoordinator AS PC
    WHERE PC_Email= ?;';
    $fetch = $conn->prepare($fetchQuery);
    $fetch->bind_param("s", $_SESSION["user_email"]);
    $fetch->execute();
    $result = $fetch->get_result();

    if ($result->num_rows > 0) {
        $Info = $result->fetch_assoc();
        $TPOFName = htmlspecialchars($Info['fname']);
        $TPOMName = htmlspecialchars($Info['mname']);
        $TPOLName = htmlspecialchars($Info['lname']);
        $TPOPCEmail = htmlspecialchars($Info['pcemail']);
        $TPOImage = htmlspecialchars($Info['image']);
        $TPOPhoneNo = htmlspecialchars($Info['contact']);
    } else {
        // Handle case where results are not obtained
    }
} else {
    echo "Session variables not set.";
    exit();
}

if (isset($_POST["update_profile"])) {
    $_POST["fname"] = empty($_POST["fname"]) ? "" : $_POST["fname"];
    $_POST["mname"] = empty($_POST["mname"]) ? "" : $_POST["mname"];
    $_POST["lname"] = empty($_POST["lname"]) ? "" : $_POST["lname"];
    $_POST["phno"] = empty($_POST["phno"]) ? "" : $_POST["phno"];
    $_POST["pemail"] = empty($_POST["pemail"]) ? "" : $_POST["pemail"];
    $_POST["newpass"] = empty($_POST["newpass"]) ? "" : $_POST["newpass"];

    // Hash the new password if it's not empty
    if (!empty($_POST["newpass"])) {
        $hashPassword = password_hash($_POST["newpass"], PASSWORD_BCRYPT);
        $updateQuery = "UPDATE placementcoordinator AS pc
SET pc.PC_Fname = ?, pc.PC_Mname= ?, pc.PC_Lname=?, pc.PC_Password=?, pc.PC_Contact_no=?
WHERE pc.PC_Email=?";
    
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ssssss", $_POST["fname"], $_POST["mname"], $_POST["lname"], $hashPassword, $_POST["phno"], $_SESSION["user_email"]);
    $result->execute();
    } else {
        $updateQuery = "UPDATE placementcoordinator AS pc
SET pc.PC_Fname = ?, pc.PC_Mname= ?, pc.PC_Lname=?, pc.PC_Contact_no=?
WHERE pc.PC_Email=?";
    
    $result = $conn->prepare($updateQuery);
    $result->bind_param("sssss", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["phno"], $_SESSION["user_email"]);
    $result->execute();
    }
    $_SESSION['profile_updated'] = true;
    header("Location: ./tpo-profile.php");
    exit();
}



if (isset($_POST["upload_pic"])) {
    $uploadDirectory = '../Data/Placement_Coordinators/Profile_Images/';

    $fetchTPOQuery = "SELECT PC_Email as email, PC_Profile_pic as profile_pic FROM placementcoordinator WHERE PC_Email = ?;";
    $fetchTPO = $conn->prepare($fetchTPOQuery);
    $fetchTPO->bind_param("s", $_SESSION["user_email"]);
    $fetchTPO->execute();
    $result = $fetchTPO->get_result();
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $currentProfilePic = $row["profile_pic"];

    if ($_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profile_pic']['tmp_name'];
        $fileName = basename($_FILES['profile_pic']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = $email . '.' . $fileExtension;
            $destination = $uploadDirectory . $newFileName;

            if ($currentProfilePic && $currentProfilePic != 'Default_Profile_Pic.jpg' && file_exists($uploadDirectory . $currentProfilePic)) {
                unlink($uploadDirectory . $currentProfilePic);
            }

            if (move_uploaded_file($tmpName, $destination)) {
                $UploadPicQuery = "UPDATE placementcoordinator SET PC_Profile_pic = ? WHERE PC_Email = ?";
                $UploadPic = $conn->prepare($UploadPicQuery);
                $UploadPic->bind_param("ss", $newFileName, $_SESSION["user_email"]);
                $UploadPic->execute();

                if ($UploadPic->affected_rows > 0) {
                    header("Location: ./tpo-profile.php");
                    // echo "Profile picture updated successfully.";
                } else {
                    // echo "Failed to update profile picture in the database.";
                }
            } else {
                // echo "Failed to move the uploaded file.";
            }
        } else {
            // echo "Invalid file type. Only jpeg, jpg, and png are allowed.";
        }
    } else {
        // echo "File upload error: " . $_FILES['profile_pic']['error'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/tpo-profile.css">
    <title>Edit TPO profile</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Edit Profile</h2>

                </div>

                <?php
                echo '
                <form action="./tpo-profile.php" method="post" enctype="multipart/form-data" class="profile-image">
                    <img src="../Data/Placement_Coordinators/Profile_Images/' . $TPOImage . '" alt="Profile Picture" id="profile-image">
                    <div class="upload-button-container">
                        <input type="file" name="profile_pic">
                        <button type="submit" name="upload_pic" class="change-picture">Upload Picture</button>
                    </div>
                </form>';
                ?>
                <div class="sections">
                    <form action="./tpo-profile.php" onsubmit="return validatePassword()" method="post">
                        <h3>Personal Information:</h3>
                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" value="' . $TPOFName . '">
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname" value="' . $TPOMName . '">
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" value="' . $TPOLName . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno" value="' . $TPOPhoneNo . '">
                            </div>
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail" value="' . $TPOPCEmail . '">
                            </div>
                        </div>';
                        ?>


                        <h3>Change Password:</h3> <span style="color: red;" id="error"></span>
                        <div class="form-adjust" style="margin-bottom:50px">
                            <div>
                                <label for="newpass">New Password</label><br>
                                <input type="password" id="newpass" name="newpass">
                            </div>

                            <div>
                                <label for="newpassconfirm">Confirm Password</label><br>
                                <input type="password" id="newpassconfirm" name="newpassconfirm">
                            </div>
                        </div>
                        <button id="myBtn" class="" name="update_profile">Update</button>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
    <script>
        function validatePassword() {
            const password = document.getElementById('newpass').value;
            const confirmPassword = document.getElementById('newpassconfirm').value;
            const errorSpan = document.getElementById('error');
            if(password.length == 0) {
                return true;
            }
            if (password.length < 8) {
                errorSpan.textContent = "Password must be at least 8 characters long.";
                return false; // Prevent form submission
            }

            if (password !== confirmPassword) {
                errorSpan.textContent = "Passwords do not match.";
                return false; // Prevent form submission
            }

            errorSpan.textContent = ""; // Clear error message if validation passes
            return true; // Allow form submission
        }
    </script>

</body>

</html>