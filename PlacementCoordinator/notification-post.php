<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/notification-post.css">
    <title>Notifications</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Notifications</h2>
                    <a href="./notification-post.php"><button class="add-button">Post Notifications</button></a>    
                </div>

                <div class="sections">
                    <form action="" method="get">
                        <h3>To :</h3>
                            <div class="form-adjust">
                            <div class="departmentbox">
                             <label for="">Department</label>
                            <div class="Checkbox"> 
                                <input type="checkbox">  
                                <label for="">ECS</label> 
                                <input type="checkbox">  
                                <label for="">COMP</label>
                                <input type="checkbox">  
                                <label for="">MECH</label>
                                <input type="checkbox">  
                                <label for="">CIVIL</label> 
                                </div>
                             </div>
                            <div class="inputbox">
                                <label for="">Min CGPA</label>
                                <input type="number" step="0.1" placeholder="0.0" min="0" max="10">
                            </div>
                            <div class="inputbox">
                                <label for="">Max CGPA</label>
                                <input type="number" step="10.0" placeholder="0.0"  min="0" max="10">
                            </div>
                            <div class="inputbox">
                                <label for="">Min CGPA</label>
                                <input type="text" placeholder="0.0">
                                </div>
                            <div class="inputbox">
                                <label for="">Placed</label>
                                <select name="" id="">
                                    <option value=""disabled selected>Select</option>
                                    <option value="">Yes</option>
                                    <option value="">No</option>
                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">10th Percentage</label>
                                <input type="number">
                            </div>
                            <div class="inputbox">
                                <label for="">12th Percentage</label>
                                <input type="number">
                            </div>
                            <div class="inputbox">
                                <label for="">Gender</label>
                                <select name="" id="">
                                    <option value=""disabled selected>Select</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <h3>Subject:</h3>
                    <textarea name="" class="textarea-subject" placeholder="subject" id=""></textarea>
                    <h3>Message</h3>
                    <textarea name=""class="textarea-message" placeholder="Message" id=""></textarea>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>