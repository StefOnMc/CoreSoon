<?php

namespace Stef\Command\Staff;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\WebhookUtils;

class Kick extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("kick.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("kick.use")){
			$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
			if($t === null){

			}else{
				if(is_numeric($args[1])){

				}else{

				}
				$c = implode(" ", array_slice($args, 2));
				$cs = $args[1] . ' ' . $c;
				WebhookUtils::Kick($t->getName(). " vien de se faire éjecter par ". $sender->getName() ." pour la raison ". $cs);
				$t->kick($cs . " par ". $sender->getName());
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}