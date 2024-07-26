<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/tpo-edit-profile.css">
    <title>Edit TPO profile</title>
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
                         <div class="form-container">
                            <form>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="first-name">First name :</label>
                                        <input type="text" id="first-name" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Last name :</label>
                                        <input type="text" id="last-name" placeholder=" ">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="department">Department :</label>
                                        <input type="text" id="department" placeholder="eg. COMP">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact :</label>
                                        <input type="text" id="contact" placeholder="+91892375626">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input type="email" id="email" placeholder="tpo@dbcegoa.ac.in">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="update-position">
                                    <button type="submit" class="update-button">Update</button>
                                </div>
                            </form>
                        </div>
                    
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>