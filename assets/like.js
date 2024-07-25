$(document).ready(function () {
    // 記事にいいねをしたらその記事のいいねの合計数を取ってくる
    function updateLikeCount(articleId) {
        $.get('../articles/likeCount.php', {
            articleId: articleId
        }, function (response) {
            console.log(articleId);
            $('#like-count-' + articleId).text(response);
        });
    }

    // ページが読み込まれたあと、すべての記事のそれぞれのいいねの合計数を取ってくる
    function fetchAllLikeCounts() {
        $('.article').each(function () {
            let articleId = $(this).data('article-id');
            updateLikeCount(articleId);
        });
    }

    // documentのロードが完了したら、上記の関数を呼び出す
    fetchAllLikeCounts();

    $(document).on('click', '.likeButton', function () {
        let $button = $(this);
        let isLiking = $button.data('liking');
        let articleId = $button.data('article-id');
        let userId = $button.data('current-user');

        $.post('../articles/toggleLikes.php', {
            articleId: articleId,
            userId: userId
        }, function () {
            if (isLiking === 1) {
                $button.text('いいね').data('liking', 0);
                $button.addClass('btn-outline-success');
                $button.removeClass('btn-success');
            } else {
                $button.text('いいね解除').data('liking', 1);
                $button.addClass('btn-success');
                $button.removeClass('btn-outline-success');
            }
            updateLikeCount(articleId);
        });
    });
});