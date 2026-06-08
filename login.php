<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - مطار روبلوكس الافتراضي</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-box">
        <h1>✈️ مطار روبلوكس الافتراضي</h1>
        <a href="https://apis.roblox.com/oauth/v1/authorize?client_id=<?= ROBLOX_CLIENT_ID ?>&redirect_uri=<?= urlencode(REDIRECT_URI) ?>&response_type=code&scope=openid%20profile">
            <button class="roblox-btn">تسجيل الدخول عبر Roblox</button>
        </a>
    </div>
</body>
</html>
