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

$sql = "SELECT name, program, level, year, wca FROM members ORDER BY year DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css" type="text/css"/>
  <title>Members</title>
</head>
<body class="page-container">

<h2>Members</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Program</th>
    <th>Level</th>
    <th>Year</th>
    <th>WCA</th>
  </tr>
  <?php
  while ($row = $result->fetch_assoc()) {
    $wca_link = empty($wca)
      ? ""
      : "https://www.worldcubeassociation.org/persons/" . $row["wca"];
    echo "<tr>
      <td>" . htmlspecialchars($row["name"]) . "</td>
      <td>" . htmlspecialchars($row["program"] ?? "") . "</td>
      <td>" . htmlspecialchars($row["level"] ?? "") . "</td>
      <td>" . htmlspecialchars($row["year"] ?? "") . "</td>
      <td>";
    if (!empty($row["wca"])) {
      $link = "https://www.worldcubeassociation.org/persons/" . $row["wca"];
      echo "<a href=\"" . $link . "\">" . $row["wca"] . "</a>";
    }
    echo "</td>
      </tr>";
    }
  $conn->close();
  ?>
</table>

</body>
</html>
