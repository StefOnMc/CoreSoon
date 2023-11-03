<?php

namespace Stef\Command\Staff;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\MuteUtils;

class Unmute extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("unmute.use");
}

public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("unmute.use")){
			$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
			if($t === null){
				$sender->sendMessage("§cLe joueur spécifié et hors ligne.");
			}else{
				MuteUtils::Unmute($t->getName());
				$sender->sendMessage("§aVous avez bien unmute ". $t->getName());
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}else{
		$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
		if($t === null){
			$sender->sendMessage("§cLe joueur spécifié et hors ligne.");
		}else{
			MuteUtils::Unmute($t->getName());
			$sender->sendMessage("§aVous avez bien unmute ". $t->getName());
		}
	}
}
}