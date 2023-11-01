<?php

namespace Stef\Command\Joueur;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Msg extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("msg.use");
}
	public function execute(CommandSender $sender, string $commandLabel, array $args): void
	{
		if(strtolower($commandLabel) === "msg" && count($args) >= 2 && $sender instanceof Player) {
			$receiver = Base::getInstance()->getServer()->getPlayerExact($args[0]);
			if($receiver instanceof Player) {
				$message = implode(" ", array_slice($args, 1));
				$sender->sendMessage("Envoyé à " . $receiver->getName() . ": " . $message);
				$receiver->sendMessage("Reçu de " . $sender->getName() . ": " . $message);
				foreach(Base::getInstance()->getServer()->getOnlinePlayers() as $player) {
					if($player instanceof Player){
						if($player->hasPermission("msg.admin")) {
							$player->sendMessage($sender->getName() . "§2 à envoyé un message privé à §6" . $receiver->getName() . "§r: " . "§c" . $message);
						}
					}
				}

			} else {
				$sender->sendMessage("§cJoueur introuvable.");
			}
		}
	}

}