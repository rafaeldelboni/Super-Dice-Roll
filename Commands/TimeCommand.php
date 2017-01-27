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
 * User "/time" command
 */
class TimeCommand extends Command
{
	/**#@+
		* {@inheritdoc}
		*/
    protected $name = 'time';
    protected $description = 'Show current time';
    protected $usage = '/time <timezone> ';
    protected $version = '1.0.2';
    protected $public = true;

	//set time zone
	private function IsTimeZone($value,$Timezone) {
		$tt = array(
				'EET',
				'UTC',
				'PRC',
				'CET');

		foreach($tt as $v) {
			if ($v == $value) {
				return $value;
			}
		}

		return 'PRC';
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
			$text = 'You must specify timezone in format: /time <timezone>
				timezone list -> 
						EET = UTC+2
						UTC = UTC
						PRC = PRC --- UTC+8
						CET = 	UTC+1
				';
		} else {
			$tz =   $this->IsTimeZone($text,$timezone);
			if (empty($tz)) {
				date_default_timezone_set('PRC');
				$text =  strftime ("Time is %F  %H:%M:%S" ,time());
			} else {
				date_default_timezone_set($tz);
				$text =  strftime ("Time is %F  %H:%M:%S" ,time());
			}
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
