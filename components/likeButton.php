<?php
echo '
    <button class="likeButton btn ', $isLiking ? "btn-success" : "btn-outline-success",
    '" data-article-id="', $article['id'],
    '" data-current-user="', $loggedInUserId,
    '" data-liking="', $isLiking ? "1" : "0", '">',
    $isLiking ? "いいね解除" : "いいね",
    '</button>';
