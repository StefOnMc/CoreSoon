<?php

namespace Stef\Task;

use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use Stef\Base;

class Combat
{
	public static function combatTask()
	{
		Base::getInstance()->getScheduler()->scheduleRepeatingTask(new ClosureTask(
			function() {
				foreach (Base::$pc as $playerName => $time)
				{
					$time--;
					Base::$pc[$playerName]--;
					if ($time <= 0)
					{
						unset(Base::$pc[$playerName]);
						$player = Base::getInstance()->getServer()->getPlayerExact($playerName);
if($player instanceof Player){
	$player->sendMessage("§cVous n'etes plus en combat.");
}

					}
				}
			}
		), 20);
	}
}