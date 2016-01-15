<?php
$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = '123456789:your_bot_api_key';
$BOT_NAME = 'name_bot';
$COMMANDS_FOLDER = __DIR__.'/cmd/';

try {
    // create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
    
    // Log Telegram messages
    $telegram->setLogRequests(true);
	$telegram->setLogPath($BOT_NAME.'.log');
	$telegram->setLogVerbosity(1);

	// Custom commands folder
	$telegram->addCommandsPath($COMMANDS_FOLDER);
	
    // handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e;
}