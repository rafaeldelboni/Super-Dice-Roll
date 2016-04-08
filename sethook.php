<?php
//Composer Loader
$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = 'YOU_API_key';
$BOT_NAME = '@you_boot_name';
$link = 'https://www.domain.com/path/webhook.php';
try {
    // create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
    // set webhook
    $result = $telegram->setWebHook($link);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e;
}
?>
