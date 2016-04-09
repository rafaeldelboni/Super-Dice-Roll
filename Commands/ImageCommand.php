<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Longman\TelegramBot\Commands;
use Longman\TelegramBot\Command;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\ReplyKeyboardMarkup;
/**
 * User "/image" command
 */
class ImageCommand extends Command
{
    /**#@+
     * {@inheritdoc}
     */
    protected $name = 'image';
    protected $description = 'Send Image';
    protected $usage = '/image';
    protected $version = '1.0.0';
    protected $public = true;
    /**#@-*/
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $message->getText(true);
        $data = [];
        $data['chat_id'] = $chat_id;
        $data['caption'] = $text;
	$data['disable_notification'] = false;
	/*
        return Request::sendPhoto($data, $this->telegram->getUploadPath().'/'.'image.jpg');
 	*/
	return Request::sendPhoto($data, $this->ShowRandomImage($this->telegram->getUploadPath()));
   
    }

	private function ShowRandomImage($dir) {
		$image_list = scandir($dir);
		return $dir . "/" . $image_list[mt_rand(2, count($image_list) - 1)];
	}
}	

 
