<?php
/**
 *
 * @var $db
 *
 */

session_start();
require_once "config.php";

$stmt = $db->stmt_init();
$sql = "DELETE FROM CMP204comments WHERE id = ?";
if (!$stmt = $db->prepare($sql)) errorOutWithMessage("DeleteComment could not prepare SQL statement");
$stmt->bind_param("s",$_POST["id"]);
if($stmt->execute()) echo "success";
else errorOut();