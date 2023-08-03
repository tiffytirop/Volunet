<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Perform a simple validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check if the username is already taken
        $check_username_query = "SELECT * FROM user_credentials WHERE username='$username'";
        $check_username_result = $conn->query($check_username_query);

        if ($check_username_result->num_rows > 0) {
            echo "Username already taken. Please choose a different one.";
        } else {
            // Hash the password for security (use appropriate hashing method)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user credentials into the database
            $insert_query = "INSERT INTO user_credentials (username, password) VALUES ('$username', '$hashedPassword')";

            if ($conn->query($insert_query) === TRUE) {
                echo "Registration successful! You can now login.";
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>