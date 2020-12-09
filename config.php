<?php
header("Cache-Control: stale-while-revalidate, max-age=30 ");
define('DEBUG', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set("display_errors", DEBUG);
ini_set("log_errors", !DEBUG);

function loggedIn()
{
  if (isset($_SESSION["username"]) and !empty($_SESSION["username"])) return true;
  else return false;
}

function errorOut()
{
    echo "fail";
    die();
}

function errorOutWithMessage($message,$encode = false)
{
    if($encode) echo json_encode($message);
    else echo $message;
    die();
}

$MAX_COMMENTS = 50;

require_once "db.php";
