<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script defer src="../FontAwesome/JS/all.js"></script>
    <link rel="stylesheet" href="./css/my-applications-feedback.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>My Applications</title>
    
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="../Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <a href="./dashboard.php"><li>Dashboard</li></a>
                    <li>Contact Us</li>
                    <div class="notifications">
                        <div class="dot">.</div><i class="fa-solid fa-bell"></i>
                    </div>
                    <li class="profile-container">
                        <span>Gavin</span>
                        <img src="../Assets/profile.jpg" alt="">
                    </li>
                </ul>
            </div>
        </header>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    My Applications</h2>

                <div class="sections">
                        <div class="company-logo-container">
                            <h3>Company Feedback</h3>
                            <img src="../Assets/oneshield.png" alt="">
                        </div>
                        <form action="">
                            <label for="message"><strong>Message:</strong></label>
                            <textarea class="user-input-message" placeholder="Enter your message" required></textarea><br><br>
    
                            <button>Submit</button>
                            <strong>Ratings:</strong> 
                            <span class="rating-container">
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star checked fa-xl"></span>
                                <span class="fa fa-star fa-xl"></span>
                            </span>
                            <button>Submit</button>
                        </form>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-container">
                <div class="left-footer-part">
                    <h4>Address</h4>
                    <p>Don Bosco College of Engineering, Fatorda, Margao, Goa - 403602<br>Tel No.: (0832)
                        2744111/2744112<br>E-mail : dbcefatorda@dbcegoa.ac.in</p>
                </div>
                <div class="right-footer-part">
                    <h4>Follow us</h4>
                    <div class="social-icons-list">
                        <a href="https://www.linkedin.com/school/don-bosco-college-of-engineering-fatorda-goa/"><i
                                class="ico fa-brands fa-square-facebook fa-3x"></i></a>
                        <a href="https://www.instagram.com/dbce_fatorda/"><i
                                class="ico fa-brands fa-square-instagram fa-3x"></i></a>
                        <a
                            href="https://www.facebook.com/p/Don-Bosco-College-of-EngineeringFatorda-Goa-100063749630574/"><i
                                class="ico fa-brands fa-linkedin fa-3x"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>