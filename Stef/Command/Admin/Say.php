<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Say extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("say.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("say.use")){
			$msg = implode(" ", $args);
			if(empty($msg)){
				$sender->sendMessage("§c eh oh il et ou le message ?");
			}else{
				Base::getInstance()->getServer()->broadcastMessage(Base::PREFIX . " ".$msg);
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}