<?php

namespace Stef\Command\Grade;

use muqsit\invmenu\InvMenu;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class Trash extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("trash.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("trash.use")){
			$poubelsh = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
			$poubelsh->setName("§c - §aPoubelle de ". $sender->getName()." §c-");
			$poubelsh->send($sender);
		}
	}
}
}