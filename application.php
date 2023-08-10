<?php
$servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $database = "volunet"; 

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch application data from the database
            $sql = "SELECT job_name, status FROM applications"; // Modify the query according to your database schema
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="application-card">';
                    echo '<div class="application-job">';
                    echo '<h3>' . $row['job_name'] . '</h3>';
                    echo '<p>Your application status: ' . $row['status'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No applications found.</p>';
            }

            // Close the database connection
            $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
</head>
<body>
    <div class="topnav">
        <a href="homepage.html">Home</a>
        <a href="jobs.html">Find a Job</a>
        <a class="active" href="application.php">My Applications</a>
        <a href="about.html">About</a>
        <a href="signup.html">Sign Up</a>
        <a href="login.html">Login</a>
    </div>

    <div class="content">
        <h1>My Job Applications</h1>
        <div class="application-container" id="application-container">

            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch application data from the PHP file
            $.get("get_applications.php", function(data) {
                var container = $("#application-container");

                // Loop through the application data and populate cards
                for (var i = 0; i < data.length; i++) {
                    var application = data[i];
                    var cardHtml = `
                        <div class="application-card">
                            <div class="application-job">
                                <h3>${application.job_name}</h3>
                                <p>Your application status: ${application.status}</p>
                            </div>
                        </div>
                    `;
                    container.append(cardHtml);
                }
            });
        });
    </script>
</body>
</html>

