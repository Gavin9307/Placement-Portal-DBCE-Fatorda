<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET["semail"])) {
    echo '<script type="text/javascript">
       window.history.back();
      </script>';
}
if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $average_rating = 0;
    $usertype = $_SESSION["user_type"];
    $useremail = $_SESSION["user_email"];

    $fetchStudentQuery = "SELECT S.S_10th_marksheet as marksheet_10, S.S_12th_marksheet as marksheet_12, S.S_10th_Perc as percentage_10, S.S_12th_Perc as percentage_12, S.S_Address as address, S.S_College_Email as cemail, S.S_Fname as fname, S.S_Lname as lname, S.S_Mname as mname, S.S_Personal_Email as pemail, S.S_Phone_no as phoneno, S.S_PR_No as prno, S.S_Resume as resume, S.S_Roll_no as rollno, S.S_Year_of_Admission as yoa, C.Class_name as class, D.Dept_name as department, S.S_Profile_pic as image, R.Sem1_SGPA as sem1, R.Sem2_SGPA as sem2, R.Sem3_SGPA as sem3,R.Sem4_SGPA as sem4,R.Sem5_SGPA as sem5,R.Sem6_SGPA as sem6,R.Sem7_SGPA as sem7,R.Sem8_SGPA as sem8,R.CGPA as cgpa,R.has_backlogs as backs FROM student S INNER JOIN class as C ON C.Class_id = S.S_Class_id INNER JOIN department as D ON D.Dept_id = C.Dept_id INNER JOIN result as R ON R.S_College_Email = S.S_College_Email WHERE S.S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s",$_GET["semail"]);
    $fetchStudent->execute();
    $result = $fetchStudent->get_result();

    if ($result->num_rows > 0) {
        $StudentInfo = $result->fetch_assoc();
        $StudentFName = htmlspecialchars($StudentInfo['fname']);
        $StudentMName = htmlspecialchars($StudentInfo['mname']);
        $StudentLName = htmlspecialchars($StudentInfo['lname']);
        $StudentAddress = htmlspecialchars($StudentInfo['address']);
        $StudentMarksheet_12 = htmlspecialchars($StudentInfo['marksheet_12']);
        $StudentMarksheet_10 = htmlspecialchars($StudentInfo['marksheet_10']);
        $StudentPercentage_10 = htmlspecialchars($StudentInfo['percentage_10']);
        $StudentPercentage_12 = htmlspecialchars($StudentInfo['percentage_12']);
        $StudentPEmail = htmlspecialchars($StudentInfo['pemail']);
        $StudentCEmail = htmlspecialchars($StudentInfo['cemail']);
        $StudentClass = htmlspecialchars($StudentInfo['class']);
        $StudentDepartment = htmlspecialchars($StudentInfo['department']);
        $StudentYOA = htmlspecialchars($StudentInfo['yoa']);
        $StudentImage = htmlspecialchars($StudentInfo['image']);
        $StudentRollNo = htmlspecialchars($StudentInfo['rollno']);
        $StudentPhoneNo = htmlspecialchars($StudentInfo['phoneno']);
        $StudentPRN = htmlspecialchars($StudentInfo['prno']);
        $StudentResume = htmlspecialchars($StudentInfo['resume']);
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
    $updateQuery = "UPDATE student as s SET s.S_Fname = ?,s.S_Mname = ?,s.S_Lname = ?,s.S_Personal_Email = ?,s.S_Address = ?,s.S_Phone_no = ?,s.S_10th_Perc = ?,s.S_12th_Perc = ?
    WHERE s.S_College_Email = ?";
    $result = $conn->prepare($updateQuery);
    $result->bind_param("ssssssdds", $_POST["fname"], $_POST["mname"], $_POST["lname"], $_POST["pemail"], $_POST["addr"], $_POST["phno"], $_POST["per10"], $_POST["per12"], $_GET["semail"]);
    $result->execute();

    $_SESSION['profile_updated'] = true;
    echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
    exit();
}

