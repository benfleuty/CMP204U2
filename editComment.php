<?php
/**
 *
 * @var $db
 *
 */

session_start();
require_once "config.php";

$stmt = $db->stmt_init();
$sql = "UPDATE CMP204comments SET content = ?, date = CURRENT_TIMESTAMP WHERE userId = {$_SESSION["id"]} AND id = ?";
if (!$stmt = $db->prepare($sql)) errorOutWithMessage("EditComment could not prepare SQL statement");
$stmt->bind_param("si",$_POST["content"],$_POST["id"]);


$output = array();

if($stmt->execute()) array_push($output,"success");
else errorOut();

$stmt = $db->stmt_init();
$sql = "SELECT CMP204comments.date AS date FROM CMP204comments WHERE CMP204comments.id = {$_POST["id"]}";

if (!$stmt = $db->prepare($sql)) errorOutWithMessage("EditComment GetDateTime could not prepare SQL statement");

if($stmt->execute()) {
    $result = $stmt->get_result()->fetch_assoc();
    array_push($output,$_SESSION["username"]);
    array_push($output,$result["date"]);
    echo json_encode($output);
}else echo json_encode("fail");


