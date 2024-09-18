<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $average_rating = 0;
    $usertype = $_SESSION["user_type"];
    $useremail = $_SESSION["user_email"];

    $fetchStudentQuery = "SELECT S.S_10th_marksheet as marksheet_10, S.S_12th_marksheet as marksheet_12, S.S_10th_Perc as percentage_10, S.S_12th_Perc as percentage_12, S.S_Address as address, S.S_College_Email as cemail, S.S_Fname as fname, S.S_Lname as lname, S.S_Mname as mname, S.S_Personal_Email as pemail, S.S_Phone_no as phoneno, S.S_PR_No as prno, S.S_Resume as resume, S.S_Roll_no as rollno, S.S_Year_of_Admission as yoa, C.Class_name as class, D.Dept_name as department, S.S_Profile_pic as image, R.Sem1_SGPA as sem1, R.Sem2_SGPA as sem2, R.Sem3_SGPA as sem3,R.Sem4_SGPA as sem4,R.Sem5_SGPA as sem5,R.Sem6_SGPA as sem6,R.Sem7_SGPA as sem7,R.Sem8_SGPA as sem8,R.CGPA as cgpa,R.has_backlogs as backs FROM student S INNER JOIN class as C ON C.Class_id = S.S_Class_id INNER JOIN department as D ON D.Dept_id = C.Dept_id INNER JOIN result as R ON R.S_College_Email = S.S_College_Email WHERE S.S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $_SESSION["user_email"]);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();

    if ($result->num_rows > 0) {
        $StudentInfo = $result->fetch_assoc();
        $StudentFName = htmlspecialchars($StudentInfo['fname']);
        $StudentMName = htmlspecialchars($StudentInfo['mname']);
        $StudentLName = htmlspecialchars($StudentInfo['lname']);
        $StudentAddress = htmlspecialchars($StudentInfo['address']);
        $StudentMarksheet_12 = $StudentInfo['marksheet_12'];
        $StudentMarksheet_10 = $StudentInfo['marksheet_10'];
        $StudentPercentage_10 = htmlspecialchars($StudentInfo['percentage_10']);
        $StudentPercentage_12 = htmlspecialchars($StudentInfo['percentage_12']);
        $StudentPEmail = htmlspecialchars($StudentInfo['pemail']);
        $StudentCEmail = htmlspecialchars($StudentInfo['cemail']);
        $StudentClass = htmlspecialchars($StudentInfo['class']);
        $StudentDepartment = htmlspecialchars($StudentInfo['department']);
        $StudentYOA = htmlspecialchars($StudentInfo['yoa']);
        $Batch = $StudentYOA+4;
        $StudentImage = htmlspecialchars($StudentInfo['image']);
        $StudentRollNo = htmlspecialchars($StudentInfo['rollno']);
        $StudentPhoneNo = htmlspecialchars($StudentInfo['phoneno']);
        $StudentPRN = htmlspecialchars($StudentInfo['prno']);
        $StudentResume = $StudentInfo['resume'];
        $StudentSem1 = htmlspecialchars($StudentInfo['sem1']);
        $StudentSem2 = htmlspecialchars($StudentInfo['sem2']);
        $StudentSem3 = htmlspecialchars($StudentInfo['sem3']);
        $StudentSem4 = htmlspecialchars($StudentInfo['sem4']);
        $StudentSem5 = htmlspecialchars($StudentInfo['sem5']);
        $StudentSem6 = htmlspecialchars($StudentInfo['sem6']);
        $StudentSem7 = htmlspecialchars($StudentInfo['sem7']);
        $StudentSem8 = htmlspecialchars($StudentInfo['sem8']);
        $StudentCGPA = htmlspecialchars($StudentInfo['cgpa']);
        $StudentBacks = htmlspecialchars($StudentInfo['backs']);
    } else {
        // Handle case where results are not obtained
    }
} else {
    echo "Session variables not set.";
    exit();
}

