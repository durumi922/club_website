document.addEventListener('DOMContentLoaded', function() {
    // 자유게시판 글쓰기 버튼 클릭 시
    document.getElementById('write-post-btn').addEventListener('click', function() {
        window.location.href = 'write_free_post.html';
    });

    // 게시글 업로드 처리 로직
    // 게시글 상세보기 로딩 및 댓글 작성 처리 등도 추가 가능
});
