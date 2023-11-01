<?php

namespace Stef\Command\Joueur;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Utils\Gui\EnchantGUI;

class Eshop extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("eshop.use");
}

public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->getInventory()->getItemInHand()->isNull()){
			$sender->sendMessage("§cIl te faut un item dans ta main.");
		}else{
			EnchantGUI::SendShop($sender);
		}
	}
}
}