if (isset($_POST["update_profile"])) {
    $_POST["resume"] = empty($_POST["resume"])?"":'=HYPERLINK("'.$_POST["resume"].'","Resume")';
    $_POST["marksheet_10"] = empty($_POST["marksheet_10"])?"":'=HYPERLINK("'.$_POST["marksheet_10"].'","10th Marksheet")';
    $_POST["marksheet_12"] = empty($_POST["marksheet_12"])?"":'=HYPERLINK("'.$_POST["marksheet_12"].'","12th Marksheet")';
    $yoa = $_POST["yoa"]-4;
    $_POST["newpass"] = empty($_POST["newpass"]) ? "" : $_POST["newpass"];
    if (!empty($_POST["newpass"])) {
        $hashPassword = password_hash($_POST["newpass"], PASSWORD_BCRYPT);
        $updateQuery = "UPDATE student AS s
        SET s.S_Password = ?
        WHERE s.S_College_Email=?";
    
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ss",$hashPassword,$_SESSION["user_email"]);
    $result->execute();
    }

    $updateQuery = "UPDATE student as s SET s.S_Fname = ?,s.S_Mname = ?,s.S_Lname = ?,s.S_Personal_Email = ?,s.S_Address = ?,s.S_Phone_no = ?,s.S_10th_Perc = ?,s.S_12th_Perc = ?,s.S_Resume = ?,s.S_10th_Marksheet = ?,s.S_12th_Marksheet = ?,s.S_Year_of_Admission = ?
    WHERE s.S_College_Email = ?";
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ssssssddsssis", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["pemail"], $_POST["addr"], $_POST["phno"], $_POST["per10"], $_POST["per12"],$_POST["resume"],$_POST["marksheet_10"],$_POST["marksheet_12"],$yoa ,$_SESSION["user_email"]);
    $result->execute();

    $updateResultQuery = "UPDATE result as r 
SET r.Sem1_SGPA = ?,r.Sem2_SGPA = ?,r.Sem3_SGPA = ?,r.Sem4_SGPA = ?,r.Sem5_SGPA = ?,r.Sem6_SGPA = ?,r.Sem7_SGPA = ?,r.Sem8_SGPA = ?,r.CGPA = ?,r.has_backlogs = ?
WHERE r.S_College_Email = ?";
    $result = $conn->prepare($updateResultQuery);
    $result->bind_param("dddddddddis", $_POST["sem1"], $_POST["sem2"], $_POST["sem3"], $_POST["sem4"], $_POST["sem5"], $_POST["sem6"], $_POST["sem7"], $_POST["sem8"],$_POST["cgpa"],$_POST["backs"], $_SESSION["user_email"]);
    $result->execute();

    $_SESSION['profile_updated'] = true;
    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
    exit();
}

