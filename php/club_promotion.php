<?php
include 'db_connect.php';

// 데이터베이스 연결 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 사용자 입력 데이터 확인 및 필터링
$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);

// SQL 쿼리 준비
$stmt = $conn->prepare("INSERT INTO board (boardkind_id, board_name, board_content) VALUES (?, ?, ?)");
$boardkind_id = 1; // 기본값으로 설정, 필요한 경우 다른 값으로 변경 가능
$stmt->bind_param("iss", $boardkind_id, $title, $content);

if ($stmt->execute()) {
    $board_id = $stmt->insert_id;

    // 이미지 업로드 처리
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $image) {
            $imagePath = 'uploads/posts/' . basename($image);
            
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $imagePath)) {
                // 이미지 경로 저장
                $stmt = $conn->prepare("INSERT INTO image (board_id, boardkind_id, image_name) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $board_id, $boardkind_id, $imagePath);
                $stmt->execute();
            } else {
                echo "Failed to upload image: " . htmlspecialchars($image);
            }
        }
    }

    $stmt->close();
    $conn->close();

    // 성공적으로 저장 후 리디렉션
    header('Location: ../club_promotion.html');
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
