$(document).ready(function() {
    $(document).on('click', '.followButton', function() {
        let $button = $(this);
        let isFollowing = $button.data('following');
        let action = isFollowing ? 'unfollow' : 'follow';
        let targetUserId = $button.data('user-id');
        let currentUserId = $button.data('current-user');

        $.post('../relationships/relationshipActions.php', {
            action: action,
            targetUserId: targetUserId,
            currentUserId: currentUserId
        }, function (response) {
            if (response.success) {
                if (isFollowing) {
                    $button.text('フォロー').data('following', 0);
                    $button.addClass('btn-success');
                    $button.removeClass('btn-outline-danger');
                } else {
                    $button.text('フォロー解除').data('following', 1);
                    $button.addClass('btn-outline-danger');
                    $button.removeClass('btn-success');
                }
            } else {
                alert('An error occurred: ' + response.message);
            }
        }, 'json');
    });
});