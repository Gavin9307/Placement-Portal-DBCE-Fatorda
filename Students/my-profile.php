<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/my-profile.css">
    <title>My Applications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Edit Profile : </h2>

                <div class="profile-image">
                    <img src="../Assets/profile.jpg" alt="">
                    <a href=""><button class="change-picture">Change Picture</button></a>
    
                    <!-- <input type="file" name="" id=""> -->
                    <!-- <a href=""><button class="change-picture">Submit</button></a> -->
                </div> 
                

                <div class="sections">
                    <form action="" method="post">
                        <h3>Personal Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="">First Name</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Middle Name</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Last Name</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="">Contact No</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Address</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Personal Email</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <h3>College Information:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="">College Email</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">PR No.</label><br>
                                <input type="text">
                            </div>
    
                            <div>
                                <label for="">Roll No.</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="">Department</label><br>
                                <select name="" id="">
                                     <option value=""disabled selected>Select</option>
                                    <option value="">Computer</option>
                                    <option value="">Mechanical</option>
                                    <option value="">ECS</option>
                                    <option value="">CIVIL</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Class</label><br>
                                <select name="" id=""> 
                                    <option value="" disabled selected>Select</option>
                                    <option value="">FE</option>
                                    <option value="">SE</option>
                                    <option value="">TE</option>
                                    <option value="">BE</option>
                                </select>
                            </div>
    
                        </div>
                        <h3>Other Information:</h3>
                        <div class="form-adjust">
                            <div>
                            <label for="">10th Percentage</label><br>
                            <input type="text">
                            </div>

                            <div>
                            <label for="">12th Percentage</label><br>
                            <input type="text">
                            </div>
                        </div>
                        <h3>Change Password:</h3>
                        <div class="form-adjust">
                            
                            <div>
                                <label for="">Password</label><br>
                                <input type="text">
                            </div>
    
                            <div>
                                <label for="">Confirm Password</label><br>
                                <input type="text">
                            </div>
                        </div>

                        <h3>Results:</h3>
                        <div class="form-adjust">
                            <div>
                                <label for="">Sem 1</label><br>
                                <input type="text" value="helli">
                            </div>
    
                            <div>
                                <label for="">Sem 2</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Sem 3</label><br>
                                <input type="text">
                            </div>
    
                            <div>
                                <label for="">Sem 4</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <div class="form-adjust">
                            <div>
                                <label for="">Sem 5</label><br>
                                <input type="text">
                            </div>
    
                            <div>
                                <label for="">Sem 6</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Sem 7</label><br>
                                <input type="text">
                            </div>
    
                            <div>
                                <label for="">Sem 8</label><br>
                                <input type="text">
                            </div>
                        </div>
                        <div class="form-adjust cgpa">
                            <div>
                                <label for="">CGPA</label><br>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Do you have any backlogs?</label><br>
                                <select name="" id="">
                                    <option value=""disabled selected>Select</option>
                                    <option value="">Yes</option>
                                    <option value="">No</option>
                                </select>
                            </div>
                        </div>
                        <button>Update</button>
                    </form>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>