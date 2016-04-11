<?php
$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = '123456789:your_bot_api_key';
$BOT_NAME = 'your_bot_name';
$COMMANDS_FOLDER = __DIR__.'/Commands/';

$upload_path = __DIR__ . '/Upload/';

try {
    // create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
    
    // set up Upload pic path 
	$telegram->setUploadPath($upload_path);
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
