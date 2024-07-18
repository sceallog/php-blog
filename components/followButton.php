<?php
function createFollowButton($loggedInUserId, $row, $conn)
{
    $isFollowing = isFollowing($loggedInUserId, $row, $conn);
    echo '<button class="followButton" id="followButton-',
    $row['id'], '" data-user-id="', $row['id'], '" data-current-user="',
    $loggedInUserId, '" data-following="',
    $isFollowing ? "1" : "0", '">',
    $isFollowing ? "フォロー解除" : "フォロー",
    '</button>';
}