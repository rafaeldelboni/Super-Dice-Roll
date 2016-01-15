<?php

/*
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
namespace Longman\TelegramBot\Commands;

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Command;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\Entity;

class InlinequeryCommand extends Command
{
    protected $name = 'inlinequery';
    protected $description = 'Reply to inline query';
    protected $usage = '';
    protected $version = '1.0.0';
    protected $enabled = true;
    protected $public = false;

    public function execute()
    {
        $update = $this->getUpdate();
        $inline_query = $update->getInlineQuery();
        $query = $inline_query->getQuery();

        $data = [];
        $data['inline_query_id']= $inline_query->getId();

		$articles = [];
		$articles[] = [
			'id' => '001' , 'title' => 'D4', 'description' => 'Tetrahedron', 
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/19/4-sided_dice_250.jpg', 
			'thumb_width' => 163, 'thumb_height' => 182,
			'message_text' => 'You rolled D4: ' . rand(1,4)
		];
		$articles[] = [
			'id' => '002' , 'title' => 'D6', 'description' => 'Cube', 
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Dice_2005.jpg/238px-Dice_2005.jpg',
			'thumb_width' => 238, 'thumb_height' => 240,
			'message_text' => 'You rolled D6: ' . rand(1,6)
		];
		$articles[] = [
			'id' => '003' , 'title' => 'D8', 'description' => 'Octahedron',
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/D8_truncated_octahedron.JPG/237px-D8_truncated_octahedron.JPG',
			'thumb_width' => 237, 'thumb_height' => 240,
			'message_text' => 'You rolled D8: ' . rand(1,8)
		];
		$articles[] = [
			'id' => '004' , 'title' => 'D10', 'description' => 'Pentagonal',
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/10_sided_die.svg/235px-10_sided_die.svg.png',
			'thumb_width' => 235, 'thumb_height' => 240,
			'message_text' => 'You rolled D10: ' . rand(1,10)
		];
		$articles[] = [
			'id' => '005' , 'title' => 'D12', 'description' => 'Dodecahedron', 
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/D12_rhombic_dodecahedron.JPG/256px-D12_rhombic_dodecahedron.JPG',
			'thumb_width' => 238, 'thumb_height' => 240,
			'message_text' => 'You rolled D12: ' . rand(1,12)
		];
		$articles[] = [
			'id' => '006' , 'title' => 'D20', 'description' => 'Icosahedron',
			'thumb_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/97/20-sided_dice_250.jpg',
			'thumb_width' => 162, 'thumb_height' => 153,
			'message_text' => 'You rolled D20: ' . rand(1,20)
		];

		$results = [];
		foreach($articles as $key => $value) {
			if (stripos($value["title"], $query) !== false) {
				$results[] = $value;
			} 
		}
		if (count($results) == 0 || (!isset($query) || trim($query)==='')) {
			$results = $articles;
		}
		
        $array_article = [];
        foreach ($results as $article) {
            $array_article[] = new InlineQueryResultArticle($article);
        }
        $array_json = '['.implode(',', $array_article).']';
        $data['results'] = $array_json;
		$data['cache_time'] = 0;

        $result = Request::answerInlineQuery($data);

        return $result->isOk();
    }
}
