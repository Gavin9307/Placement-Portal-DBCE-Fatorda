<?php
    require "../conn.php";
    require "../restrict.php";
    require "../restrict_placement_coordinator.php";
    include "../utility_functions.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>

    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading">Dashboard</h2>
                


                <div class="sections">
                    <h3>My Applications</h3>
                    <div class="sub-sections companies">
                        <div class="right1"><a href="./my-applications.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <div class="sub-table">
                            <?php
                                $email = $_SESSION["user_email"];
                                $fetchApplicationsQuery = "SELECT C.C_Name AS cname, 
                                    C.C_Logo AS clogo, 
                                    A.J_apply_date AS applydate, 
                                    P.J_Position AS position, 
                                    A.J_id AS jid 
                                FROM company AS C
                                INNER JOIN jobposting AS J ON J.C_id = C.C_id
                                INNER JOIN jobplacements AS P ON P.J_id = J.J_id
                                INNER JOIN jobapplication AS A ON A.J_id = J.J_id
                                WHERE A.Interest = ? 
                                AND A.S_College_Email = ?
                                ORDER BY A.J_apply_date DESC
                                LIMIT 3;
                                ";

                                $fetchApplications = $conn->prepare($fetchApplicationsQuery);
                                $z = 1;
                                $fetchApplications->bind_param("is", $z, $_SESSION["user_email"]);
                                $fetchApplications->execute();
                                $result = $fetchApplications->get_result();
                                
                                if ($result->num_rows>0){
                                    $i = $result->num_rows;
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="sub-table-row">
                                                    <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                                                    <p>' . $row['cname'] . '</p>
                                                    <p>' . $row['position'] . '</p>
                                                </div>';

                                        if($i!=1){
                                            echo " <hr>";
                                        }
                                        $i--;
                                    }
                                }else{
                                    echo '<div>
                                            No Job Opportunities
                                        </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="sections">
                    <h3>Job Opportunities</h3>
                    <div class="sub-sections companies">
                       <a href="./job-opportunities.php"> <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <div class="sub-table">
                            <?php
                                $fetchJobQuery = "SELECT C.C_Name AS cname, 
                                    C.C_Logo AS clogo, 
                                    P.J_Due_date AS duedate, 
                                    P.J_Position AS position, 
                                    J.J_id AS jid 
                                FROM company AS C
                                INNER JOIN jobposting AS J ON J.C_id = C.C_id
                                INNER JOIN jobplacements AS P ON P.J_id = J.J_id
                                INNER JOIN jobapplication AS JA ON JA.J_id = P.J_id
                                WHERE P.J_Due_date >= CURRENT_DATE 
                                AND P.Accept_Responses = 1 
                                AND JA.S_College_Email = ?
                                ORDER BY P.J_Due_date DESC
                                LIMIT 3;
                                ";
                            
                                $fetchJob = $conn->prepare($fetchJobQuery);
                                $fetchJob->bind_param("s", $email);
                                $fetchJob->execute();
                                $result = $fetchJob->get_result();

                                if ($result->num_rows>0){
                                    $i = $result->num_rows;
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="sub-table-row">
                                                    <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                                                    <p>' . $row['cname'] . '</p>
                                                    <p>' . $row['position'] . '</p>
                                                </div>';

                                        if($i!=1){
                                            echo " <hr>";
                                        }
                                        $i--;
                                    }
                                }else{
                                    echo '<div>
                                            No Job Opportunities
                                        </div>';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>