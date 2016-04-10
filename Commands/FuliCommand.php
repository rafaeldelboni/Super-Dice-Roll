<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Jimes Yang aka sndnvaps <sndnvaps@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Longman\TelegramBot\Commands;
use Longman\TelegramBot\Command;
use Longman\TelegramBot\Request;
/**
 * User "/fuli" command
 */
class FuliCommand extends Command
{
    /**#@+
     * {@inheritdoc}
     */
    protected $name = 'fuli';
    protected $description = 'search for fuli magnet';
    protected $usage = '/fuli <CarNo.> ';
    protected $version = '1.0.0';
    protected $public = true;

     //set time zone

private function SearchCode($code) {
	$bthave = 'http://www.bthave.net/search/';
	$new_code = '';
	$html_url = '';
	$reg_str = "magnet[^ <'\"]*";

	//replace 'blank space' with '%20'
	if(eregi(' ', $code, $matches)) {
		str_replace(' ', '%20', $code);
		$new_code = $code;
	}
	if(empty($new_code)) {
		$html_url = $bthave . $code;
	} else {
		$html_url = $bthave . $new_code;
	}
	
	$html = file_get_contents($html_url);
	if(eregi($reg_str, $html,$matches)) {
		// do nothing
	} else {
		return " ";
	}
	
	foreach ($matches as $k) {
  		if(!empty($k)) {
    		return $k;
  		}
	}
}





// date_default_timezone_set('UTC+1');
    /**#@-*/
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
	$message = $this->getMessage();
        $message_id = $message->getMessageId();
	$chat_id = $message->getChat()->getId();
	$text = $message->getText(true);
	if(empty($text)) {
		$text = 'Gave me you code! Old driver:
			command: /fuli <code>
			';
	} else {
	$magnet = $this->SearchCode($text);
	$text = $magnet;	
        }

	$data = [
            'chat_id' => $chat_id,
	    'disable_notification' => false,
            'reply_to_message_id' => $message_id,   
	    'text'    => $text,
        ];
        return Request::sendMessage($data);
    }
}
