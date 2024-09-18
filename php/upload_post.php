<?php
include 'db_connect.php';

$title = $_POST['title'];
$content = $_POST['content'];

// 게시글 저장
$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
$conn->query($sql);
$post_id = $conn->insert_id;

// 이미지 업로드 처리
foreach ($_FILES['images']['name'] as $key => $image) {
    $imagePath = 'uploads/posts/' . basename($image);
    move_uploaded_file($_FILES['images']['tmp_name'][$key], $imagePath);
    
    // 이미지 경로 저장
    $sql = "INSERT INTO post_images (post_id, image_path) VALUES ($post_id, '$imagePath')";
    $conn->query($sql);
}

$conn->close();

header('Location: ../club_promotion.html');
?>
