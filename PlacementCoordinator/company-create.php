<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/company-create.css">
    <title>Create Company</title>
</head>

<body>
<div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Add Company</h2>    
                </div>
                <div class="sections">
                    
                <div class="logo-container">

                </div>

                    <form action="">
                        
                <div class="inputbox">
                <label for="">Company Name:</label>
                <input type="text" placeholder="Company Name">
                </div>
                <div class="inputbox-1">
                <div class="inputbox">
                <label for="">Market Scope: </label>
                <input type="text" placeholder="Market Scope"></div>
                <div class="inputbox">
                <label for="">Location: </label>
                <input type="text" placeholder="Location">
                </div>
                </div>
                <div class="inputbox">
                <label for="">Domian: </label>
                <input type="text" placeholder="Domain">
                </div>
                <div class="inputbox">
                <label for="">HR : </label>
                <input type="text" placeholder="Company representative">
                </div>
                <div class="inputbox-1">
                <div class="inputbox">
                <label for="">HR Email: </label>
                <input type="text" placeholder="HR Email">
                </div>
                <div class="inputbox">
                <label for="">HR contact number: </label>
                <input type="text" placeholder="Contact Number">
                </div>
                </div>
                <div class="inputbox">
                <label for="">Company Website:</label>
                <input type="text" placeholder="www.company.com">
                </div>
                <div class="inputbox">
                <label for="">Description:</label>
                    <textarea  class="textarea-message" name=" " id="" placeholder="Description"></textarea>
                </div>
                

                 <button class="add-button" type="submit">Add</button>
                 
                    </form>      
                    </div>           
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>