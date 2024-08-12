<?php
require "./conn.php";
require "./restrict.php";
include "./utility_functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}

?>

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
                    <a href="./index.php"><li>Home</li></a>
                    <a href="./Students/dashboard.php"><li>Dashboard</li></a>
                </ul>
            </div>
        </header>

        <main>
            <div class="main-container">
                <img src="./Assets/college-university-students.png" alt="">
                <div class="main-right-container">
                    <h2>Contact Us</h2>
                    <form id="contact-form">
                        <label for="name">Name</label><br>
                        <input class="user-input" placeholder="Student" type="text" id="name" required><br><br>

                        <input hidden class="user-input" type="email" id="email" value="<?php echo $_SESSION["user_email"] ?>" >
                        
                        <label for="message">Message</label><br>
                        <textarea class="user-input-message" placeholder="Enter your message" cols="30" rows="5" id="message" required></textarea><br><br>

                        <button type="button" onclick="sendEmail()">Submit</button>
                    </form>
                </div>
            </div>
        </main>

        <?php include 'footer.php' ?>

    </div>

    <script>
        function sendEmail() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            
            const recipient = 'recipient@example.com';
            const subject = encodeURIComponent(`Contact Form Submission - ${email}`);
            const body = encodeURIComponent(`Name: ${name}\nEmail: ${email}\nMessage: ${message}`);
            
            const mailtoLink = `mailto:${recipient}?subject=${subject}&body=${body}`;
            
            window.location.href = mailtoLink;
        }
    </script>
</body>
</html>
