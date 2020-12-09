<?php
session_start();
require_once "config.php";
/** Parent variable definitions
 *
 * @var $commentTarget
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
    $output .= '<div class="comment-outer comment-not-logged-in-message">
        <div class="comment-body">
            <p>You must be logged in to comment</p>
        </div>
    </div>';
}

$stmt = $db->stmt_init();
$sql = "SELECT CMP204comments.content, CMP204comments.date, CMP204users.username FROM CMP204comments, CMP204users
        WHERE CMP204comments.userId = CMP204users.id AND CMP204comments.target = ?";
if (!$stmt = $db->prepare($sql)) errorOutWithMessage("GetCustomers could not prepare SQL statement");
$stmt->bind_param("s",$commentTarget);
$stmt->execute();
$result = $stmt->get_result(); // get the query result

$output .= '<div id="comments-output">';

if (mysqli_num_rows($result) <= 0) {
    $output .= '<div class="comment-outer no-comments-message"><div class="comment-body"><p>There are no comments!</p></div></div>';
}
foreach ($result as $row) {
    $output .= '<div class="comment-outer"><div class="comment-body">'.
                "<p>{$row["content"]}</p>".
        '</div>
        <hr class="comment-hr">
        <div class="comment-footer">
        <div class="comment-user-details">'.
        "<p>{$row["username"]} {$row["date"]}</p></div>";

    if ($_SESSION["username"] == $row["username"])
        $output .= '<div class="comment-user-controls"><i class="fa fa-edit"></i><i class="fa fa-trash" aria-hidden="true"></i></div>';
}
$output .= '</div>';

echo $output;