<?php
    require "../conn.php";
    global $conn;
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_GET["id"])) {
        if (isset($_SESSION["user_type"]) && isset($_SESSION["user_email"])) {
            $average_rating = 0;
            $usertype = $_SESSION["user_type"]; // For Restriction
            $useremail = $_SESSION["user_email"];

            $fetchCompanyQuery = "SELECT * FROM company WHERE C_id = ?";
            $fetchCompany = $conn->prepare($fetchCompanyQuery);
            $fetchCompany->bind_param("s", $_GET["id"]);
            $fetchCompany->execute();
            $result = $fetchCompany->get_result();

            if ($result->num_rows > 0) {
                $companyInfo = $result->fetch_assoc();
                $companyName = htmlspecialchars($companyInfo['C_Name']);
                $companyLocation = htmlspecialchars($companyInfo['C_Location']);
                $companyLink = htmlspecialchars($companyInfo['C_Website']);
                $hrName = htmlspecialchars($companyInfo['C_HR_name']);
                $hrEmail = htmlspecialchars($companyInfo['C_HR_email']);
                $hrPhone = htmlspecialchars($companyInfo['C_HR_phone']);
                $companyDescription = htmlspecialchars($companyInfo['C_Description']);
                $companyImage = htmlspecialchars($companyInfo['C_Logo']);
                $companyDomain = htmlspecialchars($companyInfo['C_Domain']);
                $companyScope = htmlspecialchars($companyInfo['C_Scope']);
            
                // Ratings
                $ratingsQuery = "SELECT SUM(Rating) as total_ratings, COUNT(C_id) as total_cid FROM feedback WHERE C_id = ?";
                $ratings = $conn->prepare($ratingsQuery);
                $ratings->bind_param("s", $_GET["id"]);
                $ratings->execute();
                $resultRatings = $ratings->get_result();
                
                if ($resultRatings->num_rows > 0) {
                    $row = $resultRatings->fetch_assoc();
                    $total_ratings = $row['total_ratings'];
                    $total_cid = $row['total_cid'];
                    if ($total_cid > 0) {
                        $average_rating = $total_ratings / $total_cid;
                    } else {
                        $average_rating = 0;
                    }
                }
                else {
                    $average_rating = 0;
                }
            } else {
                // Handle case where results are not obtained
            }
        } else {
            // Handle case where session variables are not set
            // Restricted
            echo "Session variables not set.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/company-details.css">
    <title>Companies</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Company Details</h2>

                <div class="sections">
                    <div class="company-container">
                        <?php 
                            echo '<h3>'.  $companyName .'<br>
                            <p>'.$companyScope.'</p>
                         </h3>';
                        
                        
                            echo '<img src="../Data/Companies/Company_Logo/'. $companyImage . '" alt="' . $companyName . '">';
                        ?>
                    </div>
                    <p class="">
                        <strong>Ratings:</strong> 
                        <span class="rating-container">
                            <?php 
                                $i = 0;
                                while ($i<$average_rating && $i < 5){
                                    echo '<span class="fa fa-star checked fa-xl"></span>';
                                    $i++;
                                }
                                while ($i < 5) {
                                    echo '<span class="fa fa-star fa-xl"></span>';
                                    $i++;
                                }
                            ?>
                        </span></p>

                    <div class="more-details">
                        <?php
                            echo "<p><strong>Domain:</strong> ".$companyDomain."</p>
                        <p><strong>Location:</strong> ".$companyLocation."</p>
                        <p><strong>Link:</strong> ".$companyLink."</p>
                        <p><strong>HR:</strong> ".$hrName."</p>
                        <p><strong>HR Email:</strong> ".$hrEmail."</p>
                        <p><strong>HR Phone no.:</strong> ".$hrPhone."</p>
                        <p><strong>Description:</strong> ".$companyDescription."</p>"
                        ?>
                        
                        
                    </div>

                    <div class="students-reviews-container">
                        <p><strong>Student Reviews:</strong></p>
                        <div class="students-review">
                            <div class="students-container">
                                <div class="students-logo-container">
                                    <img src="../Assets/profile.jpg" alt="">
                                    <p>Syndroy Araujo</p>
                                </div>
                                <div class="rating-container">
                                    <span class="fa fa-star checked fa-xl"></span>
                                    <span class="fa fa-star checked fa-xl"></span>
                                    <span class="fa fa-star checked fa-xl"></span>
                                    <span class="fa fa-star fa-xl"></span>
                                    <span class="fa fa-star fa-xl"></span>
                                </div>
                            </div>
                            <p class="students-message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, dolor optio officiis laboriosam similique facere harum ad voluptates reiciendis soluta dignissimos magnam minus beatae est dolorum nulla exercitationem dicta, modi ab aliquid iste sequi provident debitis. Temporibus eos ut harum quod hic, quis aliquid sunt. Corporis quod ut aperiam veniam.</p>
                        </div>
                    </div>

                </div>



            </div>

        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>