<?php
$TOKEN = "8443807230:AAGtESbnwXXhh1pN4ec_M-mV_fPAe0QvLI8";

$update = json_decode(file_get_contents("php://input"), true);
if (!$update) {
    echo "OK"; exit;
}

$message = $update['message'] ?? $update['callback_query']['message'];
if (!$message) { echo "OK"; exit; }

$chat_id = $message['chat']['id'];
$text = $message['text'] ?? '';
$name = $message['from']['first_name'] ?? 'کارآگاه';

function send($chat_id, $text, $kb = null) {
    global $TOKEN;
    $data = ['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML'];
    if ($kb) $data['reply_markup'] = json_encode($kb);
    file_get_contents("https://api.telegram.org/bot$TOKEN/sendMessage?" . http_build_query($data));
}

$menu = ['keyboard' => [[['text' => 'پرونده امروز']]], 'resize_keyboard' => true];

if ($text == "/start") {
    send($chat_id, "🕵️‍♂️ سلام <b>$name</b>!\nربات با Render کار می‌کنه! 🎉", $menu);
}

echo "OK";
?>
