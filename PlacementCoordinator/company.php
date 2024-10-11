<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";

if (!isset($_SESSION)) {
    session_start();
}
// 0-pending  1-error  2-success
$addError = 0 ;


if (isset($_GET["deletesuccess"]) && $_GET["deletesuccess"]==1) {
    $addError = 2;
}
if (isset($_GET["deleteerror"]) && $_GET["deleteerror"]==1) {
    $addError = 1;
}
function get_companies()
{
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
            echo '<div>
                            <a href="./company-edit.php?cid=' . $company_id . '">
                            <div class="company-card">
                                <img src="../Data/Companies/Company_Logo/' . $company_logo . '" alt="' . $company_name . '">
                                <p>' . $company_name . '</p>
                            </div>
                        </a>
                      </div>';
        }
    } else {
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
                <a href="./company-create.php"><button id="add-button">Add Company</button></a>
                <div class="sections">
                    <div class="company-container">
                        <form class="search-container" action="" method="get">
                            <input type="text" name="company_search" placeholder="Company name">
                            <button>Submit</button>
                        </form>
                    </div>
                    <div class="company-grid">
                        <?php
                        get_companies();
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <?php include './footer.php' ?>
    </div>
    
    <div id="delete" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>The Company has been deleted successfully</p>
        </div>
    </div>
    <div id="error" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>There was an Error while deleting the company</p>
        </div>
    </div>
</body>
<script>
        // Get the modals
        var errorModal = document.getElementById("error");
        var deleteModal = document.getElementById("delete");

        // Get the <span> elements that close the modals
        var closeButtons = document.getElementsByClassName("close");

        // Close the modal when the user clicks on <span> (x)
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                errorModal.style.display = "none";
                deleteModal.style.display = "none";

            }
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == errorModal) {
                errorModal.style.display = "none";
            } 
            else if (event.target == successfulModal) {
                deleteModal.style.display = "none";
            }
        }

        // Trigger the appropriate modal based on PHP variable
        <?php if ($addError == 1) : ?>
            errorModal.style.display = "block";
        <?php elseif ($addError == 2) : ?>
            deleteModal.style.display = "block";
        <?php endif; ?>
    </script>
</html>