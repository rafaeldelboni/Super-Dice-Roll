<?php

namespace Longman\TelegramBot\Commands;
use Longman\TelegramBot\Command;
use Longman\TelegramBot\Request;

class RollCommand extends Command
{
    protected $name = 'roll';
    protected $description = 'Roll a dice';
    protected $usage = '/roll 2d12+3';
    protected $version = '1.0.1';
    protected $public = true;

    private function parseRollString($inputRoll) {
        $roll = strtoupper($inputRoll);
        $diceSeparator = 'D';

        if (strrpos($roll, $diceSeparator) === false) {
            return false;
        }
        
        $splitRoll = preg_split("/$diceSeparator/", $roll);

        $firstPart = empty($splitRoll[0]) ? "1" : $splitRoll[0];
        $secondPart = $splitRoll[1];

        $times =  ctype_digit($firstPart) ? intval($firstPart) : NULL;
        if ($times === NULL || $times < 0 || $times > 100){
            return false;
	    } else if ($times === 0) {
            $times = 1;
        }

        $dice = NULL;
        $modifier = NULL;        
        if (strrpos($secondPart, '+') > 0 ) {
            $rollStr = preg_split('/[+]/', $secondPart);
            if(count($rollStr) > 2){
                return false;
            }
            $dice = intval($rollStr[0]);
            $modifier = intval($rollStr[1]);
        } else if (strrpos($secondPart, '-') > 0 ) {
            $rollStr = preg_split('/[-]/', $secondPart);
            if(count($rollStr) > 2){
                return false;
            }
            $dice = intval($rollStr[0]);
            $modifier = -1 * intval($rollStr[1]);
        } else {
            $dice = intval($secondPart);
            if($dice === 0 || $dice <= 0){
		        return false;
	        }
            $modifier = 0;
        }

        if($dice === NULL || $modifier === NULL) {
            return false;
        }
        
        $rollValues = (object) [
            'times' => $times,
            'dice' => $dice,
            'modifier' => $modifier
        ];
        
        return $rollValues;
    }

    private function calculateRoll($roll) {
        $rolls = array();
        $sum = 0;
        for ($i = 0; $i < $roll->times; $i++) {
            $rolled = rand(1, $roll->dice);
            $sum += $rolled;
            array_push($rolls, $rolled);
        };
        $sum += $roll->modifier;
        
        $result = (object) [
            'rolls' => $rolls,
            'sum' => $sum
        ];

        return $result;
    }

    public function execute()
    {
		$message = $this->getMessage();
        $message_id = $message->getMessageId();
		$chat_id = $message->getChat()->getId();
		$text = $message->getText(true);
        $username = $message->getFrom()->getUsername();
        
		if(empty($text)) {
			$text = 'You must specify dice and modifiers in format: /roll <NDM>
						N = Number of dices
						D = Type of dices (D6, D12, D20)
						M = Modifiers (+1, -3)
                     Example: /roll 3D6+3';
		} else {
            $parsedRoll = $this->parseRollString($rollText);
            if (!$parsedRoll) {
                return false;
            }

            $result = $this->calculateRoll($parsedRoll);
            
            $msgText = $username . " | " . $rollText . " | " . $result->sum;
            $msgText .= "\n" . "Rolled values: ";
            for ($i = 0; $i < count($result->rolls); $i++) {
                $msgText .= $result->rolls[$i];
                if ($i < count($result->rolls)-1) {
                    $msgText .= ', ';
                }
            };

            return Request::sendMessage($msgText);
        }
    }
}
