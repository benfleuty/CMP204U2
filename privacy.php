<?php
require_once "config.php";
session_start();
$currentPage = "privacy.php";

?>

<!doctype html>
<html lang="en">

<head>
    <title>Privacy | Some Band</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include_once "css-links.php" ?>
    <?php include_once "script-links.php" ?>
</head>

<body>
<?php include_once "navbar.php" ?>

<main role="main" class="container">
    <h1>Privacy Policy</h1>

    <h2>Data Collected:</h2>
    <dl>
        <dt>Your username</dt>
        <dd><strong>Why:</strong> We store this to identify you. This allows you to log in and comment.</dd>
        <dt>Your password</dt>
        <dd><strong>Why:</strong> We store this to identify you. This allows you to log in and comment.</dd>
    </dl>

    <h2>How long do we keep your data?</h2>
    <p>We keep your data until you choose to delete it.</p>

    <h2>How can you delete your data?</h2>
    <dl>
    <dt>Comments</dt>
    <dd><strong>To delete:</strong> You can delete your comments by locating them and using the delete function.
        <strong>You</strong> are responsible for what you comment - we do not recommending commenting information that
        can identify you!
    </dd>
    <dt>Account</dt>
    <dd><strong>To delete:</strong> You can delete your account by clicking <span id="delete-account">here</span>.</dd>
    </dl>

    <h2>Cookies:</h2>
    <p>We only use essential cookies to improve your experience on this website. Without these cookies, you cannot use our website!</p>


</main> <?php include_once "footer.php" ?> </body>

</html>