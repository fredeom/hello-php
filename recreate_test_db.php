<?php
require 'db_info.php';

// utils
function getRandomTime() {
  $start     = strtotime("10 September 2000");
  $end       = strtotime("22 July 2010");
  $timestamp = mt_rand($start, $end);
  return date("Y-m-d H:i:s", $timestamp);
}
function getRandomItemId($i) {
  return "Z" . substr(str_shuffle(MD5(microtime())), 0, 3) . "-" . $i;
}
mt_srand(42); // numbers will be pseudo random
function getRandomNumber($max) {
  return mt_rand(0, $max);
}

echo "ReCreating test db...<br>\n";
try {
  $conn = new PDO("mysql:host=$dbhost", $dbusername, $dbuserpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DROP DATABASE IF EXISTS $dbname";
  $conn->exec($sql);
  echo "Database '$dbname'(if existed) removed successfully<br>\n";
  $sql = "CREATE DATABASE $dbname";
  $conn->exec($sql);
  echo "Database '$dbname' created successfully<br>\n";
  $sql =
  "CREATE TABLE $gentablename (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    " . $colnames[0] . " VARCHAR(30) UNIQUE NOT NULL, 
    " . $colnames[1] . " VARCHAR(30) NOT NULL, 
    " . $colnames[2] . " VARCHAR(30) NOT NULL, 
    " . $colnames[3] . " VARCHAR(30) NOT NULL, 
    " . $colnames[4] . " VARCHAR(30) NOT NULL, 
    " . $colnames[5] . " INT, 
    " . $colnames[6] . " INT, 
    " . $colnames[7] . " TIMESTAMP 
  )";
  $conn->query("use $dbname");
  $conn->exec($sql);
  echo "Table '$gentablename' created successfully...<br>\n";
  $scolnames = "";foreach ($colnames as $name) {$scolnames .= $name . ", "; }$scolnames=rtrim($scolnames,", ");
  $sql = "INSERT INTO $gentablename($scolnames) VALUES(?,?,?,?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  for ($i = 0; $i < $genrowcount; $i++) {
    $stmt->execute(array(getRandomItemId($i),
                         "name" . $i,
                         "brand" . getRandomNumber(5),
                         "type" . getRandomNumber(9),
                         "color" . getRandomNumber(9),
                         50 + 50 * $i / $genrowcount,
                         10 * getRandomNumber(3),
                         getRandomTime()));
  }
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>