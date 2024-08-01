<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/job-post-edit.css">
    <title>Edit Job Posting</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./job-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Edit Details</h2>
                </div>

                <div class="sections">
                    <form action="" method="post">
                        <h3>Details:</h3>
                        <div class="form-adjust">
                         <div class="inputbox">
                                <label for="">Company:</label>
                                <select name="company">
                                    <option value="" selected>Select</option>
                                    <?php
                                    global $conn;
                                    $fetchCompanyQuery = "SELECT C_id, C_Name FROM company ORDER BY C_Name ASC";
                                    $fetchCompany = $conn->prepare($fetchCompanyQuery);
                                    $fetchCompany->execute();
                                    $result = $fetchCompany->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["C_id"] . '">' . $row["C_Name"] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="inputbox">
                                <label for="">Position:</label>
                                <input type="text" name="position">
                            </div>
                            <div class="inputbox">
                                <label for="">Offered Salary:</label>
                                <input type="numeber" name="offered-salary">
                            </div>
                            <div class="inputbox">
                                <label for="">No. of Posts</label>
                                <input type="number" name="no-of-posts">
                            </div>
                            <div class="inputbox">
                                <label for="">Due Date:</label>
                                <input type="date" name="due-date">
                            </div>
                        </div>
                        <h3>Description:</h3>
                        <textarea name="details" class="textarea-message" placeholder="Enter details" id=""></textarea>

                        <div id="rounds-container">

                        </div>
                        <button type="button" id="add-round" class="add-round-button">Add Round</button>
                        
                        <button type="submit" class="add-button" id="myBtn" name="post-job">Update</button>

                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Your Profile has been updated successfully</p>
                            </div>
                        </div>

                        <script>
                            // Get the modal
                            var modal = document.getElementById("myModal");

                            // Get the button that opens the modal
                            var btn = document.getElementById("myBtn");

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[0];

                            // When the user clicks the button, open the modal 
                            btn.onclick = function() {
                                modal.style.display = "block";
                            }

                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                                modal.style.display = "none";
                            }

                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                }
                            }

                            <?php
                            // If the profile was updated, show the modal
                            if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated']) {
                                echo 'modal.style.display = "block";';
                                // Unset the session variable so the modal doesn't show again on refresh
                                unset($_SESSION['profile_updated']);
                            }
                            ?>
                        </script>
                    </form>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let roundCount = 0; // Initialize the round count

            // Function to add a new round
            function addRound() {
                roundCount++; // Increment round count for new round

                // Create new round section HTML
                const newRoundHTML = `
            <div class="round-section" id="round-${roundCount}">
                <h3>Round ${roundCount}:</h3>
                <div class="form-adjust">
                    <div class="inputbox">
                        <label for="location-${roundCount}">Location:</label>
                        <input required type="text" name="round_location[]" id="location-${roundCount}">
                    </div>
                    <div class="inputbox">
                        <label for="link-${roundCount}">Link:</label>
                        <input type="text" name="round_link[]" id="link-${roundCount}">
                    </div>
                    <div class="inputbox">
                        <label for="time-${roundCount}">Time:</label>
                        <input type="time" name="round_time[]" id="time-${roundCount}">
                    </div>
                    <div class="inputbox">
                        <label for="date-${roundCount}">Date:</label>
                        <input type="date" name="round_date[]" id="date-${roundCount}">
                    </div>
                     <input type="hidden" id="round-no" name="round-no" value="${roundCount}">
                </div>
                <h3>Details:</h3>
                <textarea name="round_description[]" id="description-${roundCount}" class="textarea-message" placeholder="Enter round details"></textarea>
                <button type="button" class="add-round-button delete-round-button" data-round-id="round-${roundCount}" style="background-color:red;color:white;margin-bottom:50px;margin-top:-60px">Delete Round</button>
            </div>
        `;

                // Append new round section to the container
                document.getElementById('rounds-container').insertAdjacentHTML('beforeend', newRoundHTML);
            }

            // Add new round on button click
            document.getElementById('add-round').addEventListener('click', addRound);

            // Delete round functionality
            document.getElementById('rounds-container').addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('delete-round-button')) {
                    const roundId = event.target.getAttribute('data-round-id');
                    const roundElement = document.getElementById(roundId);
                    if (roundElement) {
                        roundElement.remove();
                        roundCount--;
                    }
                }
            });
        });
    </script>
</body>

</html>