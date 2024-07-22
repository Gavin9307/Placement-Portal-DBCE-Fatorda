<?php
    require "../restrict.php";
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
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Job Opportunities</h2>

                <div class="sections">
                    <div class="company-container">
                        <div class="company-logo-container">
                            <img src="../Assets/profile.jpg" alt="">
                            <p>Google</p>
                        </div>
                        <p><strong>Due Date:</strong> 12/12/2003</p>
                    </div>
                    <p class="position"><strong>Position:</strong> Associate Developer</p>
                    <p class=""><strong>Details:</strong>
                    <p style="white-space: pre;">Job Description:
                        Software Engineer Campus: Role
                        As Software Engineer, you will implement solutions for a variety of projects in a highly collaborative and
                        fast-paced environment. You will work closely with product and marketing managers, user interaction
                        designers, and other software engineers to develop new product offerings and improve existing ones.

                        Job Responsibilities
                        • Prepare Technical and Design documents.
                        • Code/Configure while strictly following the guidelines.
                        • Unit Test Implementation Changes.
                        • Peer Review requirements and design artifacts, as well as code and configuration.
                        • Integration test in Development/Integration regions.
                        • Communicate with managers and peers on assigned work.
                        • Follow defined processes and procedures.
                        • Adapt/Learn/Use any other technologies as required.

                        Desired Technical Skills
                        • Analytical, Design, and Programming Skills.
                        • Good understanding of Data Structures and Algorithms.
                        • Object-Oriented Programming concepts.
                        • RDBMS concepts, writing and debugging SQL queries.
                        • Familiarity with Design Patterns.
                        • Basic understanding of Operating systems.

                        Desired Business Skills
                        • Exceptional logic and analytical skills.
                        • Excellent verbal and written communication skills in the English language.
                        • Good documentation skills.

                        Education
                        • Successful completion of your course of study.
                    </p>
                    </p>

                    <div class="interest-button-container">
                        <a href="./my-applications-details.php"><button class="interested">Interested</button></a>
                        <a href="./my-applications-details.php"><button class="not-interested">Not Interested</button></a>
                    </div>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>