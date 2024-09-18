<?php
// php/db_connect.php

$servername = "localhost";
$username = "root"; // MySQL 사용자 이름
$password = "";     // MySQL 비밀번호
$dbname = "club_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
