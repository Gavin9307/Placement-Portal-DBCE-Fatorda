<?php

    require "../conn.php";
    
    function get_companies() {
        global $conn;
        $search_company = isset($_GET['company_search']) ? $_GET['company_search'] : '';
    
        if (!empty($search_company)) {
            $fetchCompanyQuery = "SELECT C_id, C_Name, C_logo FROM company WHERE C_Name LIKE ?";
            $companies = $conn->prepare($fetchCompanyQuery);
            $search_param = "%{$search_company}%";
            $companies->bind_param("s", $search_param);
        } else {
            $fetchCompanyQuery = "SELECT C_id, C_Name, C_logo FROM company";
            $companies = $conn->prepare($fetchCompanyQuery);
        }
    
        $companies->execute();
        $result = $companies->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $company_id = htmlspecialchars($row['C_id']);
                $company_name = htmlspecialchars($row['C_Name']);
                $company_logo = htmlspecialchars($row['C_logo']);
                echo '<div class="company-grid">
                        <a href="./company-details.php?id=' . $company_id . '">
                            <div class="company-card">
                                <img src="../Data/Companies/Company_Logo/'. $company_logo . '" alt="' . $company_name . '">
                                <p>' . $company_name . '</p>
                            </div>
                        </a>
                      </div>';
            }
        }
        else {
            echo '<div style="margin-top:20px;padding: 20px;background-color: #fcdb03;color: white;border-radius:5px;">
                        <strong>No Company Found !</strong>
                    </div>';
        }
    
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/companies.css">
    <title>Companies</title>
    
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>
        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Companies</h2>

                <div class="sections">
                    <div class="company-container">
                        <form class="search-container" action="./companies.php" method="get">
                            <input type="text" name="company_search" placeholder="Company name">
                            <button>Submit</button>
                        </form>
                    </div>
                    <?php
                        get_companies();
                    ?>
                </div>
            </div>

        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>