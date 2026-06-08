<?php
require 'config.php';
require 'functions.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token_url = 'https://apis.roblox.com/oauth/v1/token';
    $data = [
        'client_id' => ROBLOX_CLIENT_ID,
        'client_secret' => ROBLOX_CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => REDIRECT_URI
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $response = curl_exec($ch);
    curl_close($ch);

    $token = json_decode($response, true);

    if (isset($token['access_token'])) {
        $access_token = $token['access_token'];

        $ch = curl_init('https://apis.roblox.com/oauth/v1/userinfo');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $access_token"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $user_resp = curl_exec($ch);
        curl_close($ch);

        $user = json_decode($user_resp, true);

        if (isset($user['sub'])) {
            $roblox_id = $user['sub'];
            $username = $user['preferred_username'] ?? $user['nickname'] ?? 'player';
            $avatar = $user['picture'] ?? "https://thumbnails.roblox.com/v1/users/avatar-headshot?userIds=$roblox_id&size=150x150&format=Png";

            $tag = generateCustomTag($username);

            $stmt = $pdo->prepare("INSERT INTO users (roblox_id, username, tag, avatar_url) 
                                  VALUES (?, ?, ?, ?) 
                                  ON DUPLICATE KEY UPDATE username=VALUES(username), tag=VALUES(tag), avatar_url=VALUES(avatar_url)");
            $stmt->execute([$roblox_id, $username, $tag, $avatar]);

            $_SESSION['user'] = [
                'roblox_id' => $roblox_id,
                'username' => $username,
                'tag' => $tag,
                'avatar' => $avatar
            ];

            header("Location: dashboard.php");
            exit;
        }
    }
}
echo "حدث خطأ في تسجيل الدخول. <a href='login.php'>حاول مرة أخرى</a>";
?>
