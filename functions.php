<?php
function generateCustomTag($username) {
    $username = strtolower($username);
    $prefix = substr($username, 0, 2);
    $suffix = substr($username, -2);
    $number = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
    return $prefix . $suffix . '-' . $number;
}

function getUser($pdo, $roblox_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE roblox_id = ?");
    $stmt->execute([$roblox_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getRecentMessages($pdo) {
    $stmt = $pdo->query("SELECT m.*, u.tag, u.avatar_url 
                         FROM messages m 
                         JOIN users u ON m.user_id = u.roblox_id 
                         ORDER BY m.created_at DESC LIMIT 50");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
