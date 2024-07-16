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
                        <form class="search-container" action="">
                            <input type="text" name="company-search" placeholder="Company name">
                            <button>Submit</button>
                        </form>
                    </div>
                    <div class="company-grid">
                        <a href="./company-details.php">
                            <div class="company-card">
                                <img src="../Assets/oneshield.png" alt="">
                                <p>OneShield</p>
                            </div>
                        </a>
                        <a href="./company-details.php">
                            <div class="company-card">
                                <img src="../Assets/oneshield.png" alt="">
                                <p>OneShield</p>
                            </div>
                        </a>
                        <a href="./company-details.php">
                            <div class="company-card">
                                <img src="../Assets/oneshield.png" alt="">
                                <p>OneShield</p>
                            </div>
                        </a>
                        <a href="./company-details.php">
                            <div class="company-card">
                                <img src="../Assets/oneshield.png" alt="">
                                <p>OneShield</p>
                            </div>
                        </a>
                        <a href="./company-details.php">
                            <div class="company-card">
                                <img src="../Assets/oneshield.png" alt="">
                                <p>OneShield</p>
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>

        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>