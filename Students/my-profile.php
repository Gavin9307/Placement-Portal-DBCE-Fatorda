<?php
require "../conn.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
    $average_rating = 0;
    $usertype = $_SESSION["user_type"]; // For Restriction
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
    // Handle case where session variables are not set
    // Restricted
    echo "Session variables not set.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-profile.css">
    <title>My Applications</title>
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
                    echo '<form action="./my-profile.php" method="post" enctype="multipart/form-data" class="profile-image">
                   <img src="../Data/Students/Profile_Images/'.$StudentImage.'" alt="Profile Picture" id="profile-image">
                    <input type="file" name="profile-picture" id="profile-picture-input" style="display:none;">
                    <div class="upload-button-container">
                        <button type="button" onclick="document.getElementById("profile-picture-input").click();" class="change-picture">Select Picture</button>
                        <button type="submit" name="upload" class="change-picture">Upload Picture</button>
                    </div>
                </form>';
                ?>
                <div class="sections">
                    <form action="" method="post">
                        <h3>Personal Information:</h3>
                        <?php
                        echo '<div class="form-adjust">
                            <div>
                                <label for="">First Name</label><br>
                                <input type="text" value="'.$StudentFName.'">
                            </div>
                            <div>
                                <label for="" >Middle Name</label><br>
                                <input type="text" value="'.$StudentMName.'">
                            </div>
                            <div>
                                <label for="" >Last Name</label><br>
                                <input type="text" value="'.$StudentLName.'">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="" >Contact No</label><br>
                                <input type="text" value="'.$StudentPhoneNo.'">
                            </div>
                            <div>
                                <label for="" >Address</label><br>
                                <input type="text" value="'.$StudentAddress.'">
                            </div>
                            <div>
                                <label for="" >Personal Email</label><br>
                                <input type="text" value="'.$StudentPEmail.'">
                            </div>
                        </div>';
                        ?>
                        
                        <h3>College Information:</h3>

                        <?php
                            echo '<div class="form-adjust">
                            <div>
                                <label for="">College Email</label><br>
                                <input type="text" value="'.$StudentCEmail.'">
                            </div>
                            <div>
                                <label for="">PR No.</label><br>
                                <input type="text" value="'.$StudentPRN.'">
                            </div>

                            <div>
                                <label for="" >Roll No.</label><br>
                                <input type="text" value="'.$StudentRollNo.'">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="" >Class</label><br>
                                <input type="text" value="'.$StudentClass.'">
                            </div>

                            <div>
                                <label for="">Department</label><br>
                                <input type="text"  value="'.$StudentDepartment.'">
                            </div>
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="" >10th Percentage</label><br>
                                <input type="text" value="'.$StudentPercentage_10.'">
                            </div>

                            <div>
                                <label for="" >12th Percentage</label><br>
                                <input type="text" value="'.$StudentPercentage_12.'">
                            </div>
                        </div>';
                        ?>
                        
                        <h3>Change Password:</h3>

                        <?php
                        echo '<div class="form-adjust">

                            <div>
                                <label for="" value="">New Password</label><br>
                                <input type="text">
                            </div>

                            <div>
                                <label for="" value="">Confirm Password</label><br>
                                <input type="text">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="">Sem 1</label><br>
                                <input type="text" value="'.$StudentSem1.'">
                            </div>

                            <div>
                                <label for="" >Sem 2</label><br>
                                <input type="text" value="'.$StudentSem2.'">
                            </div>
                            <div>
                                <label for="" >Sem 3</label><br>
                                <input type="text" value="'.$StudentSem3.'">
                            </div>

                            <div>
                                <label for="" >Sem 4</label><br>
                                <input type="text" value="'.$StudentSem4.'">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="">Sem 5</label><br>
                                <input type="text" value="'.$StudentSem5.'">
                            </div>

                            <div>
                                <label for="">Sem 6</label><br>
                                <input type="text"  value="'.$StudentSem6.'">
                            </div>
                            <div>
                                <label for="" >Sem 7</label><br>
                                <input type="text" value="'.$StudentSem7.'">
                            </div>

                            <div>
                                <label for="" >Sem 8</label><br>
                                <input type="text" value="'.$StudentSem8.'">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="" >CGPA</label><br>
                                <input type="text" value="'.$StudentCGPA.'">
                            </div>
                        <div>
                                <label for="" >Do you have any backlogs?</label><br>
                                <select name="" id="">';
                        if ($StudentBacks == "0"){
                            echo '<option value="0" selected>No</option>
                         <option value="1">Yes</option>
                                </select>
                        </div> 
                        </div>';
                        }
                        else {
                            echo '<option value="0" >No</option>
                         <option value="1" selected>Yes</option>
                                </select>
                        </div> 
                        </div>';
                        }
                        
                        ?>
                        
                        <button>Update</button>
                    </form>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>