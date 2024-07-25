<?php
echo '<button class="followButton btn ',$isFollowing ? "btn-outline-danger" : "btn-success",'" id="followButton-',
$user['id'], '" data-user-id="', $user['id'], '" data-current-user="',
$loggedInUserId, '" data-following="',
$isFollowing ? "1" : "0", '">',
$isFollowing ? "フォロー解除" : "フォロー",
'</button>';