if (isset($_POST["upload_pic"])) {
    $uploadDirectory = '../Data/Students/Profile_Images/';

    $fetchStudentQuery = "SELECT S_Roll_no as rollno, S_Profile_pic as profile_pic FROM student WHERE S_College_Email = ?;";
    $fetchStudent = $conn->prepare($fetchStudentQuery);
    $fetchStudent->bind_param("s", $_GET["semail"]);
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
                $UploadPic->bind_param("ss", $newFileName,$_GET["semail"]);
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

if (isset($_GET["remove"]) && isset($_GET["semail"])) {
    $deleteQuery = "DELETE FROM student WHERE S_College_Email = ?";

    if ($delete = $conn->prepare($deleteQuery)) {
        $delete->bind_param("s", $_GET["semail"]);
        
        if ($delete->execute()) { 
            echo "Delete success";
            header("Location: ./student-management-search-students.php");
            exit();
        } else {
            echo "Delete failed: " . $delete->error; 
        }

        $delete->close();
    } else {
        echo "Delete failed: " . $conn->error; 
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/student-management-view-student.css">
    <title>Student Profile</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>
        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <div class="main-header">
                <h2 class="main-container-heading"><a href="#" onclick="window.history.back(); return false;"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Student Profile : </h2>
                    <a href="#" onclick="confirmDeletion('<?php echo $_GET['semail']; ?>')">
                        <button class="delete-button">Delete Student</button>
                    </a>
                    </div>
                <?php
                echo '
                <form action="./my-profile.php" method="post" enctype="multipart/form-data" class="profile-image">
                    <img src="../Data/Students/Profile_Images/' . $StudentImage . '" alt="Profile Picture" id="profile-image">
                   <!-- <div class="upload-button-container">
                        <input type="file" name="profile_pic">
                        <button type="submit" name="upload_pic" class="change-picture">Upload Picture</button>
                    </div> -->
                </form>';
                ?>
                <div class="sections">
                    <form action="./my-profile.php" method="post">
                        <h3>Personal Information:</h3>
                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" value="' . $StudentFName . '" disabled>
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname" value="' . $StudentMName . '" disabled>
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" value="' . $StudentLName . '" disabled>
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno" value="' . $StudentPhoneNo . '" disabled>
                            </div>
                            <div>
                                <label for="addr">Address</label><br>
                                <input type="text" name="addr" value="' . $StudentAddress . '" disabled>
                            </div>
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail" value="' . $StudentPEmail . '" disabled>
                            </div>
                        </div>';
                        ?>

                        <h3>College Information:</h3>

                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="cemail">College Email</label><br>
                                <input type="text" name="cemail" value="' . $StudentCEmail . '" disabled>
                            </div>
                            <div>
                                <label for="prn">PR No.</label><br>
                                <input type="text" name="prn" value="' . $StudentPRN . '" disabled>
                            </div>

                            <div>
                                <label for="rollno">Roll No.</label><br>
                                <input type="text" name="rollno" value="' . $StudentRollNo . '" disabled>
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="class">Class</label><br>
                                <input type="text" name="class" value="' . $StudentClass . '" disabled>
                            </div>

                            <div>
                                <label for="department">Department</label><br>
                                <input type="text" name="department" value="' . $StudentDepartment . '" disabled>
                            </div>
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="per10">10th Percentage</label><br>
                                <input type="number" name="per10" step="0.01" min="0" max="100" value="' . $StudentPercentage_10 . '" disabled>
                            </div>

                            <div>
                                <label for="per12">12th Percentage</label><br>
                                <input type="number" name="per12" step="0.01" min="0" max="100" value="' . $StudentPercentage_12 . '" disabled>
                            </div>
                        </div>';
                        ?>

                        <?php
                        echo '

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="sem1">Sem 1</label><br>
                                <input type="number" name="sem1" step="0.01" min="0" max="10" value="' . $StudentSem1 . '" disabled>
                            </div>

                            <div>
                                <label for="sem2">Sem 2</label><br>
                                <input type="number" name="sem2" step="0.01" min="0" max="10" value="' . $StudentSem2 . '" disabled>
                            </div>
                            <div>
                                <label for="sem3">Sem 3</label><br>
                                <input type="number" name="sem3" step="0.01" min="0" max="10" value="' . $StudentSem3 . '" disabled>
                            </div>

                            <div>
                                <label for="sem4">Sem 4</label><br>
                                <input type="number" name="sem4" step="0.01" min="0" max="10" value="' . $StudentSem4 . '" disabled>
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="sem5">Sem 5</label><br>
                                <input type="number" name="sem5" step="0.01" min="0" max="10" value="' . $StudentSem5 . '" disabled>
                            </div>

                            <div>
                                <label for="sem6">Sem 6</label><br>
                                <input type="number" name="sem6" step="0.01" min="0" max="10" value="' . $StudentSem6 . '" disabled>
                            </div>
                            <div>
                                <label for="sem7">Sem 7</label><br>
                                <input type="number" name="sem7" step="0.01" min="0" max="10" value="' . $StudentSem7 . '" disabled>
                            </div>

                            <div>
                                <label for="sem8">Sem 8</label><br>
                                <input type="number" name="sem8" step="0.01" min="0" max="10" value="' . $StudentSem8 . '" disabled>
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="cgpa">CGPA</label><br>
                                <input type="number" name="cgpa" step="0.01" min="0" max="10" value="' . $StudentCGPA . '" step="0.01" min="0" max="10" disabled>
                            </div>
                            <div>
                                <label for="backs">Backlogs</label><br>';
                        if ($StudentBacks == "0") {
                            echo '<input type="text" value="No" disabled>
                        </div> 
                        </div>';
                        } else {
                            echo '<input type="text" value="Yes" disabled>
                        </div> 
                        </div>';
                        }

                        ?>
                        <!-- <button id="myBtn" name="update_profile">Update</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeletion(semail) {
    const confirmation = confirm("Are you sure you want to delete this student?");
    if (confirmation) {
        window.location.href = "./student-management-view-student.php?semail=" + semail + "&remove=1";
    }
}
    </script>
</body>

</html>