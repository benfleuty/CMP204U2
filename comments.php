<?php
/** Parent variable definitions
 *
 * @var $commentTarget
 *
 */


$sql = `SELECT CMP204comments.content, CMP204comments.commentedOn, CMP204users.username FROM CMP204comments, CMP204users
        WHERE CMP204comments.userId = CMP204users.id AND CMP204comments.target = ${commentTarget}}`;

?>
<div class="comments">
    <div class="comment-outer">
        <div class="comment-body">
            <p>Veniam tempor quis sit magna commodo. Aliquip Lorem ut labore voluptate nostrud officia
                excepteur!</p>
        </div>
        <hr class="comment-hr">
        <div class="comment-footer">
            <div class="comment-user-details">
                <p>username date time</p>
            </div>
            <div class="comment-user-controls">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="comment-outer">
        <div class="comment-body">
            <label for="commentText" content="Your comment:">
                <textarea id="commentText" aria-multiline="true" maxlength="140" placeholder="Comment..." required form="commentForm"></textarea>
            </label>
        </div>
        <hr class="comment-hr">
        <div class="comment-footer">
            <button id="postCommentButton" class="bg-primary text-white" type="submit" form="commentForm">Post</button>
            <form id="commentForm" ></form>
        </div>
    </div>
</div>
