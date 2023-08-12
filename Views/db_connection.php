<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "volunet"; 

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', '1');
