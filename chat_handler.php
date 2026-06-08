<?php
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';
    if ($message && isset($_SESSION['user'])) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user']['roblox_id'], $message]);
    }
    exit;
}

echo json_encode(getRecentMessages($pdo));
?>
