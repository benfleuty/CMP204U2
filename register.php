<?php
/**
 *
 * @var $db
 *
 */


session_start();
require_once "config.php";

if (!isset($_POST["register"]) or !($_POST["register"])) errorOut();
$username = $db->real_escape_string($_POST["username"]);
$fname = $db->real_escape_string($_POST["fname"]);
$lname = $db->real_escape_string($_POST["lname"]);
$password = $db->real_escape_string($_POST["password"]);

$sql = "SELECT * FROM CMP204users WHERE username = ?";
$stmt = $db->stmt_init();
if (!$stmt = $db->prepare($sql)) errorOut();

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
// check for username in use
if (mysqli_num_rows($result) > 0)
    errorOutWithMessage("username taken");

// salt
// password + drowssap + username + emanresu
$password .= strrev($password) . $username . strrev($username);
$password = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO CMP204users (username,password) VALUES (?,?)";
$stmt = $db->stmt_init();

if (!$stmt = $db->prepare($sql)) errorOut();

$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    $stmt = $db->stmt_init();
    $sql = "SELECT * FROM CMP204users WHERE username = ? AND password = ?";
    if(!$stmt = $db->prepare($sql)) errorOut();

    $stmt->bind_param("ss", $username,$password);
    $stmt->execute();
    $result = $stmt->get_result(); // get the query result
    if (mysqli_num_rows($result) != 1) errorOut();
    $data = $result->fetch_assoc();

    $_SESSION["id"] = $data["id"];
    $_SESSION["username"] = $username;
    echo "success";
    exit();
} else errorOut();

$stmt->close();
