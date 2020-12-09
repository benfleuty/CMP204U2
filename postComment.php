<?php

/**
 *
 * @var $db
 *
 */

session_start();
include "config.php";

if (!loggedIn()) return;

$comment = $_POST["comment"];

$o = "Comment: " . $comment;
$o .= "\nTarget: " . $_SESSION["commentTarget"];


$stmt = $db->stmt_init();
$sql = "INSERT INTO CMP204comments (content,userId,target) VALUES (?," . $_SESSION["id"] . ",?)";

if (!$stmt = $db->prepare($sql)) errorOutWithMessage("PostComment could not prepare SQL statement for insertion", true);
$stmt->bind_param("ss", $comment, $_SESSION["commentTarget"]);
$affectedRows = $stmt->execute();

if ($affectedRows < 1) errorOutWithMessage("No rows affected", true);

else if ($affectedRows > 1) errorOutWithMessage("More than one row affected", true);

$stmt = $db->stmt_init();

$sql = "SELECT id,date FROM CMP204comments WHERE id = " . $db->insert_id;

if (!$stmt = $db->prepare($sql)) errorOutWithMessage("PostComment could not prepare SQL statement for data get");
$stmt->execute();
$result = $stmt->get_result();
$result = $result->fetch_assoc();
echo json_encode(array("success", $_SESSION["username"], $result["id"], $result["date"]));
return;