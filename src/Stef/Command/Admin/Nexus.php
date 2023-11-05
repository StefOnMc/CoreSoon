<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\entity\Entity;
use pocketmine\entity\Location;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Listener\Server;
use Stef\Utils\EntityUtils;
use Stef\Utils\WebhookUtils;

class Nexus extends VanillaCommand
{
	public static bool $nexuss = false;
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("nexus.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("nexus.use")){
			if(isset($args[0])){
				switch ($args[0]){
					case "start":
					if(self::$nexuss === false){
						$n = new \Stef\Entity\Nexus(new Location(9,90,9,Base::getInstance()->getServer()->getWorldManager()->getWorldByName('world'),0,0));
						$n->setMaxHealth(2500);
						$n->setHealth(2500);
						$n->setNameTag("Nexus \n " . "2500/2500");
						$n->spawnToAll();
						self::$nexuss = true;
						WebhookUtils::Nexus("un nexus vien d'etre lancé !");
						Base::getInstance()->getServer()->broadcastMessage("un nexus vien d'etre lancé!");
					}else{
						$sender->sendMessage("le nexus a deja spawn");
					}
						break;
					case "stop":
						if(self::$nexuss === true){
							EntityUtils::ClearNexus();
							self::$nexuss = false;
							WebhookUtils::Nexus("le nexus vien d'etre stop par ". $sender->getName());
							Base::getInstance()->getServer()->broadcastMessage("le nexus vien d'etre stop par ". $sender->getName());
						}else{
							$sender->sendMessage("le nexus n'a jamais spawn");
						}
						break;
					default:
						$sender->sendMessage("§c/nexus start/stop");
						break;
				}
			}else{
				$sender->sendMessage("§c/nexus start/stop");
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}
