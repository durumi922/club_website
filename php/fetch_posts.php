<?php
include 'db_connect.php';

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = array();
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

header('Content-Type: application/json');
echo json_encode($posts);

$conn->close();
?>
