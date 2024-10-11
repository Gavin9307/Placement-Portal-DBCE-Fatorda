<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}
//0- pending, 1-successful, 2-error
$question = 0;
if (isset($_GET["questionsuccess"]) && $_GET["questionsuccess"]==1) {
    $question = 1;
}
if (isset($_GET["questionerror"]) && $_GET["questionerror"]==1) {
    $question = 2;
}
if (isset($_POST["question-add-button"])) {
    $addQuestionQuery = "INSERT INTO questions(Question_Text) VALUES (?)";
    $addQuestion = $conn->prepare($addQuestionQuery);
    $addQuestion->bind_param("s", $_POST["qname"]);
   if( $addQuestion->execute()){
        header("Location: ./job-post-questions.php?questionsuccess=1");
    }
    else{
        header("Location: ./job-post-questions.php?questionerror=1");
    }
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
    
    <div id="successful" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The Question has been added successfully</p>
        </div>
    </div>
    <div id="error" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an error while adding the question</p>
        </div>
    </div>
</body>

<script>
   
    // Get the modals
    var successfulModal = document.getElementById("successful");
    var errorModal = document.getElementById("error");
    // Get the <span> elements that close the modals
    var closeButtons = document.getElementsByClassName("close");

    // Close the modal when the user clicks on <span> (x)
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].onclick = function() {
            successfulModal.style.display = "none";
            errorModal.style.display = "none";
        }
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
         if (event.target == successfulModal) {
            successfulModal.style.display = "none";
            errorModal.style.display = "none";
        }
    }
    
        // Trigger the appropriate modal based on PHP variable
        <?php if ($question == 1) : ?>
            successfulModal.style.display = "block";
        <?php elseif ($question == 2) : ?>
                errorModal.style.display = "block";
            <?php endif; ?>
</script>

</html>