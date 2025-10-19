<?php
$host = "localhost";       // database host 
$user = "root";            // MySQL username 
$pass = "";                // MySQL password 
$dbname = "pawsitive_pet_tech";  // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
