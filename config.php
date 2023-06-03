<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "(laxman1234@";
$dbName = "journal_project";

// Establish a database connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// Check the connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>