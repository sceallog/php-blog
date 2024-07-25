<?php
require '../functions/followUser.php';
require '../functions/unfollowUser.php';
require '../functions/console_log.php';
include '../connect.php';

$conn = connect();
$action = $_POST['action'];
$loggedInUserId = $_POST['currentUserId'];
$targetUserId = $_POST['targetUserId'];
$response = ['success' => false, 'message' => ""];

if ($action == 'unfollow') {
    $response = unfollowUser($loggedInUserId, $targetUserId, $conn);
} elseif ($action == 'follow') {
    $response = followUser($loggedInUserId, $targetUserId, $conn);
}

echo json_encode($response);