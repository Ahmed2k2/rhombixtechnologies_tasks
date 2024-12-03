<?php
$host = "localhost"; // Set your MySQL host such as local host
$user = "root"; // Set your MySQL user eg; root  
$password = ""; // Set your MySQL root password
$dbname = "";  // Set your MySQL db name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
