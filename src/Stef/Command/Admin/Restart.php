<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Restart extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("restart.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("restart.use")){
			$sender->sendMessage("restart lancé.");
			Base::getInstance()->getScheduler()->scheduleRepeatingTask(new \Stef\Task\Restart(),20);
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}else{
		$sender->sendMessage("restart lancé.");
		Base::getInstance()->getScheduler()->scheduleRepeatingTask(new \Stef\Task\Restart(),20);
	}
}
}