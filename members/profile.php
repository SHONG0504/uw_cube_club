<?php
$env = parse_ini_file("../.env");
$hostname = $env["DB_HOST"];
$username = $env["DB_USERNAME"];
$password = $env["DB_PASSWORD"];
$dbname = $env["DB_NAME"];

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
  die("DB connection failed");
}

$wca_id = $_GET["wca_id"];

$sql = "SELECT name, program, level, year, wca FROM members WHERE wca=".$wca_id;
$result = $conn->query($sql);
print_r($result);
?>