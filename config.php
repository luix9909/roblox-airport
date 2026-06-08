<?php
session_start();

define('ROBLOX_CLIENT_ID', 'YOUR_CLIENT_ID_HERE');
define('ROBLOX_CLIENT_SECRET', 'YOUR_CLIENT_SECRET_HERE');
define('REDIRECT_URI', 'http://yourdomain.com/callback.php'); // غيّرها

$host = 'localhost';
$db   = 'roblox_airport';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
