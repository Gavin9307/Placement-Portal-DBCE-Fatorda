<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/Placement-Coordinator-Details.css">
    <title>Placement Coordinators</title>
</head>

<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                Placement Coordinators</h2>    
                </div>
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-lg" style="color: #000000;"></i></a>
                Nimish Noronha</h2> 
                <div class="sections">
                    <div class = "sec1">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-adjust">
                    <div class="inputbox">
                                <label for="">First Name :</label>
                                <input name="first_name" type="text" placeholder="Student">
                    </div>
                    <div class="inputbox">
                                <label for="">Last Name :</label>
                                <input name="last_name" type="text" placeholder="Last Name">
                    </div>
                    <div class="inputbox">
                                <label for="">Department :</label>
                                <input name="department" type="text" placeholder="Department">
                    </div>
                    <div class="inputbox">
                                <label for="">Contact No :</label>
                                <input name="contact_no" type="text" placeholder="Contact No">
                    </div>
                    <div class="inputbox">
                                <label for="">Email :</label>
                                <input name="email" type="text" placeholder="Email">
                    </div>
                    </div>
                    </form>
                    </div>
                    <div class= "sec2">   
                    <img src="../Assets/profile.jpg" alt="">
                    <div><a href="#"><button class="add-button">Change Image</button></a></div>
                    <div><a href="#"><button class="add-button">Update</button></a></div>
                    </div>
                </div>         
             
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>