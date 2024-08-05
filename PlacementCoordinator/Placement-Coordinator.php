<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/Placement-Coordinator.css">
    <title>Placement Coordinators</title>
</head>
<?php 

    

?>
<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><a href="./dashboard.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a></a>
                Placement Coordinators</h2>    
                <div class="button-container">
                <a href="./Placement-Coordinator-Add.php"><button class="viewmore-button">Add Coordinator+</button></a>
                </div>
                </div>

            
                    
                 <div class="sections">
                    <table>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Details</th>
                    </tr>
                    <tr>
                        <td>Nimish</td>
                        <td>MECH</td>
                        <td><a href="./Placement-Coordinator-Details.php">View more</a></td>
                    </tr>
                    <tr>
                        <td>Syndroy</td>
                        <td>COMP</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Bliss</td>
                        <td>COMP</td>
                        <td><a href="">View more</a></td>
                    </tr>
                    <tr>
                        <td>Warren</td>
                        <td>COMP</td>
                        <td><a href="">View more</a></td>
                    </tr>
                </table>
                
                </div>         
             
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>