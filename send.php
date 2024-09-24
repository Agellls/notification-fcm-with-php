<?php
require_once("vendor/autoload.php");

use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

// Check if the subscription parameter is provided
if (!isset($_GET['alert']) || empty($_GET['alert'])) {
    die("No subscription data provided.");
}

// Decode the JSON data
$subscriptionData = json_decode(urldecode($_GET['alert']), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Invalid JSON data.");
}

// Optional: Check if a delay parameter is provided
$delayInSeconds = isset($_GET['time']) ? (int)$_GET['time'] : 0;

$auth = [
    'VAPID' => [
        'subject' => 'mailto:#ChangeWithYourEmail',
        'publicKey' => '#ChangeWithYourPublicKey',
        'privateKey' => '#ChangeWithYourPrivateKey',
    ],
];

$webPush = new WebPush($auth);

$report = $webPush->sendOneNotification(
    Subscription::create($subscriptionData),
    json_encode([
        "title" => "#YourTitleNotif",
        "body" => "#YourTitleNotif",
        "url" => "#InpuYourLinkRedirectNotif",
        "delay" => $delayInSeconds // Delay in seconds
    ]),
    ['TTL' => 5000]
);

print_r($report);
