<?php
require 'config.php';

$cmd = strtolower(trim($_POST['command'] ?? ''));

$responses = [
    'request takeoff' => 'Clear for takeoff runway 27, wind 270° at 8 knots.',
    'request landing' => 'Cleared to land runway 09, report runway in sight.',
    'ready' => 'Taxi to holding point A1.',
    'mayday' => 'Emergency declared. Fire and rescue on standby.',
];

$response = $responses[$cmd] ?? 'Roger that, ' . $_SESSION['user']['tag'];

echo json_encode(['response' => $response]);
?>
