<?php

namespace Stef\Command\Grade;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Back extends VanillaCommand
{
	private array $c = [];
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("back.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("back.use")){
			if(isset($this->c[$sender->getName()]) && time() - $this->c[$sender->getName()] < 30){
				$restant = 30 - (time() - $this->c[$sender->getName()]);
				$sender->sendMessage("§cVous devrez attendre ". $restant . " secondes.");
			}else{
				$this->c[$sender->getName()] = time();
				if (!empty(Base::$back[$sender->getName()])) {
					$sender->teleport(Base::$back[$sender->getName()]);
					$sender->sendMessage("§aVous avez bien été téleporté.");
				}else{
					$sender->sendMessage("§cVous n'etes pas mort.");
				}
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}