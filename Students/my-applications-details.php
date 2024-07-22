<?php
    require "../restrict.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-applications-details.css">
    <title>My Application Details</title>
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
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Apply Date:</strong> 12/12/2003</p>
                    </div>
                    <div class="position-application-container">
                        <p><strong>Position:</strong> Associate Developer</p>
                        <p><strong>Position:</strong> Associate Developer</p>
                    </div>
                    
                    <a href="./my-applications-feedback.php"><button>Give Feedback</button></a>
                    
                    <!-- Round Details Start Here -->
                    <br><hr><br>
                    <div class="round-heading">
                        <h3>Round 1:</h3>
                        <p><strong>Round Status:</strong> Passed</p>
                    </div>
                    <div class="round-details">
                        <p><strong>Round Status:</strong> Passed</p>
                        <p><strong>Date:</strong> 12/12/2003</p>
                        <p><strong>Time:</strong> 6-7 pm</p>
                        <p><strong>Link:</strong>  test.google.com</p>
                        <p><strong>Details:</strong> <p style="white-space: pre-wrap;">Guidelines for the online test and interviews are mentioned below
(A) Instructions for the Online Test:-
                            
1. Duration of test - 60 mins
2. No negative marking
3. Calculators are not allowed
4. Test sections - (1) Quantitative Ability (2) Technical Skills (3) Coding
5. Total questions - 40
6. You may switch through the sections of test
7. The test is proctored and the browser activity is monitored by the admin. Test takers who navigate away from the Mettl browser will be disqualified. Kindly refrain from doing so. (Once the test begins, students should not try opening a new tab/browser)
On the day of the drive, for any doubt/query regarding the online test, students can reach out to me
                            
1) Tejal Raut (8291845096)</p></p>
                        
                    </div>

                     <!-- Round Details Start Here -->
                     <br><hr><br>
                     <div class="round-heading">
                         <h3>Round 2:</h3>
                         <p><strong>Round Status:</strong> Passed</p>
                     </div>
                     <div class="round-details">
                         <p><strong>Round Status:</strong> Passed</p>
                         <p><strong>Date:</strong> 12/12/2003</p>
                         <p><strong>Time:</strong> 6-7 pm</p>
                         <p><strong>Link:</strong>  test.google.com</p>
                         <p><strong>Details:</strong> <p style="white-space: pre-wrap;">Guidelines for the online test and interviews are mentioned below
 (A) Instructions for the Online Test:-
                             
 1. Duration of test - 60 mins
 2. No negative marking
 3. Calculators are not allowed
 4. Test sections - (1) Quantitative Ability (2) Technical Skills (3) Coding
 5. Total questions - 40
 6. You may switch through the sections of test
 7. The test is proctored and the browser activity is monitored by the admin. Test takers who navigate away from the Mettl browser will be disqualified. Kindly refrain from doing so. (Once the test begins, students should not try opening a new tab/browser)
 On the day of the drive, for any doubt/query regarding the online test, students can reach out to me
                             
 1) Tejal Raut (8291845096)</p></p>
                         
                     </div>
                    
                </div>

                <div class="sections">
                    <div class="offer-letter-container">
                        <p style="white-space: pre;"><strong>Offer Letter:</strong> <span class="offer-letter">offerletter.pdf </span>  <i class="fa-solid fa-upload fa-sm" style="color: #0C07E4;"></i>  <i class="fa-solid fa-xmark fa-lg" style="color: #FB1616;"></i> </p>
                        <a href=""><button>Submit</button></a>
                    </div>
                </div>
            </div>
        </div>

        

        <?php include './footer.php' ?>
    </div>

</body>

</html>