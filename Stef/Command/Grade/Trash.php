<?php

namespace Stef\Command\Grade;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\item\VanillaItems;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

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
			$poubelsh->getInventory()->setItem(15,VanillaItems::COMPASS()->setCustomName("§cConfirmé la suprésion."));
		$poubelsh->setListener(function (InvMenuTransaction $transaction) use ($poubelsh,$sender): InvMenuTransactionResult {
if($transaction->getItemClicked()->getTypeId() === VanillaItems::COMPASS()->getTypeId()){
	$poubelsh->getInventory()->clearAll();
	$poubelsh->getInventory()->setItem(15,VanillaItems::COMPASS()->setCustomName("§aSupression réussi."));
	$poubelsh->onClose($sender);
	return $transaction->discard();
}
			return $transaction->continue();
		});
			$poubelsh->send($sender);
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}