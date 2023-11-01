<?php

namespace Stef\Command\Staff;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\MuteUtils;
use Stef\Utils\WebhookUtils;

class Mute extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("mute.use");
}

public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("mute.use")){
			if(empty($args[0])){
				$sender->sendMessage("§c/mute joueur 1 année/mois/jour/heure/minutes/seconde raison");
			}else{
				$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
				if($t === null){
					$sender->sendMessage("§cLe joueur spécifié et hors ligne.");
				}else{
					if(MuteUtils::hasMute($t->getName())){
						$sender->sendMessage($t->getName() . " et déja mute.");
					}else{
						if(empty($args[0]) ||empty($args[1]) ||empty($args[2]) || empty($args[3])){
							if(empty($args[2])){
								$sender->sendMessage("§cannée/mois/jour/heure/minutes/seconde");
							}
							$sender->sendMessage("§c/mute joueur 1 année/mois/jour/heure/minutes/seconde raison");
						}else{
							if(is_numeric($args[1])){
								$reason = implode(' ', array_slice($args, 3));
								MuteUtils::setMute($t->getName(), $args[1], $args[2], $reason);
								$time = MuteUtils::getTimes($t->getName());
								$raison = MuteUtils::getMuteReason($t->getName());
								$t->sendMessage("§cVous avez été mute par ". $sender->getName(). " pendant ". $time . " pour la raison ". $raison);
								WebhookUtils::Mute("Mute de " .$t->getName()  ." de ". $args[1] ." ".$args[2] . " de la part de ".$sender->getName() . " pour la raison ". "$args[3]");
							}else{
								$sender->sendMessage("§cil faut que se soit en chiffre");
							}
						}
					}
				}
			}
			}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}