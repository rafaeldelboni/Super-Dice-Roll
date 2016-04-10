<?php
//Composer Loader
$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = 'YOU_API_key';
// botname cann't contain with '@'
$BOT_NAME = 'you_boot_name';
$hook_url = 'https://www.domain.com/path/webhook.php';
// you should put certificate under ./cert folder 
// the server.crt should sign the nginx as same
//
$certificate_file = __DIR__.'/cert/server.crt';
try {
    // create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
    // set webhook
    $result = $telegram->setWebHook($hook_url, $certificate_file);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e;
}
?>
