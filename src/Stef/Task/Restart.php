<?php

namespace Stef\Task;

use pocketmine\scheduler\Task;
use Stef\Base;

class Restart extends Task
{
	private static int $restart = 10;
public function onRun(): void
{
	self::$restart--;
	if (self::$restart === 0) {
		foreach (Base::getInstance()->getServer()->getOnlinePlayers() as $p){
			$p->transfer(Base::IP,Base::PORT);
			Base::getInstance()->getServer()->forceShutdown();
		}
	}else{
		Base::getInstance()->getServer()->broadcastMessage("§erédémarage dans ". self::$restart . " seconde");
		if(self::$restart === 1){
			Base::getInstance()->getServer()->broadcastMessage("§arédémarage en cour");
		}
	}
}
}