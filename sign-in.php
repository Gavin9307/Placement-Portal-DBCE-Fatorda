<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    
    <link rel="stylesheet" href="style-sign-in.css">
    <title>Sign-in</title>
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
                    <a href="./index.php"><li>Home</li></a>
                   <a href="./sign-up.php"><li>Sign up</li></a>
                   <a href="./student-support.php"><li>Contact Us</li></a>
                </ul>
            </div>
        </header>
        <main>
            <div class="main-container-1">
                <img src="./Assets/college-university-students.png" alt="">

                <div class="right-column">
                    <form action="">
                        <h2>Welcome back! <br> Sign in</h2>
                        <div class="inputbox">
                            <label for="usertype">Sign in as</label><br>
                            <select name="usertype" id="usertype">
                                <option value="student">Select Type</option>
                                <option value="student">Student</option>
                                <option value="tpo">TPO</option>
                                <option value="pc">Placement Coordinator</option>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="email">Email</label><br>
                            <input type="text" placeholder="example@dbcegoa.ac.in" required>
                        </div>

                        <div class="inputbox">
                            <label for="password">Password</label><br>
                            <input type="password" placeholder="Password" id="password" required>
                        </div><br>

                        <div class="checkbox-container">
                            <input type="checkbox" name="remember-me" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div><br>
                        <button type="submit" class="subbtn" onclick=" ">Sign in</button>
                        <div class="forgotpassword">
                            <a href="#">Forgot Password</a>
                        </div>
                    </form>
                </div>
            </div>

        </main>
        <?php include 'footer.php' ?>
    </div>
</body>
<script defer src="./FontAwesome/JS/all.js"></script>

</html>