<?php
/**
 * @var $currentPage // stores the current page being viewed
 */
require_once "config.php";
session_start();
?>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php">Some band</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navb" class="navbar-collapse collapse hide">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="discography.php">Discography</a>
            </li>
        </ul>
        <script type="text/javascript">
            $("li > a[href='<?= $currentPage ?>']").addClass("active");
        </script>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-link dropdown">
                <a class="dropdown-toggle" id="accountDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, <?= (loggedIn()) ? $_SESSION["username"] : "Guest"; ?> <i class="fa fa-user-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="accountDrop">
                    <div class="dropdown-header">Account</div>
                    <?php if (!loggedIn()) {
                    ?>
                        <a type="button" class="dropdown-item" name="login" id="login" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in"></i> Sign In </a>
                        <a type="button" class="dropdown-item" name="register" id="register" data-toggle="modal" data-target="#registerModal"><i class="fa fa-user-plus"></i> Sign Up </a>
                    <?php
                    } else {
                    ?>
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-id-card"></i> Profile </a>
                        <a class="dropdown-item" href="#/" id="logoutButton"><i class="fas fa-sign-out-alt"></i> Log out </a>
                        <script src="js/logout.js"></script>
                    <?php
                    }
                    ?>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Sign Up <i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a>
            </li> -->
        </ul>
    </div>
</nav>
<?php if (!loggedIn()) {
    require_once "login.html";
    require_once "register.html";
}
?>