<?php

namespace Stef\Task;

use pocketmine\scheduler\Task;
use Stef\Listener\Safe;

class ChatGame extends Task
{
	public function onRun(): void {
		$gameTypes = ["math", "mot"];
		$gameType = $gameTypes[array_rand($gameTypes)];

		Safe::startGame($gameType);
		Safe::$currentGameQuestionMath = [];
		Safe::$currentGameQuestionChat = [];
	}
}