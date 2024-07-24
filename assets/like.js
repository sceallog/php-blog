$(document).ready(function () {
    $(document).on('click', '.likeButton', function () {
        let $button = $(this);
        let isLiking = $button.data('liking');
        let articleId = $button.data('article-id');
        let userId = $button.data('current-user');

        $.post('../articles/toggleLikes.php', {
            articleId: articleId,
            userId: userId
        }, function () {
            if (isLiking) {
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

function updateLikeCount(articleId) {
    $.get('../articles/likeCount.php', {
        articleId: articleId
    }, function (response) {
        $('#like-count-' + articleId).text(response);
    });
}