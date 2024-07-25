<?php
include '../connect.php';
include '../components/head.php';
require '../functions/isFollowing.php';
require '../functions/getUser.php';
require '../functions/getArticlesByAuthorId.php';
require '../functions/getLikedArticles.php';
require '../functions/getFollowing.php';
require '../functions/getFollowers.php';

$conn = connect();
// ユーザー情報
$id = $_GET['id'];
$loggedInUserId = $_SESSION['id'];
$user = getUser($id, $conn);

// ユーザーの記事
$articles = getArticlesByAuthorId($id, $conn);

// いいねを押した記事
$liked_articles = getLikedArticles($id, $conn);

// フォロー中のユーザー
$following = getFollowing($id, $conn);

// フォロワー
$followers = getFollowers($id, $conn);

$isFollowing = isFollowing($loggedInUserId, $user, $conn);
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('プロフィール', '../assets/style.css', '../assets/like.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <h1 class="text-center">プロフィール</h1>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="container">
                <h5 class="card-title"><?php echo $user['name'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['userID'] ?></h6>
                <p class="card-text">User ID: <?php echo $user['id'] ?></p>
                </div>
                    <?php if ($loggedInUserId == $id) { ?>
                        <div class="d-grid gap-2 col-6 justify-content-end my-auto">
                            <form action="update.php" method="get" class="me-2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-primary">編集</button>
                            </form>
                            <form action="delete.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-danger">削除</button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="card pb-2">
            <div class="card-header">

                <ul class="nav nav-tabs card-header-tabs justify-content-center" id="profileTabs">
                    <li class="nav-item"><a href="#myArticles" class="nav-link active" data-toggle="tab">マイ記事</a>
                    </li>
                    <li class="nav-item"><a href="#likedArticles" class="nav-link" data-toggle="tab">いいねした記事</a>
                    </li>
                    <li class="nav-item"><a href="#following" class="nav-link" data-toggle="tab">フォロー中</a></li>
                    <li class="nav-item"><a href="#followers" class="nav-link" data-toggle="tab">フォロワー</a></li>
                </ul>
            </div>

            <div class="tab-content mt-3">
                <div class="tab-pane container active" id="myArticles">
                    <?php if (empty($articles)) { ?>
                        <div class="container text-center">
                            <p>まだ記事を作成していません。</p>
                            <?php if($loggedInUserId == $id) { ?>
                            <form action="../articles/create.php">
                                <button class="btn btn-success">新規作成</button>
                            </form>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php foreach ($articles

                                   as $article): ?>
                        <div class="card mb-3 article" <?php echo 'data-article-id="' . $article['id'] . '"' ?>>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                <a href="../articles/read.php?id=<?php echo $article['id'] ?>"
                                   class="link-dark stretched-link"><h5
                                            class="card-title"><?php echo $article['subject'] ?></h5></a>
                                    <div class="likes">
                                        <span>いいね：</span>
                                <?php echo '<span class="my-auto" id="like-count-' . $article['id'] . '" >0</span>'; ?>
                                    </div>
                                </div>
                                <p class="card-text"><?php echo nl2br($article['body']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane container fade" id="likedArticles">
                    <?php if (empty($liked_articles)) { ?>
                        <div class="container text-center">
                            <p>まだ記事をいいねしていません。</p>
                            <?php if($loggedInUserId == $id) { ?>
                            <a href="../articles/search.php" class="link-dark">記事を見る</a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php foreach ($liked_articles

                                   as $article): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <a href="../articles/read.php?id=<?php echo $article['id'] ?>"
                                   class="link-dark stretched-link"><h5
                                            class="card-title"><?php echo $article['subject'] ?></h5></a>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $article['body'] ?></h6>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane container fade text-center" id="following">
                    <?php if (empty($following)) { ?>
                        <div class="container">
                            <p>まだ誰にもフォローしていません。</p>
                            <?php if($loggedInUserId == $id) { ?>
                            <a href="../users/search.php" class="link-dark">他のユーザーを見る</a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php foreach ($following

                                   as $followed_user): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <a href="../users/profile.php?id=<?php echo $followed_user['id'] ?>"
                                   class="link-dark stretched-link"><h5
                                            class="card-title"><?php echo $followed_user['name'] ?></h5></a>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $followed_user['userID'] ?></h6>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane container fade text-center" id="followers">
                    <?php if (empty($followers)) { ?>
                        <div class="container">
                            <p>フォロワーがまだいません。</p>
                        </div>
                    <?php } ?>
                    <?php foreach ($followers

                                   as $follower): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <a href="../users/profile.php?id=<?php echo $follower['id'] ?>"
                                   class="link-dark stretched-link"><h5
                                            class="card-title"><?php echo $follower['name'] ?></h5></a>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $follower['userID'] ?></h6>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#profileTabs a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
</body>
</html>