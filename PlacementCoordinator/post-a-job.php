<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/post-a-job.css">
    <title>Post a Job</title>
</head>

<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Post a job</h2>    
                </div>

                <div class="sections">
                    <form action="" method="get">
                        <h3>Requirements :</h3>
                            <div class="form-adjust">
                             <div class="departmentbox">
                                <label for="">Department</label>
                            <div class="Checkbox"> 
                                <div>
                                    <input type="checkbox">  
                                     <label for="">ECS</label> 
                                </div>
                                
                                <div><input type="checkbox">  
                                <label for="">COMP</label></div>
                                <div><input type="checkbox">  
                                <label for="">MECH</label></div>
                                <div><input type="checkbox">  
                                <label for="">CIVIL</label> </div>
                                
                                
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
                        <h3>Company:</h3>
                        <div class="form-adjust">
                        <div class="inputbox">
                            <label for="">Company:</label>
                            <input type="text">
                            </div>
                        <div class="inputbox">
                            <label for="">Position:</label>
                            <input type="text">
                         </div>
                         <div class="inputbox">
                            <label for="">Offered Salary:</label>
                            <input type="text">
                         </div>
                         <div class="inputbox">
                            <label for="">Due Date:</label>
                            <input type="text">
                         </div>
                        </div>
                         <h3>More Details:</h3>
                         <textarea name="" class="textarea-message" placeholder="Enter details" id=""></textarea>
                         <h3>Round 1:</h3>
                         <div class="form-adjust">
                            <div class="inputbox">
                            <label for="">Location:</label>
                            <input type="text">
                            </div>
                            <div class="inputbox">
                                <label for="">Link:</label>
                                <input type="text">
                            </div>
                            <div class="inputbox">
                                <label for="">Time:</label>
                                <input type="time">
                            </div>
                            <div class="inputbox">
                                <label for="">Date:</label>
                                <input type="date">
                            </div>
                            </div>
                            <h3>Details:</h3>
                            <textarea name="" class="textarea-message" placeholder="Enter round detials" id=""></textarea>
                            <a href=""><button class="add-round-button">Add Rounds</button></a>
                            <a href=""><button class="add-button">Post</button></a>
                    </form>                 
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>