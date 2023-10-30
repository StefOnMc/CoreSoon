<?php

namespace Stef\Utils;

use Stef\Base;
use Stef\Task\Clearlag;
use Stef\Task\Combat;
use Stef\Task\Kit;
use Stef\Task\Message;

class TaskUtils
{
public static function RegistryTask(){
	Base::getInstance()->getScheduler()->scheduleRepeatingTask(new Clearlag(),20);
	Base::getInstance()->getScheduler()->scheduleRepeatingTask(new Kit(),20);
	Combat::combatTask();
	Message::MsgTask();
}
}