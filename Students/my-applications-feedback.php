<?php
require "../conn.php";
require "../restrict.php";
include "../utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $message = $_POST['message'];
    $rating = (int)$_POST['rating'];
    $userEmail = $_SESSION["user_email"];

    // Prepare the query to insert or update feedback
    $insertFeedbackQuery = "INSERT INTO feedback (S_College_Email, Message, Rating) VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE Message=?, Rating=?";
    $insertFeedback = $conn->prepare($insertFeedbackQuery);
    $insertFeedback->bind_param("ssisi", $userEmail, $message, $rating, $message, $rating);

    if ($insertFeedback->execute()) {
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
    $row = $result->fetch_assoc();
    $message = $row["message"];
    $rating = (int) $row["rating"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications-feedback.css">
    <title>My Applications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
        .star {
            cursor: pointer;
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
                        <img src="../Assets/oneshield.png" alt="">
                    </div>

                    <form action="" method="post">
                        <label for="message"><strong>Message:</strong></label>
                        <textarea class="user-input-message" placeholder="Enter your message" name="message" required><?php echo htmlspecialchars($message); ?></textarea><br><br>

                        <strong>Ratings:</strong>
                        <span class="rating-container">
                            <span class="fa fa-star fa-xl star" data-value="1"></span>
                            <span class="fa fa-star fa-xl star" data-value="2"></span>
                            <span class="fa fa-star fa-xl star" data-value="3"></span>
                            <span class="fa fa-star fa-xl star" data-value="4"></span>
                            <span class="fa fa-star fa-xl star" data-value="5"></span>
                        </span>
                        <input type="hidden" name="rating" id="rating-input" value="<?php echo $rating; ?>">
                        <br><br>
                        <button type="submit" name="submit_feedback">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.rating-container .star');
            const ratingInput = document.getElementById('rating-input');

            // Set initial star rating
            const initialRating = parseInt(ratingInput.value);
            stars.forEach((star, index) => {
                if (index < initialRating) {
                    star.classList.add('checked');
                }
            });

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    // Update the rating
                    ratingInput.value = index + 1;
                    stars.forEach((s, i) => {
                        s.classList.toggle('checked', i <= index);
                    });
                });
            });
        });
    </script>

</body>

</html>
