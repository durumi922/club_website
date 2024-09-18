// app.js
document.addEventListener('DOMContentLoaded', function() {
    // 자유 게시판의 글쓰기 버튼 클릭 시
    const writePostBtn = document.getElementById('write-post-btn');
    if (writePostBtn) {
        writePostBtn.addEventListener('click', function() {
            window.location.href = 'write_free_post.html'; // 글쓰기 페이지로 이동
        });
    }

    // 동아리 홍보 게시글의 글쓰기 버튼 클릭 시
    const postBtn = document.getElementById('post-btn');
    if (postBtn) {
        postBtn.addEventListener('click', function() {
            window.location.href = 'write_post.html'; // 글쓰기 페이지로 이동
        });
    }

    // 게시글 상세보기의 댓글 작성 버튼 클릭 시
    const submitCommentBtn = document.getElementById('submit-comment');
    if (submitCommentBtn) {
        submitCommentBtn.addEventListener('click', function() {
            // 댓글 작성 로직 추가
            console.log('댓글 작성 버튼 클릭됨');
        });
    }
});
