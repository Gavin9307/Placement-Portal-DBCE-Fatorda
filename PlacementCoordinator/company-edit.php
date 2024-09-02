<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET["cid"])) {
    header("Location: ./notifications.php");
    exit();
}

$cid = (int)$_GET["cid"];
$error = "";
if (isset($_POST["update-company"])) {
    $pcEmail = $_SESSION['user_email'];
    $cname = !empty($_POST['cname']) ? $_POST['cname'] : NULL;
    $scope = !empty($_POST['scope']) ? $_POST['scope'] : NULL;
    $location = !empty($_POST['location']) ? $_POST['location'] : NULL;
    $domain = !empty($_POST['domain']) ? $_POST['domain'] : NULL;
    $hrname = !empty($_POST['hrname']) ? $_POST['hrname'] : NULL;
    $hremail = !empty($_POST['hremail']) ? $_POST['hremail'] : NULL;
    $hrcontact = !empty($_POST['hrcontact']) ? $_POST['hrcontact'] : NULL;
    $description = !empty($_POST['description']) ? $_POST['description'] : NULL;
    $link = !empty($_POST['link']) ? $_POST['link'] : NULL;

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $logo = "";
    $logo_uploaded = false;
    if ($_FILES['clogo']['error'] == 0) {
        $fileType = mime_content_type($_FILES['clogo']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $error = "Invalid file type. Only JPEG, JPG, and PNG files are allowed.";
        } else {
            $uploadDir = "../Data/Companies/Company_Logo/";
            $logopath = $uploadDir . 'C_id_' . $cid . '.' . pathinfo($_FILES['clogo']['name'], PATHINFO_EXTENSION);
            if (file_exists($row['C_Logo'])) {
                unlink($row['C_Logo']);
            }
            move_uploaded_file($_FILES["clogo"]["tmp_name"], $logopath);
            $logo = 'C_id_' . $cid . '.' . pathinfo($_FILES['clogo']['name'], PATHINFO_EXTENSION);
            $logo_uploaded = true;
        }
    }

    // Prepare the SQL query
    if ($logo_uploaded) {
        $updateNotiQuery = "UPDATE company 
                            SET C_Name = ?, C_Domain = ?, C_Scope = ?, C_Description = ?, C_Location = ?, C_HR_name = ?, C_HR_email = ?, C_HR_phone = ?, C_PC_Email = ?, C_Website = ?, C_Logo = ?
                            WHERE C_id = ?";
        $result = $conn->prepare($updateNotiQuery);
        $result->bind_param("sssssssssssi", $cname, $domain, $scope, $description, $location, $hrname, $hremail, $hrcontact, $pcEmail, $link, $logo, $cid);
    } else {
        $updateNotiQuery = "UPDATE company 
                            SET C_Name = ?, C_Domain = ?, C_Scope = ?, C_Description = ?, C_Location = ?, C_HR_name = ?, C_HR_email = ?, C_HR_phone = ?, C_PC_Email = ?, C_Website = ?
                            WHERE C_id = ?";
        $result = $conn->prepare($updateNotiQuery);
        $result->bind_param("ssssssssssi", $cname, $domain, $scope, $description, $location, $hrname, $hremail, $hrcontact, $pcEmail, $link, $cid);
    }

    $result->execute();
    header("Location: ./company-edit.php?cid=" . $cid);
    exit();
}

if (isset($_GET["cid"]) && isset($_GET["deleteCompany"])){
    $cid = (int)$_GET["cid"];
    $deleteQuery = "DELETE FROM company
    WHERE company.C_id=?";
    $delete= $conn->prepare($deleteQuery);
    $delete->bind_param("i",$cid);
    if ($delete->execute()){
        header("Location: ./company.php");
        exit();
    }
    else {
        echo "Delete Unsuccessfull";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/company-edit.css">
    <title>Company Edit</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./company.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Edit Company</h2>
                        <a href="#" onclick="confirmCompanyDeletion('<?php echo $cid; ?>')">
                            <button class="delete-button">Delete</button>
                        </a>

                        <script>
                        function confirmCompanyDeletion(cid) {
                            const confirmation = confirm("Are you sure you want to delete this company?\nWARNING: THIS WILL DELETE ENTIRE DATA ASSOCIATED THE COMPANY ie JOBS, STUDENT PLACED etc\n PROCEED WITH CAUTION!");
                            if (confirmation) {
                                window.location.href = "./company-edit.php?cid=" + cid + "&deleteCompany=1";
                            }
                        }
                        </script>
                       
                </div>
                <div class="sections">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        $fetchCompanyQuery = "SELECT * FROM company WHERE C_id = ?;";
                        $fetchCompany = $conn->prepare($fetchCompanyQuery);
                        $fetchCompany->bind_param("i", $cid);
                        $fetchCompany->execute();
                        $result = $fetchCompany->get_result();
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">Company Name:</label>
                                <input type="text" name="cname" placeholder="Company Name" required value="<?php echo $row['C_Name']; ?>">
                            </div>
                            <div class="inputbox">
                                <label for="">Company Logo: <?php echo " <span style='color:red;'>" . $error . "</span>" ?> </label>
                                <input type="file" name="clogo" placeholder="Company Logo" accept=".jpeg, .jpg, .png">
                                <?php if ($row['C_Logo']) : ?>
                                    <p>Current file: <a style="color:blue;" href="<?php echo '../Data/Companies/Company_Logo/' . basename($row['C_Logo']); ?>" target="_blank"><?php echo basename($row['C_Logo']); ?></a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">Market Scope: </label>
                                <input type="text" value="<?php echo $row['C_Scope']; ?>" name="scope" placeholder="Market Scope">
                            </div>
                            <div class="inputbox">
                                <label for="">Location: </label>
                                <input type="text" name="location" value="<?php echo $row['C_Location']; ?>" placeholder="Location">
                            </div>
                        </div>
                        <div class="inputbox">
                            <label for="">Domain: </label>
                            <input type="text" value="<?php echo $row['C_Domain']; ?>" name="domain" placeholder="Domain">
                        </div>
                        <div class="inputbox">
                            <label for="">HR: </label>
                            <input type="text" value="<?php echo $row['C_HR_name']; ?>" name="hrname" placeholder="Company representative">
                        </div>
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">HR Email: </label>
                                <input type="text" value="<?php echo $row['C_HR_email']; ?>" name="hremail" placeholder="HR Email">
                            </div>
                            <div class="inputbox">
                                <label for="">HR Contact Number: </label>
                                <input type="text" value="<?php echo $row['C_HR_phone']; ?>" name="hrcontact" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="inputbox">
                            <label for="">Company Website:</label>
                            <input type="text" name="link" value="<?php echo $row['C_Website']; ?>" placeholder="www.company.com">
                        </div>
                        <div class="inputbox">
                            <label for="">Description:</label>
                            <textarea required class="textarea-message" name="description" id="" placeholder="Description"><?php echo $row['C_Description']; ?></textarea>
                        </div>

                        <button class="update-button" name="update-company" type="submit">Update Company</button>

                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>
