<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_placement_coordinator.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
} 
if (!(isset($_GET["jid"])&&isset($_GET["cid"]))){
    header("Location: my-applications-details.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $message = $_POST['message'];
    $rating = (int)$_POST['rating'];
    $userEmail = $_SESSION["user_email"];
    $cid =(int)$_GET["cid"];
    $jid = (int)$_GET["jid"];

    // Prepare the query to insert or update feedback
    $insertFeedbackQuery = "INSERT INTO feedback (J_id,C_id,S_College_Email, Message, Rating) VALUES (?,?, ?, ?,?)
                            ON DUPLICATE KEY UPDATE Message=?, Rating=?";
    $insertFeedback = $conn->prepare($insertFeedbackQuery);
    $insertFeedback->bind_param("iississ", $jid,$cid,$userEmail,$message, $rating,$message, $rating);
    if ($insertFeedback->execute()) {
        echo "Success";
        // Feedback submitted successfully!
    } else {
        // Error handling
        echo "Error: " . $conn->error;
    }
}

// Fetch existing feedback
$fetchFeedbackQuery = "SELECT f.Message as message, f.Rating as rating FROM company as c
        INNER JOIN feedback as f on c.C_id = f.C_id
        INNER JOIN jobposting as jp on jp.C_id = c.C_id
        WHERE f.S_College_Email = ? ;";
$fetchFeedback = $conn->prepare($fetchFeedbackQuery);
$fetchFeedback->bind_param("s", $_SESSION["user_email"]);
$fetchFeedback->execute();
$result = $fetchFeedback->get_result();
if ($result->num_rows>0){
    $row = $result->fetch_assoc();
    $message = $row["message"];
    $rating =(int) $row["rating"];
}
else {
    $message = "";
    $rating = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications-feedback.css">
    <title>My Applications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .star-rating {
          display: inline-block;
          font-size: 0;
          position: relative;
        }
        .star {
          cursor: pointer;
          font-size: 2rem;
          color: lightgray;
          transition: color 0.2s;
        }
        .star.checked {
          color: orange;
        }
      </style>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    My Applications</h2>

                <div class="sections">
                    <div class="company-logo-container">
                        <h3>Company Feedback</h3>

                        <?php
                        $cid =(int)$_GET["cid"];
                        $fetchCompanyQuery = "SELECT c.C_Logo as clogo FROM company as c WHERE c.C_id = ?";
                        $fetchCompany = $conn->prepare($fetchCompanyQuery);
                        $fetchCompany->bind_param("i", $cid);
                        $fetchCompany->execute();
                        $result5 = $fetchCompany->get_result();
                        $row5 = $result5->fetch_assoc();
                        echo '<img src="../Data/Companies/Company_Logo/' . $row5['clogo'] . '" alt="">'
                        ?>
                    </div>

                    <form action="" method="post">
                        <label for="message"><strong>Message:</strong></label>
                        <textarea class="user-input-message" placeholder="Enter your message" name="message" required><?php echo $message; ?></textarea><br><br>

                        <strong>Ratings:</strong>
                        <div class="rating-container" id="starRatingContainer">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="<?php echo $rating; ?>">
                        <br><br>
                        <button type="submit" name="submit_feedback">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

    

</body>
<script>
    const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingInput');

// Initial check to set the stars based on the current rating value
const initialRating = ratingInput.value;
if (initialRating) {
  updateStars(initialRating);
}

stars.forEach(star => {
  star.addEventListener('click', () => {
    const value = star.getAttribute('data-value');
    ratingInput.value = value;
    updateStars(value);
  });
});

function updateStars(value) {
  stars.forEach(star => {
    if (star.getAttribute('data-value') <= value) {
      star.classList.add('checked');
    } else {
      star.classList.remove('checked');
    }
  });
}

  </script>
</html>