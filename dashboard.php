<?php 
require 'config.php';
require 'functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مطار روبلوكس - لوحة التحكم</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="user-info">
            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="avatar">
            <div>
                <strong><?= htmlspecialchars($user['tag']) ?></strong><br>
                <small><?= htmlspecialchars($user['username']) ?></small>
            </div>
        </div>
        <a href="logout.php" class="logout-btn">خروج</a>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>القائمة</h2>
            <ul>
                <li onclick="showSection('chat')">💬 الشات العام</li>
                <li onclick="showSection('atc')">🗣️ مراقبة جوية (ATC)</li>
                <li onclick="showSection('flights')">✈️ الرحلات والطائرات</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Chat Section -->
            <div id="chat-section" class="section">
                <h2>الشات العام بين الطيارين</h2>
                <div id="chat-box" class="chat-box"></div>
                <div class="input-area">
                    <input type="text" id="message" placeholder="اكتب رسالتك هنا...">
                    <button onclick="sendMessage()">إرسال</button>
                </div>
            </div>

            <!-- ATC Section -->
            <div id="atc-section" class="section hidden">
                <h2>نظام المراقبة الجوية ATC</h2>
                <input type="text" id="atc-command" placeholder="مثال: request takeoff">
                <button onclick="sendATC()">إرسال الأمر</button>
                <div id="atc-response" class="response"></div>
            </div>

            <!-- Flights Section (مكان للتوسع) -->
            <div id="flights-section" class="section hidden">
                <h2>لوحة الرحلات والطائرات</h2>
                <p>هنا ستضاف قائمة الطائرات، المطارات، حالة الرحلات... إلخ (يمكن توسيعها).</p>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
