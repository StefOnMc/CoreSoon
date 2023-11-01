<?php

namespace Stef\Task;

use pocketmine\scheduler\ClosureTask;
use Stef\Base;

class Message
{

public static function MsgTask(){
	Base::getInstance()->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (){
		Base::getInstance()->getServer()->broadcastMessage(Base::$msg[array_rand(Base::$msg)]);
	}),300*20);
}
}