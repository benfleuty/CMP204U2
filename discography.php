<?php
require_once "config.php";
session_start();
$currentPage = "discography.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Discography | Some Band</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include_once "css-links.php" ?>
    <?php include_once "script-links.php" ?>
</head>

<body>

    <?php include_once "navbar.php" ?>

    <style>
        main {
            width: 100%;
            margin-top: 20px;
        }

        #content {
            padding: 5px;
            width: 90%;
            margin: auto;
        }
    </style>


    <main>
        <div id="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="album-art">
                        <img src='https://placehold.it/800x800?text=album%20art' alt='album art' class="img-fluid rounded" />
                    </div>
                </div>
                <div class="col-md-8">
                    <h1>Album title</h1>
                    <h2>Release Date</h2>
                    <p>Labore sunt pariatur exercitation nulla fugiat cillum labore occaecat ullamco laborum amet ipsum. Dolore anim reprehenderit sunt laborum est irure labore ad proident ullamco labore enim deserunt nisi. Anim ipsum veniam nisi laborum Lorem commodo. Irure nulla anim adipisicing occaecat.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h1>Album title</h1>
                    <h2>Release Date</h2>
                    <p>Labore sunt pariatur exercitation nulla fugiat cillum labore occaecat ullamco laborum amet ipsum. Dolore anim reprehenderit sunt laborum est irure labore ad proident ullamco labore enim deserunt nisi. Anim ipsum veniam nisi laborum Lorem commodo. Irure nulla anim adipisicing occaecat.</p>
                </div>
                <div class="col-md-4">
                    <div class="album-art">
                        <img src='https://placehold.it/800x800?text=album%20art' alt='album art' class="img-fluid rounded" />
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "footer.php" ?>
</body>

</html>