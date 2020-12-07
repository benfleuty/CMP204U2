<?php
require_once "config.php";
session_start();

if (!isset($_POST["login"]) or !($_POST["login"])) errorOut();
$username = $db->real_escape_string($_POST["username"]);
$password = $db->real_escape_string($_POST["password"]);

$stmt = $db->stmt_init();
$sql = "SELECT password FROM CMP204users WHERE username = ?";
if(!$stmt = $db->prepare($sql)) errorOut();

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result(); // get the query result
if (mysqli_num_rows($result) <= 0) errorOut();
$data = $result->fetch_assoc();
if (!password_verify($password, $data["password"])) errorOut();
$_SESSION["username"] = $username;
echo "success";
exit();
