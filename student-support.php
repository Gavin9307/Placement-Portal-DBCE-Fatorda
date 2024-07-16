<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>

    <link rel="stylesheet" href="style-student-support.css">
    <title>Student Support</title>
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
                    <a href="./Students/"><li>Home</li></a>
                    <a href="./index.html"><li>Dashboard</li></a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <img src="./Assets/college-university-students.png" alt="">
                <div class="main-right-container">
                    <h2>Contact Us</h2>
                    <form action="">
                        
                        <label for="Name">Name</label><br>
                        <input class="user-input" placeholder="Student" type="text" id="name" required><br><br>
                       
                        <label for="email">Email</label><br>
                        <input class="user-input" placeholder="example@dbcegoa.ac.in" type="email" id="email" required><br><br>
                        
                        <label for="message">Message</label><br>
                        <textarea class="user-input-message" placeholder="Enter your message" cols="30" rows="05" required></textarea><br><br>

                        <button>Submit</button>
                    </form>
                </div>
            </div>
        </main>

        <?php include 'footer.php' ?>

    </div>
</body>
