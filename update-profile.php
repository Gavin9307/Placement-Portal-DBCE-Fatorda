<?php
require "./conn.php";
require "./restrict.php";
include "./utility_functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["create_profile"])) {
    function handle_empty($input)
    {
        return empty($input) ? NULL : htmlspecialchars($input);
    }
    function handle_empty_int($input)
    {
        return empty($input) ? 0 : htmlspecialchars($input);
    }

    // Debugging statements
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    $StudentFName = handle_empty($_POST['fname']);
    $StudentMName = empty($_POST['mname']) ? "" : $_POST['mname'];
    $StudentLName = handle_empty($_POST['lname']);
    $StudentAddress = handle_empty($_POST['address']);
    $StudentPercentage_10 = handle_empty($_POST['per10']);
    $StudentPercentage_12 = handle_empty($_POST['per12']);
    $StudentPEmail = handle_empty($_POST['pemail']);
    $StudentClass = handle_empty($_POST['class']);
    $StudentYOA = handle_empty($_POST['yoa']);  // Check if this is set correctly
    $StudentImage = "Default_Profile_Pic.jpg";
    $StudentRollNo = handle_empty($_POST['rollno']);
    $StudentPhoneNo = handle_empty($_POST['phno']);
    $StudentPRN = handle_empty($_POST['prn']);
    $StudentSem1 = handle_empty_int($_POST['sem1']);
    $StudentSem2 = handle_empty_int($_POST['sem2']);
    $StudentSem3 = handle_empty_int($_POST['sem3']);
    $StudentSem4 = handle_empty_int($_POST['sem4']);
    $StudentSem5 = handle_empty_int($_POST['sem5']);
    $StudentSem6 = handle_empty_int($_POST['sem6']);
    $StudentSem7 = handle_empty_int($_POST['sem7']);
    $StudentSem8 = handle_empty_int($_POST['sem8']);
    $StudentSem8 = handle_empty_int($_POST['sem8']);
    $StudentCGPA = handle_empty_int($_POST['cgpa']);
    $StudentBacks = empty($_POST['backs']) || is_null($_POST['backs']) ? 0 : $_POST['mname'];

    $updateStudentQuery = "UPDATE student SET 
        S_Fname = ?, 
        S_Mname = ?, 
        S_Lname = ?, 
        S_Personal_Email = ?, 
        S_Address = ?, 
        S_Phone_no = ?, 
        S_Roll_no = ?, 
        S_PR_No = ?, 
        S_10th_Perc = ?, 
        S_12th_Perc = ?, 
        S_Profile_pic = ?, 
        S_Class_id = ?, 
        S_Year_of_Admission = ?, 
        Gender = ?, 
        registration_complete = ? 
        WHERE S_College_Email = ?";

    // Prepare the statement
    $stmt = $conn->prepare($updateStudentQuery);

    // Use 1 for registration_complete since it's a boolean flag (assuming 1 for true)
    $registrationComplete = 1;

    // Bind parameters
    $stmt->bind_param(
        "ssssssssddssssis",
        $StudentFName,
        $StudentMName,
        $StudentLName,
        $StudentPEmail,
        $StudentAddress,
        $StudentPhoneNo,
        $StudentRollNo,
        $StudentPRN,
        $StudentPercentage_10,
        $StudentPercentage_12,
        $StudentImage,
        $StudentClass,
        $StudentYOA,
        $_POST['gender'],
        $registrationComplete,
        $_SESSION['user_email']
    );


    if ($stmt->execute()) {
        $semesters = [$StudentSem1, $StudentSem2, $StudentSem3, $StudentSem4, $StudentSem5, $StudentSem6, $StudentSem7, $StudentSem8];
        foreach ($semesters as &$sem) {
            if (empty($sem)) {
                $sem = 0;
            }
        }

        $insertResultsQuery = "INSERT INTO result (S_College_Email, Sem1_SGPA, Sem2_SGPA, Sem3_SGPA, Sem4_SGPA, Sem5_SGPA, Sem6_SGPA, Sem7_SGPA, Sem8_SGPA, CGPA, has_backlogs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertResultsQuery);
        $stmt->bind_param("sdddddddddd", $_SESSION['user_email'], $semesters[0], $semesters[1], $semesters[2], $semesters[3], $semesters[4], $semesters[5], $semesters[6], $semesters[7], $StudentCGPA, $StudentBacks);
        $stmt->execute();

        // echo "Profile created successfully!";

        header("Location: ./Students/dashboard.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="update-profile.css">
    <title>Enter Details</title>
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
                </ul>
            </div>
        </header>
        <main>
            <div class="main-container">
                <h3>Create Profile :</h3>
                <?php
                // echo '<form action="" method="post" enctype="multipart/form-data" class="profile-image">
                //    <img src="../Data/Students/Profile_Images/" alt="Profile Picture" id="profile-image">
                //     <input type="file" name="profile-picture" id="profile-picture-input" style="display:none;">
                //     <div class="upload-button-container">
                //         <button type="button" onclick="document.getElementById(\'profile-picture-input\').click();" class="change-picture">Select Picture</button>
                //         <button type="submit" name="upload" class="change-picture">Upload Picture</button>
                //     </div>
                // </form>';
                ?>
                <div class="sections">
                    <form action="" method="post">
                        <h3>Personal Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" required>
                            </div>
                            <div>
                                <label for="mname">Middle Name</label><br>
                                <input type="text" name="mname">
                            </div>
                            <div>
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" required>
                            </div>
                            <div>
                                <label for="gender">Gender</label><br>
                                <select type="text" name="gender">
                                    <option value="" selected>Choose Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No</label><br>
                                <input type="text" name="phno" required>
                            </div>
                            <div>
                                <label for="addr">Address</label><br>
                                <input type="text" name="address" required>
                            </div>
                            <div>
                                <label for="pemail">Personal Email</label><br>
                                <input type="text" name="pemail" required>
                            </div>
                            <div>
                                <label for="yoa">Year of Admission</label><br>
                                <input type="number" name="yoa" min="2020" max="2035" step="1" value="2024" required />
                            </div>
                        </div>
                        <div class="form-adjust">

                        </div>

                        <h3>College Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="cemail">College Email</label><br>
                                <input type="text" name="cemail" disabled value="<?php echo $_SESSION['user_email'] ?>">
                            </div>
                            <div>
                                <label for="prn">PR No.</label><br>
                                <input type="text" name="prn" required>
                            </div>

                            <div>
                                <label for="rollno">Roll No.</label><br>
                                <input type="text" name="rollno" required>
                            </div>
                            <div>
                                <label for="class">Class</label><br>
                                <select type="text" name="class">
                                    <option value="" selected>Choose Class</option>
                                    <?php
                                    $fetchDeptQuery = "SELECT * FROM `class`";
                                    $fetchDept = $conn->prepare($fetchDeptQuery);
                                    $fetchDept->execute();
                                    $result = $fetchDept->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['Class_id'] . '">' . $row["Class_name"] . '</option >';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="per10">10th Percentage</label><br>
                                <input type="number" name="per10" step="0.01" min="0" max="100">
                            </div>

                            <div>
                                <label for="per12">12th Percentage</label><br>
                                <input type="number" name="per12" step="0.01" min="0" max="100">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="sem1">Sem 1</label><br>
                                <input type="number" name="sem1" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem2">Sem 2</label><br>
                                <input type="number" name="sem2" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="sem3">Sem 3</label><br>
                                <input type="number" name="sem3" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem4">Sem 4</label><br>
                                <input type="number" name="sem4" step="0.01" min="0" max="10">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="sem5">Sem 5</label><br>
                                <input type="number" name="sem5" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem6">Sem 6</label><br>
                                <input type="number" name="sem6" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="sem7">Sem 7</label><br>
                                <input type="number" name="sem7" step="0.01" min="0" max="10">
                            </div>

                            <div>
                                <label for="sem8">Sem 8</label><br>
                                <input type="number" name="sem8" step="0.01" min="0" max="10">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="cgpa">CGPA</label><br>
                                <input type="number" name="cgpa" step="0.01" min="0" max="10" step="0.01" min="0" max="10">
                            </div>
                            <div>
                                <label for="backs">Do you have any backlogs?</label><br>
                                <select name="backs" id="">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <button id="myBtn" name="create_profile">Create Profile</button>
                    </form>
                </div>
            </div>

        </main>
        <?php include 'footer.php' ?>
    </div>
</body>
<script defer src="./FontAwesome/JS/all.js"></script>

</html>