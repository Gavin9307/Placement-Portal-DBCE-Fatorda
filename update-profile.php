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
        if($stmt->execute()){
            $_SESSION["reg_complete"] = "complete";
            setcookie('reg_complete', 'complete', time() + 86400 * 30, '/');
            header("Location: ./Students/dashboard.php");
        }
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
                    <form action="" method="post" onsubmit="return validateForm()">
                        <h3>Personal Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="fname">First Name<span style="color:red">*</span><span style="color:red" id="fname_error"></span></label><br>
                                <input type="text" name="fname" placeholder="Enter your first name" required>
                            </div>
                            <div>
                                <label for="mname">Middle Name<span style="color:red" id="mname_error"></span></label><br>
                                <input type="text" name="mname" placeholder="Enter your middle name" >
                            </div>
                            <div>
                                <label for="lname">Last Name<span style="color:red">*</span><span style="color:red" id="lname_error"></span></label><br>
                                <input type="text" name="lname" placeholder="Enter your last name" required>
                            </div>
                            <div>
                                <label for="gender">Gender<span style="color:red">*</span><span style="color:red" id="gender_error"></span></label><br>
                                <select type="text" name="gender">
                                    <option value="" selected>Choose Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="phno">Contact No<span style="color:red">*</span><span style="color:red" id="contact_error"></span></label><br>
                                <input type="text" name="phno" placeholder="Enter 10 digit phone no." required>
                            </div>
                            <div>
                                <label for="addr">Address<span style="color:red">*</span><span style="color:red" id="address_error"></span></label><br>
                                <input type="text" name="address" placeholder="Enter your address" required>
                            </div>
                            <div>
                                <label for="pemail">Personal Email<span style="color:red">*</span><span style="color:red" id="email_error"></span></label><br>
                                <input type="text" name="pemail" placeholder="Enter your personal email" required>
                            </div>
                            <div>
                                <label for="yoa">Year of Admission<span style="color:red">*</span><span style="color:red" id="yoa_error"></span></label><br>
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
                                <label for="prn">PR No.<span style="color:red">*</span><span style="color:red" id="prn_error"></span></label><br>
                                <input type="text" name="prn" placeholder="Permanent Registration Number" required>
                            </div>

                            <div>
                                <label for="rollno">Roll No.<span style="color:red">*</span><span style="color:red" id="roll_error"></span></label><br>
                                <input type="text" name="rollno" placeholder="Roll Number" required>
                            </div>
                            <div>
                                <label for="class">Class<span style="color:red">*</span><span style="color:red" id="class_error"></span></label><br>
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
                                <label for="per10">10th Percentage<span style="color:red">*</span><span style="color:red" id="per10_error"></span></label><br>
                                <input type="number" name="per10" step="0.01" min="0" max="100" placeholder="Enter your 10th percentage">
                            </div>

                            <div>
                                <label for="per12">12th Percentage<span style="color:red">*</span><span style="color:red" id="per12_error"></span></label><br>
                                <input type="number" name="per12" step="0.01" min="0" max="100" placeholder="Enter your 12th percentage">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="sem1">Sem 1</label><br>
                                <input type="number" name="sem1" step="0.01" min="0" max="10" placeholder="Sem 1 SGPA">
                            </div>

                            <div>
                                <label for="sem2">Sem 2</label><br>
                                <input type="number" name="sem2" step="0.01" min="0" max="10" placeholder="Sem 2 SGPA">
                            </div>
                            <div>
                                <label for="sem3">Sem 3</label><br>
                                <input type="number" name="sem3" step="0.01" min="0" max="10" placeholder="Sem 3 SGPA">
                            </div>

                            <div>
                                <label for="sem4">Sem 4</label><br>
                                <input type="number" name="sem4" step="0.01" min="0" max="10" placeholder="Sem 4 SGPA">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="sem5">Sem 5</label><br>
                                <input type="number" name="sem5" step="0.01" min="0" max="10" placeholder="Sem 5 SGPA">
                            </div>

                            <div>
                                <label for="sem6">Sem 6</label><br>
                                <input type="number" name="sem6" step="0.01" min="0" max="10" placeholder="Sem 6 SGPA">
                            </div>
                            <div>
                                <label for="sem7">Sem 7</label><br>
                                <input type="number" name="sem7" step="0.01" min="0" max="10" placeholder="Sem 7 SGPA">
                            </div>

                            <div>
                                <label for="sem8">Sem 8</label><br>
                                <input type="number" name="sem8" step="0.01" min="0" max="10" placeholder="Sem 8 SGPA">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="cgpa">CGPA</label><br>
                                <input type="number" name="cgpa" step="0.01" min="0" max="10" step="0.01" min="0" max="10" placeholder="CGPA">
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
<script>
    function validateForm() {
        let isValid = true;
        
        // First Name validation (no digits allowed)
        let fname = document.querySelector("input[name='fname']").value;
        let nameRegex = /^[A-Za-z]+(\s[A-Za-z]+)*$/;
        if (fname === "") {
            document.getElementById("fname_error").textContent = "First Name is required";
            isValid = false;
        } else if (!nameRegex.test(fname)) {
            document.getElementById("fname_error").textContent = "First Name must contain only letters";
            isValid = false;
        } else {
            document.getElementById("fname_error").textContent = "";
        }

        // Middle Name validation (no digits allowed)
        let mname = document.querySelector("input[name='mname']").value;
        if (mname !== "" && !nameRegex.test(mname)) {
            document.getElementById("mname_error").textContent = "Middle Name must contain only letters";
            isValid = false;
        } else {
            document.getElementById("mname_error").textContent = "";
        }

        // Last Name validation (no digits allowed)
        let lname = document.querySelector("input[name='lname']").value;
        if (lname === "") {
            document.getElementById("lname_error").textContent = "Last Name is required";
            isValid = false;
        } else if (!nameRegex.test(lname)) {
            document.getElementById("lname_error").textContent = "Last Name must contain only letters";
            isValid = false;
        } else {
            document.getElementById("lname_error").textContent = "";
        }

        // Gender validation
        let gender = document.querySelector("select[name='gender']").value;
        if (gender === "") {
            document.getElementById("gender_error").textContent = "Please select a gender";
            isValid = false;
        } else {
            document.getElementById("gender_error").textContent = "";
        }

        // Class validation
        let className = document.querySelector("select[name='class']").value;
        if (className === "") {
            document.getElementById("class_error").textContent = "Please select a class";
            isValid = false;
        } else {
            document.getElementById("class_error").textContent = "";
        }

        // Phone number validation (10 digits)
        let phno = document.querySelector("input[name='phno']").value;
        let phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(phno)) {
            document.getElementById("contact_error").textContent = "Please enter a valid 10-digit phone number";
            isValid = false;
        } else {
            document.getElementById("contact_error").textContent = "";
        }

        // Email validation
        let pemail = document.querySelector("input[name='pemail']").value;
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(pemail)) {
            document.getElementById("email_error").textContent = "Please enter a valid email";
            isValid = false;
        } else {
            document.getElementById("email_error").textContent = "";
        }

        // 10th percentage validation
        let per10 = document.querySelector("input[name='per10']").value;
        if (per10 < 0 || per10 > 100) {
            document.getElementById("per10_error").textContent = "Please enter a valid percentage between 0 and 100";
            isValid = false;
        } else {
            document.getElementById("per10_error").textContent = "";
        }

        // 12th percentage validation
        let per12 = document.querySelector("input[name='per12']").value;
        if (per12 < 0 || per12 > 100) {
            document.getElementById("per12_error").textContent = "Please enter a valid percentage between 0 and 100";
            isValid = false;
        } else {
            document.getElementById("per12_error").textContent = "";
        }

        return isValid;
    }
</script>
</html>