<?php
include 'db_connect.php';

$title = $_POST['title'];
$content = $_POST['content'];

// 자유 게시글 저장
$sql = "INSERT INTO free_posts (title, content) VALUES ('$title', '$content')";
$conn->query($sql);
$free_post_id = $conn->insert_id;

// 이미지 업로드 처리
foreach ($_FILES['images']['name'] as $key => $image) {
    $imagePath = 'uploads/free_posts/' . basename($image);
    move_uploaded_file($_FILES['images']['tmp_name'][$key], $imagePath);
    
    // 이미지 경로 저장
    $sql = "INSERT INTO free_post_images (free_post_id, image_path) VALUES ($free_post_id, '$imagePath')";
    $conn->query($sql);
}

$conn->close();

header('Location: ../free_board.html');
?>
