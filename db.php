<?php
$host = 'localhost'; // Change if using a remote server
$dbname = 'coubook'; // Your database name
$username = 'root'; // Your MySQL username
$password = 'yun5201617'; // Your MySQL password (leave blank if not set)

try {
  // Use the global variable for database connection
  global $db;
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database Connection Failed: " . $e->getMessage());
}
?>
