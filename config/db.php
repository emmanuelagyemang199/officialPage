<?php
// Database configuration (fill with real values)
$DB_HOST = 'localhost';
$DB_NAME = 'database_name';
$DB_USER = 'db_user';
$DB_PASS = 'db_pass';
try {
  $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // In production, log the error and show generic message
  die('Database connection failed.');
}
