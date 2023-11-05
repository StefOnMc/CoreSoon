<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\KothUtils;
use Stef\Utils\WebhookUtils;

class Koth extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("koth.use");
}

public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player) {
		if ($sender->hasPermission("koth.use")) {
			if(isset($args[0])){
				if($args[0] === "start"){

					KothUtils::$koth->reload();
					if(KothUtils::$koth->get("pos1") === "0:0:0" && KothUtils::$koth->get("pos2") === "0:0:0"){
						$sender->sendMessage("il faut configuré les positions d'abord.");
					}else{
						if(!KothUtils::$koth->getNested("koth.start") ?? false){
							KothUtils::$koth->setNested("koth.start", true);
							KothUtils::$koth->save();
							$task = new \Stef\Task\Koth();
							Base::getInstance()->getScheduler()->scheduleDelayedTask($task, 20);
							WebhookUtils::Koth("Le koth vien de se start !");
							Base::getInstance()->getServer()->broadcastMessage("le koth vien de start go");
						}
					}

				}
				else if($args[0] === "stop"){
					KothUtils::$koth->reload();
					if(!KothUtils::$koth->getNested("koth.start")){
						$sender->sendMessage("le koth a pas commencé");
					}else{
						if(KothUtils::$koth->getNested("koth.start") ?? false){
							$sender->sendMessage("ta bien arete le koth");
							KothUtils::$koth->remove("koth");
							KothUtils::$koth->save();
							WebhookUtils::Koth("Le koth vien de se stop manuelement par ". $sender->getName());
							KothUtils::$bar->removePlayers(Base::getInstance()->getServer()->getOnlinePlayers());
							Base::getInstance()->getServer()->broadcastMessage("Le koth vien de se stop manuelement par ". $sender->getName());
						}else{
							$sender->sendMessage("il a pas de koth en cour.");
						}

					}
				}
				else if($args[0] === "pos1"){
					KothUtils::$koth->reload();
					$x = $sender->getPosition()->x;
					$y = $sender->getPosition()->y;
					$z = $sender->getPosition()->z;
					$w = $sender->getPosition()->world;
					KothUtils::$koth->set("pos1", (int)$x.":".(int)$y.":".(int)$z);
					KothUtils::$koth->set("world", $w->getDisplayName());
					KothUtils::$koth->save();
					$sender->sendMessage("Ta bien config la pos1.");
				}
				else if($args[0] === "pos2"){
					KothUtils::$koth->reload();
					$x = $sender->getPosition()->x;
					$y = $sender->getPosition()->y;
					$z = $sender->getPosition()->z;
					$w = $sender->getPosition()->world;
					KothUtils::$koth->set("pos2", (int)$x.":".(int)$y.":".(int)$z);
					KothUtils::$koth->set("world", $w->getDisplayName());
					KothUtils::$koth->save();
					$sender->sendMessage("ta bien config la pos 2 du koth.");
				}
			}else{
				$sender->sendMessage("§c /koth start/stop/pos1/pos2");
			}
		} else {
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}