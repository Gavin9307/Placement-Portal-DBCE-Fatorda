<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["post-job"])) {
    $pcEmail = $_SESSION['user_email'];
    $minCgpa = !empty($_POST['min-cgpa']) ? (float) $_POST['min-cgpa'] : NULL;
    $maxCgpa = !empty($_POST['max-cgpa']) ? (float) $_POST['max-cgpa'] : NULL;
    $moreDetails = !empty($_POST['details']) ? $_POST['details'] : NULL;
    $noPosts = !empty($_POST['no-of-posts']) ? (int) $_POST['no-of-posts'] : NULL;
    $position = !empty($_POST['position']) ? $_POST['position'] : NULL;
    $offeredSalary = !empty($_POST['offered-salary']) ? $_POST['offered-salary'] : NULL;
    $companyId = !empty($_POST['company']) ? (int) $_POST['company'] : NULL;
    $dueDate = !empty($_POST['due-date']) ? $_POST['due-date'] : NULL;
    $backAllowed = !empty($_POST['has_backlogs']) ? (int) $_POST['has_backlogs'] : NULL;
    // $isPlaced = !empty($_POST['is_placed']) ? $_POST['is_placed'] : NULL;
    $percentage10 = !empty($_POST['percentage_10']) ? (float) $_POST['percentage_10'] : NULL;
    $percentage12 = !empty($_POST['percentage_12']) ? (float) $_POST['percentage_12'] : NULL;
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : NULL;

    $conn->begin_transaction();

    try {
        // Insert job placement
        $insertJobQuery = "INSERT INTO jobplacements (J_Backlogs_allowed, J_Description, J_Due_date, J_No_of_posts, J_Offered_salary, J_Position, J_Req_cgpa)
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertJob = $conn->prepare($insertJobQuery);
        $insertJob->bind_param("ississi", $backAllowed, $moreDetails, $dueDate, $noPosts, $offeredSalary, $position, $maxCgpa);
        $insertJob->execute();

        $last_j_id = $conn->insert_id;

        // Insert job post
        $insertJobPostQuery = "INSERT INTO jobposting (C_id, J_id, PC_Email, Job_Post_Date) VALUES (?, ?, ?, CURRENT_DATE)";
        $insertJobPost = $conn->prepare($insertJobPostQuery);
        $insertJobPost->bind_param("iis", $companyId, $last_j_id, $pcEmail);
        $insertJobPost->execute();

        // Insert job departments
        $selectedDepartments = $_POST['departments'];
        foreach ($selectedDepartments as $deptName) {
            $fetchDeptIdQuery = "SELECT Dept_id FROM department WHERE Dept_name = ?";
            $fetchDeptId = $conn->prepare($fetchDeptIdQuery);
            $fetchDeptId->bind_param("s", $deptName);
            $fetchDeptId->execute();
            $result = $fetchDeptId->get_result();
            $row = $result->fetch_assoc();
            $deptId = $row['Dept_id'];

            $insertJobDeptQuery = "INSERT INTO jobdepartments (Dept_id, J_id) VALUES (?, ?)";
            $insertJobDept = $conn->prepare($insertJobDeptQuery);
            $insertJobDept->bind_param("ii", $deptId, $last_j_id);
            $insertJobDept->execute();
        }

        $studentQuery = "SELECT 
    S.PLACED AS placed, 
    R.CGPA AS cgpa,
    S.S_College_Email AS student_email,
    S.S_10th_Perc AS per10,
    S.S_12th_Perc AS per12,
    S.Gender AS gender,
    D.Dept_name AS dname,
    R.has_backlogs AS backs
FROM
    result R 
    INNER JOIN student S ON S.S_College_Email = R.S_College_Email 
    INNER JOIN class C ON C.Class_id = S.S_Class_id 
    INNER JOIN department D ON D.Dept_id = C.Dept_id
WHERE 1=1";

        if (!empty($selectedDepartments)) {
            $departmentConditions = array_map(function ($dept) use ($conn) {
                return "D.Dept_name = '". $conn->real_escape_string($dept) . "'";
            }, $selectedDepartments);
            $studentQuery .= " AND (" . implode(" OR ", $departmentConditions) . ")";
        }

        if (!is_null($minCgpa)) {
            $studentQuery .= " AND cgpa >= $minCgpa";
        }
        if (!is_null($maxCgpa)) {
            $studentQuery .= " AND cgpa <= $maxCgpa";
        }
        // if (!is_null($isPlaced)) {
        //     $studentQuery .= " AND placed = '$isPlaced'";
        // }
        if (!is_null($percentage10)) {
            $studentQuery .= " AND S.S_10th_Perc >= $percentage10";
        }
        if (!is_null($percentage12)) {
            $studentQuery .= " AND S.S_12th_Perc >= $percentage12";
        }
        if (!is_null($gender)) {
            $studentQuery .= " AND gender = '$gender'";
        }
        if (!is_null($backAllowed)) {
            if ($backAllowed == 0) {
                $studentQuery .= " AND R.has_backlogs = 0";
            } else {
                $studentQuery .= " AND R.has_backlogs IN (0, 1)";
            }
        }
        // echo $studentQuery;
        $studentsResult = $conn->query($studentQuery);
        if ($studentsResult->num_rows > 0) {
            $studentJobInsertQuery = "INSERT INTO jobapplication (S_College_Email, J_id, Interest) VALUES (?, ?, ?)";
            $studentJobInsert = $conn->prepare($studentJobInsertQuery);

            while ($student = $studentsResult->fetch_assoc()) {
                $studentEmail = $student['student_email'];
                $interest = 0;
                $studentJobInsert->bind_param("sii", $studentEmail, $last_j_id, $interest);
                $studentJobInsert->execute();
            }
            if (!empty($_POST['round_location'])) {
                $roundLocations = $_POST['round_location'];
                $roundNos = $_POST['round-no'];
                $roundLinks = $_POST['round_link'];
                $roundTimes = $_POST['round_time'];
                $roundDates = $_POST['round_date'];
                $roundDescriptions = $_POST['round_description'];

                // Prepare insert query for rounds
                $insertRoundQuery = "INSERT INTO rounds (J_id, Round_no, Location, Time, Date, description,Link) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $insertRound = $conn->prepare($insertRoundQuery);

                foreach ($roundLocations as $index => $location) {
                    $roundNo = !empty($roundNos[$index]) ? $roundNos[$index] : null;
                    $link = !empty($roundLinks[$index]) ? $roundLinks[$index] : " ";
                    $time = !empty($roundTimes[$index]) ? $roundTimes[$index] : null;
                    $date = !empty($roundDates[$index]) ? $roundDates[$index] : null;
                    $description = !empty($roundDescriptions[$index]) ? $roundDescriptions[$index] : " ";

                    // Bind parameters and execute query
                    $insertRound->bind_param("issssss", $last_j_id,$roundNo,$location,$time, $date, $description,$link );
                    $insertRound->execute();

                    // $last_round_id = $conn->insert_id;
                    // $insertStudentsQuery = "INSERT INTO studentrounds (S_College_Email, R_id, RoundStatus) VALUES (?, ?, ?)";
                    // $insertStudent = $conn->prepare($insertStudentsQuery);
                    // $RoundStatus = "pending";
                    // $insertStudent->bind_param("sis",$studentEmail,$last_round_id,$RoundStatus);
                    // $insertStudent->execute();
                }
            }

            $conn->commit();

            echo "Job successfully posted.";
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "Failed to post job: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post.css">
    <title>Post a Job</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./job-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Post a job</h2>
                </div>

                <div class="sections">
                    <form action="" method="post">
                        <h3>Requirements :</h3>
                        <div class="form-adjust">
                            <div class="departmentbox">
                                <label for="">Department</label>
                                <div class="Checkbox">
                                    <?php
                                    global $conn;
                                    $fetchDepartmentQuery = "SELECT Dept_name as dname FROM department;";
                                    $fetchDepartment = $conn->prepare($fetchDepartmentQuery);
                                    $fetchDepartment->execute();
                                    $result = $fetchDepartment->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div>
                                            <input name="departments[]" value="' . htmlspecialchars($row["dname"]) . '" type="checkbox">
                                            <label for="">' . htmlspecialchars($row["dname"]) . '</label>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="inputbox">
                                <label for="">Min CGPA</label>
                                <input type="number" name="min-cgpa" step="0.1" placeholder="0.0" min="0" max="10">
                            </div>
                            <div class="inputbox">
                                <label for="">Max CGPA</label>
                                <input type="number" name="max-cgpa" step="0.1" placeholder="0.0" min="0" max="10">
                            </div>
                            <!-- <div class="inputbox">
                                <label for="">Placed</label>
                                <select name="is_placed">
                                    <option value="" selected>Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div> -->
                            <div class="inputbox">
                                <label for="">Backlogs</label>
                                <select name="has_backlogs">
                                    <option value="" selected>Select</option>
                                    <option value="1">Allowed</option>
                                    <option value="0">Not Allowed</option>
                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">10th Percentage</label>
                                <input type="number" name="percentage_10">
                            </div>
                            <div class="inputbox">
                                <label for="">12th Percentage</label>
                                <input type="number" name="percentage_12">
                            </div>
                            <div class="inputbox">
                                <label for="">Gender</label>
                                <select name="gender">
                                    <option value="" selected>Select</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                            </div>
                        </div>
                        <h3>Company:</h3>
                        <div class="form-adjust">
                            <div class="inputbox">
                                <label for="">Company:</label>
                                <select name="company">
                                    <option value="" selected>Select</option>
                                    <?php
                                    global $conn;
                                    $fetchCompanyQuery = "SELECT C_id, C_Name FROM company ORDER BY C_Name ASC";
                                    $fetchCompany = $conn->prepare($fetchCompanyQuery);
                                    $fetchCompany->execute();
                                    $result = $fetchCompany->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["C_id"] . '">' . $row["C_Name"] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">Position:</label>
                                <input type="text" name="position">
                            </div>
                            <div class="inputbox">
                                <label for="">Offered Salary:</label>
                                <input type="numeber" name="offered-salary">
                            </div>
                            <div class="inputbox">
                                <label for="">No. of Posts</label>
                                <input type="number" name="no-of-posts">
                            </div>
                            <div class="inputbox">
                                <label for="">Due Date:</label>
                                <input type="date" name="due-date">
                            </div>
                        </div>
                        <h3>More Details:</h3>
                        <textarea name="details" class="textarea-message" placeholder="Enter details" id=""></textarea>

                        <div id="rounds-container">

                        </div>
                        <button type="button" id="add-round" class="add-round-button">Add Round</button>
                        <button type="submit" class="add-button" name="post-job">Post</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let roundCount = 0;

        function addRound() {
            roundCount++;

            const newRoundHTML = `
                <div class="round-section" id="round-${roundCount}">
                    <h3>Round ${roundCount}:</h3>
                    <div class="form-adjust">
                        <div class="inputbox">
                            <label for="location-${roundCount}">Location:</label>
                            <input required type="text" name="round_location[]" id="location-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="link-${roundCount}">Link:</label>
                            <input type="text" name="round_link[]" id="link-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="time-${roundCount}">Time:</label>
                            <input type="time" name="round_time[]" id="time-${roundCount}">
                        </div>
                        <div class="inputbox">
                            <label for="date-${roundCount}">Date:</label>
                            <input type="date" name="round_date[]" id="date-${roundCount}">
                        </div>
                        <input type="hidden" name="round-no[]" value="${roundCount}">
                    </div>
                    <h3>Details:</h3>
                    <textarea name="round_description[]" id="description-${roundCount}" class="textarea-message" placeholder="Enter round details"></textarea>
                    <button type="button" class="add-round-button delete-round-button" data-round-id="round-${roundCount}" style="background-color:red;color:white;margin-bottom:50px;margin-top:-60px">Delete Round</button>
                </div>
            `;

            document.getElementById('rounds-container').insertAdjacentHTML('beforeend', newRoundHTML);
        }

        document.getElementById('add-round').addEventListener('click', addRound);

        document.getElementById('rounds-container').addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-round-button')) {
                const roundId = event.target.getAttribute('data-round-id');
                const roundElement = document.getElementById(roundId);
                if (roundElement) {
                    roundElement.remove();
                    roundCount--;
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Function to check if at least one checkbox is selected
        function validateCheckboxes() {
            const checkboxes = document.querySelectorAll('input[name="departments[]"]');
            for (const checkbox of checkboxes) {
                if (checkbox.checked) {
                    return true;
                }
            }
            return false;
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validateCheckboxes()) {
                alert('Please select at least one department.');
                event.preventDefault();
            }
        });
    });
</script>
</body>

</html>