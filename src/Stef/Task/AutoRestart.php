<?php

namespace Stef\Task;

use pocketmine\scheduler\ClosureTask;
use Stef\Base;

class AutoRestart
{
public static function Start(){
	Base::getInstance()->getScheduler()->scheduleRepeatingTask(new ClosureTask(function(){
		if(Base::getInstance()->getServer()->isRunning() === false){
			Base::getInstance()->getServer()->shutdown();
		}
	}),20);
}
}