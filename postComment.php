<?php session_start();
include "config.php";
if (!loggedIn()) return;

$comment = $_POST["comment"];




// delete
$result = json_encode(array("success", "namee", "idee", "datee"));
echo $result;
//$result = array("success", "namee", "idee", "datee");
///////////////////
// echo "successText,username,commentId";
//echo $result;
//    echo "success,{$_SESSION["username"]},{$result["id"]},{$result["date"]}";
