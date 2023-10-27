<?php

namespace Stef\Command\Joueur;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Base;

class Spawn extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("spawn.use");
}

public function execute(CommandSender $sender, string $commandLabel, array $args): void
{
	if($sender instanceof Player){
		$sender->sendMessage("§aVous avez été téleporté au spawn.");
		$sender->teleport(new Position(9,5,9,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
	}
}
}