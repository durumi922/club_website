<?php
include 'db_connect.php';

// 데이터베이스 연결 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 게시글 ID 가져오기
$post_id = intval($_GET['post_id']);

// 게시글 정보 조회
$stmt = $conn->prepare("SELECT board_name, board_content FROM board WHERE board_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $content);
$stmt->fetch();
$stmt->close();

// 댓글 조회
$comments = [];
$stmt = $conn->prepare("SELECT comment_content FROM comment_1 WHERE board_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($comment_content);
while ($stmt->fetch()) {
    $comments[] = $comment_content;
}
$stmt->close();

$conn->close();

// HTML 출력
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세보기</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.html">
                <img src="school_logo.png" alt="학교 로고">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="club_apply.html">동아리 정보 안내</a></li>
                <li><a href="club_promotion.html">동아리 홍보 게시글</a></li>
                <li><a href="free_board.html">자유 게시판</a></li>
            </ul>
        </nav>
    </header>
    <div class="sidebar">
        <ul>
            <li><a href="#">동아리 정보 안내</a>
                <ul>
                    <li><a href="club_apply.html">동아리 신청방법</a></li>
                    <li><a href="club_tips.html">동아리 팁</a></li>
                </ul>
            </li>
            <li><a href="club_promotion.html">동아리 홍보 게시글</a></li>
            <li><a href="free_board.html">자유 게시판</a></li>
        </ul>
    </div>
    <main>
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <div id="post-content">
            <?php echo nl2br(htmlspecialchars($content)); ?>
        </div>
        <h2>댓글</h2>
        <div id="comment-section">
            <?php foreach ($comments as $comment): ?>
                <p><?php echo htmlspecialchars($comment); ?></p>
            <?php endforeach; ?>
        </div>
        <textarea id="comment-input" placeholder="댓글을 작성하세요"></textarea>
        <button id="submit-comment">댓글 작성</button>
    </main>
    <script src="js/app.js"></script>
</body>
</html>