if (isset($_POST["upload_pic"])) {
    $uploadDirectory = '../Data/Students/Profile_Images/';

    $fetchStudentQuery = "SELECT S_Roll_no as rollno, S_Profile_pic as profile_pic FROM student WHERE S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $_SESSION["user_email"]);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();
    $row = $result->fetch_assoc();
    $rollno = $row["rollno"];
    $currentProfilePic = $row["profile_pic"];

    if ($_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profile_pic']['tmp_name'];
        $fileName = basename($_FILES['profile_pic']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = $rollno . '.' . $fileExtension;
            $destination = $uploadDirectory . $newFileName;

            if ($currentProfilePic && $currentProfilePic != 'Default_Profile_Pic.jpg' && file_exists($uploadDirectory . $currentProfilePic)) {
                unlink($uploadDirectory . $currentProfilePic);
            }

            if (move_uploaded_file($tmpName, $destination)) {
                $UploadPicQuery = "UPDATE student SET S_Profile_pic = ? WHERE S_College_Email = ?";
                $UploadPic = $conn->prepare($UploadPicQuery);
                $UploadPic->bind_param("ss", $newFileName, $_SESSION["user_email"]);
                $UploadPic->execute();

                if ($UploadPic->affected_rows > 0) {
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
    <link rel="stylesheet" href="./css/my-profile.css">
    <title>My Profile</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>
        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Edit Profile : </h2>
                <?php
                echo '
                <form action="./my-profile.php" method="post" enctype="multipart/form-data" class="profile-image">
                    <img src="../Data/Students/Profile_Images/' . $StudentImage . '" alt="Profile Picture" id="profile-image">
                    <div class="upload-button-container">
                        <input type="file" name="profile_pic">
                        <button type="submit" name="upload_pic" class="change-picture">Upload Picture</button>
                    </div>
                </form>';
                ?>
                <div class="sections">
                    <form action="./my-profile.php" method="post" onclick="return validateForm()">
                        <h3>Personal Information:</h3>
                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="fname">First Name<span style="color: red;"><sup>*</sup><span/> <span style="color: red;" id="fname_error"></label><br>
                                <input type="text" name="fname" value="' . $StudentFName . '">
                            </div>
                            <div>
                                <label for="mname">Middle Name <span style="color: red;" id="mname_error"></label><br>
                                <input type="text" name="mname" value="' . $StudentMName . '">
                            </div>
                            <div>
                                <label for="lname">Last Name <span style="color: red;" id="lname_error"></label><br>
                                <input type="text" name="lname" value="' . $StudentLName . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No<span style="color: red;"><sup>*</sup><span/> <span style="color: red;" id="phno_error"></label><br>
                                <input type="text" name="phno" value="' . $StudentPhoneNo . '"required>
                            </div>
                            <div>
                                <label for="addr">Address</label><br>
                                <input type="text" name="addr" value="' . $StudentAddress . '">
                            </div>
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="email" name="pemail" value="' . $StudentPEmail . '">
                            </div>
                        </div>';
                        ?>

                        <h3>College Information:</h3>

                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="cemail">College Email</label><br>
                                <input type="text" disabled name="cemail" value="' . $StudentCEmail . '">
                            </div>
                            <div>
                                <label for="prn">PR No. <span style="color: red;" id="prn_error"></label><br>
                                <input type="text" disabled name="prn" value="' . $StudentPRN . '">
                            </div>

                            <div>
                                <label for="rollno">Roll No. <span style="color: red;" id="rollno_error"></label><br>
                                <input type="text" disabled name="rollno" value="' . $StudentRollNo . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="class">Class</label><br>
                                <input type="text" name="class" disabled value="' . $StudentClass . '">
                            </div>

                            <div>
                                <label for="department">Department</label><br>
                                <input type="text" name="department" disabled value="' . $StudentDepartment . '">
                            </div>

                            <div>
                                <label for="batch">Batch<span style="color: red;"><sup>*</sup><span/></label><br>
                                <input type="number" name="yoa" min="2020" max="2040" step="1" value="' . $Batch . '" required/>
                            </div>
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="per10">10th Percentage<span style="color: red;"><sup>*</sup><span/> <span style="color: red;" id="per10_error"></label><br>
                                <input type="number" name="per10" step="0.01" min="0" max="100" value="' .$StudentPercentage_10. '"required>
                            </div>

                            <div>
                                <label for="per12">12th Percentage<span style="color: red;"><sup>*</sup><span/> <span style="color: red;" id="per12_error"></label><br>
                                <input type="number" name="per12" step="0.01" min="0" max="100" value="' . $StudentPercentage_12 . '"required>
                            </div>
                        </div>';
                        
                        if (!empty($StudentResume)) {
                            // Extract URL from HYPERLINK formula
                            $startPos = strpos($StudentResume, '"') + 1;
                            $endPos = strpos($StudentResume, '"', $startPos);
                            $resume = substr($StudentResume, $startPos, $endPos - $startPos);
                        } else {
                            $resume = "";
                        }
                        
                        if (!empty($StudentMarksheet_10)) {
                            // Extract URL from HYPERLINK formula
                            $startPos = strpos($StudentMarksheet_10, '"') + 1;
                            $endPos = strpos($StudentMarksheet_10, '"', $startPos);
                            $marks10 = substr($StudentMarksheet_10, $startPos, $endPos - $startPos);
                        } else {
                            $marks10 = "";
                        }
                        
                        if (!empty($StudentMarksheet_12)) {
                            // Extract URL from HYPERLINK formula
                            $startPos = strpos($StudentMarksheet_12, '"') + 1;
                            $endPos = strpos($StudentMarksheet_12, '"', $startPos);
                            $marks12 = substr($StudentMarksheet_12, $startPos, $endPos - $startPos);
                        } else {
                            $marks12 = "";
                        }
                        
                        // Displaying the input fields
                        echo '<div class="form-adjust">
                            
                            <div>
                                <label for="resume">Resume (PDF Link) <span style="color: red;" id="url_error"></label><br>
                                <input type="text" name="resume" value="' . htmlspecialchars($resume) . '">
                            </div>
                        
                            <div>
                                <label for="marksheet_10">10th Marksheet (PDF Link) <span style="color: red;" id="marksheet_10_error"></label><br>
                                <input type="text" name="marksheet_10" value="' . htmlspecialchars($marks10) . '">
                            </div>
                        
                            <div>
                                <label for="marksheet_12">12th Marksheet / Diploma (PDF Link) <span style="color: red;" id="marksheet_12_error"></label><br>
                                <input type="text" name="marksheet_12" value="' . htmlspecialchars($marks12) . '">
                            </div>
                        </div>';
                        ?>

                        <h3>Change Password:</h3></span>

                        <?php
                        echo '<div class="form-adjust" style="margin-bottom:50px">
                            <div>
                                <label for="newpass">New Password <span style="color: red;" id="error"></label><br>
                                <input type="password" id="newpass" name="newpass">
                            </div>

                            <div>
                                <label for="newpassconfirm">Confirm Password</label><br>
                                <input type="password" id="newpassconfirm" name="newpassconfirm">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="sem1">Sem 1</label><br>
                                <input type="number" name="sem1" step="0.01" min="0" max="10" value="' . $StudentSem1 . '">
                            </div>

                            <div>
                                <label for="sem2">Sem 2</label><br>
                                <input type="number" name="sem2" step="0.01" min="0" max="10" value="' . $StudentSem2 . '">
                            </div>
                            <div>
                                <label for="sem3">Sem 3</label><br>
                                <input type="number" name="sem3" step="0.01" min="0" max="10" value="' . $StudentSem3 . '">
                            </div>

                            <div>
                                <label for="sem4">Sem 4</label><br>
                                <input type="number" name="sem4" step="0.01" min="0" max="10" value="' . $StudentSem4 . '">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="sem5">Sem 5</label><br>
                                <input type="number" name="sem5" step="0.01" min="0" max="10" value="' . $StudentSem5 . '">
                            </div>

                            <div>
                                <label for="sem6">Sem 6</label><br>
                                <input type="number" name="sem6" step="0.01" min="0" max="10" value="' . $StudentSem6 . '">
                            </div>
                            <div>
                                <label for="sem7">Sem 7</label><br>
                                <input type="number" name="sem7" step="0.01" min="0" max="10" value="' . $StudentSem7 . '">
                            </div>

                            <div>
                                <label for="sem8">Sem 8</label><br>
                                <input type="number" name="sem8" step="0.01" min="0" max="10" value="' . $StudentSem8 . '">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="cgpa">CGPA<span style="color: red;"><sup>*</sup><span/></label><br>
                                <input type="number" name="cgpa" step="0.01" min="0" max="10" value="' . $StudentCGPA . '" step="0.01" min="0" max="10" required>
                            </div>
                            <div>
                                <label for="backs">Do you have any backlogs?</label><br>
                                <select name="backs" id="">';
                        if ($StudentBacks == "0") {
                            echo '<option value="0" selected>No</option>
                         <option value="1">Yes</option>
                                </select>
                        </div> 
                        </div>';
                        } else {
                            echo '<option value="0">No</option>
                         <option value="1" selected>Yes</option>
                                </select>
                        </div> 
                        </div>';
                        }

                        ?>
                        <button id="myBtn" name="update_profile">Update</button>

                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Your Profile has been updated successfully</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include './footer.php' ?>
    </div>
    <script>
        function validateForm() {
        let errorSpan = document.getElementById('error');
        errorSpan.textContent = ""; // Clear previous error messages
        let isValid = true; // Flag to check form validity
        
        // Validate First Name
        let fname = document.querySelector('input[name="fname"]').value;
        let fname_errorSpan = document.getElementById('fname_error');
        fname_errorSpan.textContent = ""; // Clear previous error messages
        if (fname.trim() === "") {
            fname_errorSpan.textContent += "First Name is required.\n";
            isValid = false;
        }
        

        // Validate Contact Number
        let phno = document.querySelector('input[name="phno"]').value;
        let phno_errorSpan = document.getElementById('phno_error');
        phno_errorSpan.textContent = ""; // Clear previous error messages
        if (phno.trim() === "") {
            phno_errorSpan.textContent += "Contact Number is required.\n";
            isValid = false;
        } else if (!/^\d{10}$/.test(phno)) {
            phno_errorSpan.textContent += "Enter a valid 10-digit phone no.\n";
            isValid = false;
        }

        

        // Validate Personal Email
        let pemail = document.querySelector('input[name="pemail"]').value;
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (pemail.trim() === "") {
            errorSpan.textContent += "Personal Email is required.\n";
            isValid = false;
        } else if (!pemail.match(emailPattern)) {
            errorSpan.textContent += "Enter a valid email address.\n";
            isValid = false;
        }

        // Validate 10th and 12th Percentages
        let per10 = document.querySelector('input[name="per10"]').value;
        let per12 = document.querySelector('input[name="per12"]').value;
        let per10_errorSpan = document.getElementById('per10_error');
        per10_errorSpan.textContent = ""; // Clear previous error messages
        let per12_errorSpan = document.getElementById('per12_error');
        per12_errorSpan.textContent = ""; // Clear previous error messages
        if (per10 === "" || per10 < 0 || per10 > 100) {
            per10_errorSpan.textContent += "Enter a valid percentage (0-100).\n";
            isValid = false;
        }
        if (per12 === "" || per12 < 0 || per12 > 100) {
            per12_errorSpan.textContent += "Enter a valid percentage (0-100).\n";
            isValid = false;
        }

        // Validate Resume URL (optional but valid if present)
        let resume = document.querySelector('input[name="resume"]').value;
        let url_errorSpan = document.getElementById('url_error');
        url_errorSpan.textContent = ""; // Clear previous error messages
        if (resume.trim() !== "" && !isValidURL(resume)) {
            url_errorSpan.textContent += "Enter a valid URL";
            isValid = false;
        }

        let marksheet_10 = document.querySelector('input[name="marksheet_10"]').value;
        let marksheet_10_errorSpan = document.getElementById('marksheet_10_error');
        marksheet_10_errorSpan.textContent = ""; // Clear previous error messages
        if (marksheet_10.trim() !== "" && !isValidURL(marksheet_10)) {
            marksheet_10_errorSpan.textContent += "Enter a valid URL";
            isValid = false;
        }

        let marksheet_12 = document.querySelector('input[name="marksheet_12"]').value;
        marksheet_12_errorSpan = document.getElementById('marksheet_12_error');
        marksheet_12_errorSpan.textContent = ""; // Clear previous error messages
        if (marksheet_12.trim() !== "" && !isValidURL(marksheet_12)) {
            marksheet_12_errorSpan.textContent += "Enter a valid URL";
            isValid = false;
        }

        // Validate Passwords (if filled)
        let password = document.getElementById('newpass').value;
        let confirmPassword = document.getElementById('newpassconfirm').value;
        if (password.length > 0) {
            if (password.length < 8) {
                errorSpan.textContent += "Password must be at least 8 characters long.\n";
                isValid = false;
            } else if (password !== confirmPassword) {
                errorSpan.textContent += "Passwords do not match.\n";
                isValid = false;
            }
        }

        return isValid; // Return true if all fields are valid
    }

    function isValidURL(url) {
        let pattern = /^(https?:\/\/)?([\w-]+(\.[\w-]+)+)\/?$/i;
        return pattern.test(url);
    }

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        <?php
        // If the profile was updated, show the modal
        if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated']==true) {
            echo 'modal.style.display = "block";';
            // Unset the session variable so the modal doesn't show again on refresh
            unset($_SESSION['profile_updated']);
        }
        ?>
    </script>
</body>

</html>