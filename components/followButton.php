<?php
echo '<button class="followButton btn ',$isFollowing ? "btn-outline-danger" : "btn-success",'" id="followButton-',
$row['id'], '" data-user-id="', $row['id'], '" data-current-user="',
$loggedInUserId, '" data-following="',
$isFollowing ? "1" : "0", '">',
$isFollowing ? "フォロー解除" : "フォロー",
'</button>';