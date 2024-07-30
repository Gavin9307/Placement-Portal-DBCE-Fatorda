<?php
require "../restrict.php";
require "../utility_functions.php";
require "../conn.php";

if (!isset($_GET["jid"])){
    header("Location: ./job-opportunities.php");
    exit();
}
global $conn;

$modalTrigger = 'none'; // Initialize modal trigger variable

if (isset($_GET["interest"])) {
    $interest = (int)$_GET["interest"];
    $jid = (int)$_GET["jid"];
    $email = $_SESSION['user_email'];

    $UpdateQuery = "UPDATE jobapplication J
                    SET J.Interest = ?
                    WHERE J.J_id = ? AND J.S_College_Email = ?;";

    $Update = $conn->prepare($UpdateQuery);
    if (!$Update) {
        die("Prepare failed: " . $conn->error);
    }

    $Update->bind_param("iis", $interest, $jid, $email);
    if (!$Update->execute()) {
        die ("Execute failed: " . $Update->error);
    } else {
        // Set modal trigger to show the success modal
        $modalTrigger = $interest == 1 ? 'interested' : 'notInterested';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-opportunities-detail.css">
    <title>Job Opportunities</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>
            <div class="main-container">
                <h2 class="main-container-heading"><a href="./job-opportunities.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <?php
                        getJobDetail($_GET['jid']);
                    ?>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <div id="interestedModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Your application has been successfully sent</p>
            </div>
        </div>

        <div id="notInterestedModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Marked as not interested</p>
            </div>
        </div>

        <script>
            // Get the modals
            var interestedModal = document.getElementById("interestedModal");
            var notInterestedModal = document.getElementById("notInterestedModal");

            // Get the <span> elements that close the modals
            var closeButtons = document.getElementsByClassName("close");

            // Close the modal when the user clicks on <span> (x)
            for (var i = 0; i < closeButtons.length; i++) {
                closeButtons[i].onclick = function() {
                    interestedModal.style.display = "none";
                    notInterestedModal.style.display = "none";
                }
            }

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function(event) {
                if (event.target == interestedModal) {
                    interestedModal.style.display = "none";
                }
                if (event.target == notInterestedModal) {
                    notInterestedModal.style.display = "none";
                }
            }

            // Show modal based on PHP set variable
            var modalTrigger = "<?php echo $modalTrigger; ?>";
            if (modalTrigger === 'interested') {
                interestedModal.style.display = "block";
            } else if (modalTrigger === 'notInterested') {
                notInterestedModal.style.display = "block";
            }
        </script>

        <?php include './footer.php' ?>
    </div>
</body>
</html>
