<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "club_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$images = $_FILES['images'];

// Save post data
$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
if ($conn->query($sql) === TRUE) {
    echo "New post created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
