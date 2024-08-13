<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["question-add-button"])) {
    $addQuestionQuery = "INSERT INTO questions(Question_Text) VALUES (?)";
    $addQuestion = $conn->prepare($addQuestionQuery);
    $addQuestion->bind_param("s", $_POST["qname"]);
    $addQuestion->execute();
    header("Location: ./job-post-questions.php");
    exit();
}

if (isset($_GET["remove"])) {
    $qid = (int) $_GET["qid"];
    $removeQuestionQuery = "UPDATE Questions
    SET Is_Deleted = TRUE 
    WHERE Question_ID=?";
    $removeQuestion = $conn->prepare($removeQuestionQuery);
    $removeQuestion->bind_param("i", $qid);
    $removeQuestion->execute();
    header("Location: ./job-post-questions.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post-questions.css">
    <title>Job Post Additional Questions</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading">
                        <a href="./dashboard.php">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </a>
                        Job Additional Questions
                    </h2>
                </div>

                <h3>Additional Questions</h3>
                <div class="form-adjust">
                    <form action="" method="post">
                        <div class="inputbox">
                            <label for=""><b>Enter a Question:</b></label>
                            <input type="text" name="qname" placeholder="Add a question to the database ">
                        </div>
                        <div class="button-container">
                            <button name="question-add-button" class="add-button">Add</button>
                        </div>
                    </form>
                </div>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Questions</th>
                            <th>Remove</th>
                        </tr>

                        <?php getQuestions(); ?>
                       
                    </table>
                </div>                    
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>
</body>
</html>