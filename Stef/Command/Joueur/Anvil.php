<?php

namespace Stef\Command\Joueur;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\item\Durable;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class Anvil extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("anvil.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
	//	if ($sender instanceof Player) {
//self::SendAnvil($sender);
//		}
	}

	public static function SendAnvil(Player $sender)
	{
		$player = $sender;
		$item = $player->getInventory()->getItemInHand();


		if (empty($args)) {
			if ($item->isNull()) {
				$sender->sendMessage("§cT'es main sont vide.");
				return true;
			}

			if ($item instanceof Durable) {

				$item->setDamage(0);
				$player->getInventory()->setItemInHand($item);
				$sender->sendMessage("§aVotre item à bien été réparé.");
			} else {
				$sender->sendMessage("§cLes blocks ne sont pas permis .");
			}
		}


		return true;
	}
}