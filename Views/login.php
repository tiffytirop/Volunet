<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform a simple validation (you should perform stronger validation in a real project)
    if (!empty($username) && !empty($password)) {
        // Hash the password for security (use appropriate hashing method)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user credentials into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please provide both username and password.";
    }
}

// Close the database connection
$conn->close();
?>
