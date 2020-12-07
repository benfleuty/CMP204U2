<?php
$dbhost = "lochnagar.abertay.ac.uk";
$dbusername = "sql1900040";
$dbpassword = "EVUrsMKYpvIn";

$db = new mysqli($dbhost, $dbusername, $dbpassword, $dbusername);

if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);
