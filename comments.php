<?php
session_start();
require_once "config.php";
/** Parent variable definitions
 *
 * @var $db
 *
 */


$output = '<div id="comments">';

if (loggedIn()) {
    $output .= '<div class="comment-outer">
        <div class="comment-body">
            <label for="commentText" content="Your comment:">
                    <textarea id="commentText" aria-multiline="true" maxlength="140" placeholder="Comment..." required
                              form="commentForm"></textarea>
            </label>
        </div>
        <hr class="comment-hr">
        <div class="comment-footer">
            <button id="postCommentButton" class="bg-primary text-white" type="submit" form="commentForm">Post
            </button>
            <form id="commentForm"></form>
        </div>
    </div>
    ';
}

if (!loggedIn()){
    $output .= '<div id="commentNotLoggedInMessage" class="comment-outer">
        <div class="comment-body">
            <p>You must be logged in to comment</p>
        </div>
    </div>';
}

$stmt = $db->stmt_init();
$sql = "SELECT CMP204comments.id, CMP204comments.content, CMP204comments.date, CMP204users.username FROM CMP204comments, CMP204users
        WHERE CMP204comments.userId = CMP204users.id AND CMP204comments.target = ? ORDER BY date DESC";
if (!$stmt = $db->prepare($sql)) errorOutWithMessage("GetCustomers could not prepare SQL statement");
$stmt->bind_param("s",$_SESSION["commentTarget"]);
$stmt->execute();
$result = $stmt->get_result(); // get the query result

$output .= '<div id="comments-output">';

if (mysqli_num_rows($result) <= 0) {
    $output .= '<div id="noCommentsMessage" class="comment-outer"><div class="comment-body"><p>There are no comments!</p></div></div>';
}
foreach ($result as $row) {
    $output .= '<div id="commentId-'.$row["id"].'" class="comment-outer"><div class="comment-body">'.
                "<p>{$row["content"]}</p>".
        '</div>
        <hr class="comment-hr">
        <div class="comment-footer">
        <div class="comment-user-details">'.
        "<p>{$row["username"]} {$row["date"]}";

    if ($_SESSION["username"] == $row["username"])
        $output .= '<span class="comment-user-controls"><i id="edit-' . $row["id"] .'"  class="fa fa-edit"></i><i id="delete-'.$row["id"].'" class="fa fa-trash delete-comment" aria-hidden="true"></i></span>';

    $output .= "</p></div></div></div>";
}
$output .= '</div>';

echo $output;

?>
<!-- Confirm delete modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete comment?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" id="deleteComment">Delete</a>
            </div>
        </div>
    </div>
</div>
