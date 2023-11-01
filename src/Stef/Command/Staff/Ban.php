<?php

namespace Stef\Command\Staff;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\BanUtils;
use Stef\Utils\MuteUtils;
use Stef\Utils\WebhookUtils;

class Ban extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("ban.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if($sender instanceof Player){
			if($sender->hasPermission("ban.use")){
				if(empty($args[0])){
					$sender->sendMessage("§c/ban joueur 1 année/mois/jour/heure/minutes/seconde raison");
				}else{
					$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
					if($t === null){
						$sender->sendMessage("§cLe joueur spécifié et hors ligne.");
					}else{
						if(BanUtils::hasBan($t->getName())){
							$sender->sendMessage($t->getName() . " et déja ban.");
						}else{
							if(empty($args[0]) ||empty($args[1]) ||empty($args[2]) || empty($args[3])){
								if(empty($args[2])){
									$sender->sendMessage("§cannée/mois/jour/heure/minutes/seconde");
								}
								$sender->sendMessage("§c/ban joueur 1 année/mois/jour/heure/minutes/seconde raison");
							}else{
								if(is_numeric($args[1])){
									$reason = implode(' ', array_slice($args, 3));
									BanUtils::setBan($t->getName(), $args[1], $args[2], $reason);
									$time = BanUtils::getTimes($t->getName());
									$raison = BanUtils::getBanReason($t->getName());
									$t->kick("§cVous avez été ban par ". $sender->getName(). " pendant ". $time . " pour la raison ". $raison);
									WebhookUtils::Ban("Ban de " .$t->getName()  ." de ". $args[1] ." ".$args[2] . " de la part de ".$sender->getName() . " pour la raison ". "$args[3]");
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