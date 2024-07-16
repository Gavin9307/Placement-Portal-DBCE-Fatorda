<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="style-forgotpassword.css">
    <title>Forgot Password</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="./Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <a href="./student-support.html"><li>Contact Us</li></a> 
                   <a href="./sign-in.html"><li>Sign in</li></a> 
                   <a href="./sign-up.html"><li>Sign up</li></a> 
                </ul>
            </div>
        </header>
<main>
    <div class="main-container-1">
        <img src="./Assets/college-university-students.png" alt="">
        
      <div class="right-column">
        <form action="">
            <h1>Oops!</h1>
            <h1>Forgot Password ?</h1>
            <div class="inputbox"> 
                <label for="acctype">Account Type</label><br>
                <input type="text" placeholder="Student"  required>
                </div>
            <div class="inputbox">
                <label for="email">Email</label><br>
                <input type="text" placeholder="example@dbcegoa.ac.in" required>
            </div>
            <br>
            <button type="submit" class="subbtn" onclick=" ">Reset</button>
            </form>
        </div>
    </div>
      
    </main>
    <?php include 'footer.php' ?>
    </div>
</body>
    <script defer src="./FontAwesome/JS/all.js"></script>
</html>
