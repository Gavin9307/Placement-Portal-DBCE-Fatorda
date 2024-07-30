<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/tpo-profile.css">
    <title>TPO profile</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Profile</h2>
                       
                </div>
            
            <div class="parent">
                          <div> <img src="../Assets/profile.jpg" alt=""></div>
                          <div><a href="#"><button class="add-button">Change picture</button></a></div>
            </div>
                <div class="sections">
                    <div class = "sec1">
                         <p><strong>First name </strong>: Patric</p>
                         <p><strong>Last name </strong>:Colaco</p>
                         <p><strong>Email </strong>: 2114018@dbcegoa.ac.in</p>
                         <p><strong>Contact  </strong>: 9483827383</p>
                         <p><strong>Department </strong>: Computer</p>
                         

                    </div>
                    <div class= "sec2">   
                        <a href="#"><button class="add-button">Update</button></a>
                    </div>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>