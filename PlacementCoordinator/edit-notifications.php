<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/edit-notifications.css">
    <title>Edit Notifications</title>
</head>

<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Edit Notifications</h2>    
                </div>

                <div class="sections">
                    <form action="" method="get">
                    <h3>Position:</h3>
                    <textarea name="" class="textarea-position" placeholder="Associate Developer" id=""></textarea>
                    <h3>Message:</h3>
                    <textarea name=""class="textarea-message" placeholder="Software Engineer Campus: Role
As Software Engineer, you will implement solutions for a variety of projects in a highly collaborative and 
fast-paced environment. You will work closely with product and marketing managers, user interaction 
designers, and other software engineers to develop new product offerings and improve existing ones. 
Software Engineer Campus: Role
As Software Engineer, you will implement solutions for a variety of projects in a highly collaborative and  
designers, and other software engineers to develop new product offerings and improve existing ones. " id=""></textarea>
                    <a href=" "><button class="update-button">Update</button></a>
                    </form>               
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>