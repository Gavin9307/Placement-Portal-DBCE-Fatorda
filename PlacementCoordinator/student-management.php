<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/student-management.css">
    <title>Student Management</title>
</head>

<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                Student Management</h2>    
                </div>

            
                    <form action="" method="get">
                        <h3>Student Search</h3>
                        <div class="form-adjust">
                            <form action="">
                            <div class="inputbox">
                                <label for="">Student Name:</label>
                                <input type="text" placeholder="Enter Student Name">
                            </div>

                             <div class="departmentbox">
                                <label for="">Department:</label>
                            <div class="Checkbox"> 
                                <div><input type="checkbox">  
                                <label for="">ECS</label></div>
                                <div><input type="checkbox">  
                                <label for="">COMP</label></div>
                                <div><input type="checkbox">  
                                <label for="">MECH</label></div>
                                <div><input type="checkbox">  
                                <label for="">CIVIL</label></div>
                                </div>
                             </div>
                            
                            <div class="inputbox">
                                <label for="">Gender:</label>
                                <select name="" id="">
                                    <option value=""disabled selected>Select</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                            <div class="search-button-container">
                            <a href=""> <button class="search-button"> Search</button></a>
                            </div>
                            </form>
                        </div>
                 <div class="sections">
                    <table>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Class</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="./notification-post.php"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
                       
                <form action="" method="get">
                        <h3>Deleted Students</h3>
                        <div class="form-adjust">
                            <form action="">
                            <div class="inputbox">
                                <label for="">Student Name:</label>
                                <input type="text" placeholder="Enter Student Name">
                            </div>

                             <div class="departmentbox">
                                <label for="">Department:</label>
                            <div class="Checkbox"> 
                                <div><input type="checkbox">  
                                <label for="">ECS</label></div>
                                <div><input type="checkbox">  
                                <label for="">COMP</label></div>
                                <div><input type="checkbox">  
                                <label for="">MECH</label></div>
                                <div><input type="checkbox">  
                                <label for="">CIVIL</label></div>
                                </div>
                             </div>
                            
                            <div class="inputbox">
                                <label for="">Gender:</label>
                                <select name="" id="">
                                    <option value=""disabled selected>Select</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                            <div class="search-button-container">
                            <a href=""> <button class="search-button"> Search</button></a>
                            </div>
                            </form>
                        </div>
                 <div class="sections">
                    <table>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Class</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>ETC</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>MECH</td>
                        <td>BE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Gavin</td>
                        <td>Computer</td>
                        <td>TE</td>
                        <td><a href="">View more</a></td>
                    </tr>
                </table>
                <div class="button-container">
                <a href="./notification-post.php"><button class="viewmore-button">View More</button></a>
                </div>
                </div>
                                  
                
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>