<?php
session_start();
(isset($_SESSION["lastPage"]) && !empty($_SESSION["lastPage"])) ? $lastPage = $_SESSION["lastPage"] : $lastPage = "index.php";
session_destroy();
session_start();
$_SESSION["msg"] = `<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success!</strong> You have been logged out.</div>`;
