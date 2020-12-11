<?php
session_start();
include_once "config.php";

/**
 * @var $db
 */

// if the user isn't logged in
if (!loggedIn()) {
    echo "guest";
    return;
}

// user is logged in

$stmt = $db->stmt_init();
$sql = "DELETE FROM CMP204users WHERE id = {$_SESSION["id"]}";
if (!$stmt = $db->prepare($sql)) errorOutWithMessage("DeleteComment could not prepare SQL statement");
if ($stmt->execute()) echo "success";
else errorOut();