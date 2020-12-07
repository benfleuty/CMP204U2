<?php
require_once "config.php";
session_start();
$currentPage = "index.php";

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home | Some Band</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include_once "css-links.php" ?>
    <?php include_once "script-links.php" ?>
</head>

<body>
<?php include_once "navbar.php" ?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>some title</h1>
        </div>
        <div class="col-md-4">
            <h1>comments</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img src='https://placehold.it/1920x1080//ffffff?text=some%20art' alt='album art'
                 class="img-fluid rounded"/>
            <p>Sit aliqua voluptate ipsum qui ad sit non excepteur pariatur cupidatat aute. Laboris tempor sit labore
                consectetur est proident. Est cupidatat esse nulla ad qui elit id nulla esse ea qui. Magna sint
                adipisicing tempor cupidatat occaecat mollit excepteur. </p>
        </div>
        <div class="col-md-4">
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
            </div>
        </div>
    </div>
</main> <?php include_once "footer.php" ?> </body>

</html>