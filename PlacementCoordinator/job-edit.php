<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["jid"])) {
    header("Location: ./job-management.php");
    exit();
}

$jid = (int)$_GET["jid"];

if (isset($_POST["update-button"])) {
    $position = $_POST['position'] ?? null;
    $offeredSalary = $_POST['offered-salary'] ?? null;
    $noPosts = $_POST['no-of-posts'] ?? null;
    $dueDate = $_POST['due-date'] ?? null;
    $details = $_POST['details'] ?? null;
    $companyId = $_POST['company'] ?? null;

    // Collect round data
    $roundLocations = $_POST['round_location'] ?? [];
    $roundLinks = $_POST['round_link'] ?? [];
    $roundTimes = $_POST['round_time'] ?? [];
    $roundDates = $_POST['round_date'] ?? [];
    $roundDescriptions = $_POST['round_description'] ?? [];
    $roundIds = $_POST['round_id'] ?? []; // New hidden field for round IDs

    $conn->begin_transaction();

    try {
        // Update job placement details
        $updateJobQuery = "UPDATE jobplacements SET 
            J_Position = COALESCE(?, J_Position), 
            J_Offered_salary = COALESCE(?, J_Offered_salary), 
            J_No_of_posts = COALESCE(?, J_No_of_posts), 
            J_Due_date = COALESCE(?, J_Due_date), 
            J_Description = COALESCE(?, J_Description) 
            WHERE J_id = ?";
        $updateJob = $conn->prepare($updateJobQuery);
        $updateJob->bind_param("sisssi", $position, $offeredSalary, $noPosts, $dueDate, $details, $jid);
        $updateJob->execute();

        // Update job posting company
        if ($companyId) {
            $updateJobPostQuery = "UPDATE jobposting SET C_id = ? WHERE J_id = ?";
            $updateJobPost = $conn->prepare($updateJobPostQuery);
            $updateJobPost->bind_param("ii", $companyId, $jid);
            $updateJobPost->execute();
        }

        // Fetch existing rounds
        $fetchExistingRoundsQuery = "SELECT Round_no FROM rounds WHERE J_id = ?";
        $fetchExistingRounds = $conn->prepare($fetchExistingRoundsQuery);
        $fetchExistingRounds->bind_param("i", $jid);
        $fetchExistingRounds->execute();
        $existingRoundsResult = $fetchExistingRounds->get_result();
        $existingRounds = [];
        while ($row = $existingRoundsResult->fetch_assoc()) {
            $existingRounds[] = $row['Round_no'];
        }

        // Delete rounds that are not in the updated list
        $roundsToDelete = array_diff($existingRounds, array_filter($roundIds));
        if (!empty($roundsToDelete)) {
            $deleteRoundsQuery = "DELETE FROM rounds WHERE J_id = ? AND Round_no IN (" . implode(',', array_fill(0, count($roundsToDelete), '?')) . ")";
            $deleteRounds = $conn->prepare($deleteRoundsQuery);
            $deleteRounds->bind_param(str_repeat('i', count($roundsToDelete)), ...$roundsToDelete);
            $deleteRounds->execute();
        }

        // Update existing rounds and insert new ones
        $updateRoundQuery = "UPDATE rounds SET Location = ?, Time = ?, Date = ?, description = ?, Link = ? WHERE J_id = ? AND Round_no = ?";
        $insertRoundQuery = "INSERT INTO rounds (J_id, Round_no, Location, Time, Date, description, Link) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $updateRound = $conn->prepare($updateRoundQuery);
        $insertRound = $conn->prepare($insertRoundQuery);

        foreach ($roundLocations as $index => $location) {
            $roundNo = $roundIds[$index] ?? null;
            $link = !empty($roundLinks[$index]) ? $roundLinks[$index] : null;
            $time = !empty($roundTimes[$index]) ? $roundTimes[$index] : null;
            $date = !empty($roundDates[$index]) ? $roundDates[$index] : null;
            $description = !empty($roundDescriptions[$index]) ? $roundDescriptions[$index] : null;

            if (in_array($roundNo, $existingRounds)) {
                // Update existing round
                $updateRound->bind_param("sssssii", $location, $time, $date, $description, $link, $jid, $roundNo);
                $updateRound->execute();
            } else {
                // Insert new round
                $insertRound->bind_param("issssss", $jid, $roundNo, $location, $time, $date, $description, $link);
                $insertRound->execute();
            }
        }

        $conn->commit();
        // echo "Job successfully updated.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Failed to update job: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post-edit.css">
    <title>Edit Job Posting</title>
</head>
<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./job-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Edit job</h2>
                </div>

                <div class="sections">
                    <form action="" method="post">
                        <?php
                        $fetchQuery = "SELECT jp.J_Position as position, jp.J_No_of_posts as posts, jp.J_Offered_salary as salary, jp.J_Description as description, jp.J_Due_date as duedate, c.C_id as cid 
                        FROM jobplacements as jp
                        INNER JOIN jobposting as j on j.J_id=jp.J_id
                        INNER JOIN company as c on c.C_id=j.C_id
                        WHERE jp.J_id = ?";
                        $fetch = $conn->prepare($fetchQuery);
                        $fetch->bind_param("i", $jid);
                        $fetch->execute();
                        $result = $fetch->get_result();
                        $row = $result->fetch_assoc();
                        ?>

                        <h3>Basic Information:</h3>
                        <div class="form-adjust">
                            <div class="inputbox">
                                <label for="">Company:</label>
                                <select name="company">
                                    <?php
                                    global $conn;
                                    $fetchCompanyQuery = "SELECT C_id, C_Name FROM company ORDER BY C_Name ASC";
                                    $fetchCompany = $conn->prepare($fetchCompanyQuery);
                                    $fetchCompany->execute();
                                    $result = $fetchCompany->get_result();

                                    while ($temprow = $result->fetch_assoc()) {
                                        $selected = '';
                                        if ($row['cid'] == $temprow['C_id']) {
                                            $selected = 'selected';
                                        }
                                        echo '<option value="' . $temprow["C_id"] . '" ' . $selected . '>' . $temprow["C_Name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">Position:</label>
                                <input value="<?php echo htmlspecialchars($row['position']); ?>" type="text" name="position">
                            </div>
                            <div class="inputbox">
                                <label for="">Offered Salary:</label>
                                <input value="<?php echo htmlspecialchars($row['salary']); ?>" type="number" name="offered-salary">
                            </div>
                            <div class="inputbox">
                                <label for="">No. of Posts</label>
                                <input value="<?php echo htmlspecialchars($row['posts']); ?>" type="number" name="no-of-posts">
                            </div>
                            <div class="inputbox">
                                <label for="">Due Date:</label>
                                <input value="<?php echo htmlspecialchars($row['duedate']); ?>" type="date" name="due-date">
                            </div>
                        </div>
                        <h3>More Details:</h3>
                        <textarea name="details" class="textarea-message" placeholder="Enter details"><?php echo htmlspecialchars($row['description']); ?></textarea>

                        <?php
                            $fetchRoundsQuery = "SELECT r.Round_no as rno, r.Link as rlink, r.Time as rtime, r.Date as rdate, r.Description as rdescription, r.Location as location1
                                FROM rounds as r
                                WHERE r.J_id = ?";
                            $fetchRounds = $conn->prepare($fetchRoundsQuery);
                            $fetchRounds->bind_param("i", $jid);
                            $fetchRounds->execute();
                            $result = $fetchRounds->get_result();
                            $existingRounds = [];
                            if ($result->num_rows > 0) {
                                echo '<div id="rounds-container">';
                                while ($roundrow = $result->fetch_assoc()) {
                                    $existingRounds[] = $roundrow["rno"];
                                    echo '<div class="round-section">
                                    <h3>Round '.$roundrow["rno"].':</h3>
                                    <input type="hidden" name="round_id[]" value="'.$roundrow["rno"].'">
                                    <div class="form-adjust">
                                        <div class="inputbox">
                                            <label for="location-'.$roundrow["rno"].'">Location:</label>
                                            <input value="'.htmlspecialchars($roundrow["location1"]).'" required type="text" name="round_location[]" id="location-'.$roundrow["rno"].'">
                                        </div>
                                        <div class="inputbox">
                                            <label for="link-'.$roundrow["rno"].'">Link:</label>
                                            <input value="'.htmlspecialchars($roundrow["rlink"]).'" type="text" name="round_link[]" id="link-'.$roundrow["rno"].'">
                                        </div>
                                        <div class="inputbox">
                                            <label for="time-'.$roundrow["rno"].'">Time:</label>
                                            <input value="'.htmlspecialchars($roundrow["rtime"]).'" type="text" name="round_time[]" id="time-'.$roundrow["rno"].'">
                                        </div>
                                        <div class="inputbox">
                                            <label for="date-'.$roundrow["rno"].'">Date:</label>
                                            <input value="'.htmlspecialchars($roundrow["rdate"]).'" type="date" name="round_date[]" id="date-'.$roundrow["rno"].'">
                                        </div>
                                    </div>
                                    <h3>Details:</h3>
                                        <textarea name="round_description[]" id="description-'.$roundrow["rno"].'" class="textarea-message" placeholder="Enter round details">'.htmlspecialchars($roundrow["rdescription"]).'</textarea>
                                </div>';
                                }
                                echo '</div>';
                            }
                        ?>
                        <button type="submit" name="update-button" class="add-button">Update Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
