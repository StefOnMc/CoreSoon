<?php

namespace Stef\Task;

use pocketmine\scheduler\ClosureTask;
use Stef\Loader;

class Broadcast
{
public static function Start(){
	Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new ClosureTask(function(){
		$msg = Loader::getInstance()->getConfig()->get("Broadcast");
		Loader::getInstance()->getServer()->broadcastMessage($msg[array_rand($msg)]);
	}),300*20);
}
}