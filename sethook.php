<?php
//Composer Loader
$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = '123456789:your_bot_api_key';
$BOT_NAME = 'name_bot';
$link = 'https://your.domain.com/SuperDiceRoll/webhook.php';
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