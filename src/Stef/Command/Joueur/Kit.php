<?php

namespace Stef\Command\Joueur;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Base;

class Kit extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("kit.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
{
if($sender instanceof Player){
	$kit = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	$kit->setName("§c- §bKit §c-");
	$kit->getInventory()->setItem(4,VanillaItems::BLEACH()->setCustomName("Kit §7Joueur"));
	$kit->getInventory()->setItem(5,VanillaItems::COPPER_INGOT()->setCustomName("Kit §cOutils"));
	$kit->getInventory()->setItem(6,VanillaItems::COMPASS()->setCustomName("Grade 1"));
	$kit->getInventory()->setItem(7,VanillaItems::AMETHYST_SHARD()->setCustomName("Grade 2"));
	$kit->getInventory()->setItem(8,VanillaItems::GOLDEN_CARROT()->setCustomName("Grade 3"));
	$kit->getInventory()->setItem(9,VanillaItems::RAW_GOLD()->setCustomName("Grade 4"));
	$kit->getInventory()->setItem(10,VanillaItems::BONE()->setCustomName("Grade 5"));;
	$kit->getInventory()->setItem(11,VanillaItems::BRICK()->setCustomName("Kit §eStar"));
	$kit->getInventory()->setItem(12,VanillaItems::ARROW()->setCustomName("Kit §cYou§rtube"));
	$kit->getInventory()->setItem(13,VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->setCustomName("Kit §6Premium"));
	$kit->setListener(function (InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult {

		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BRICK()->getTypeId()){
			$sender->sendMessage("§aVous avez bien claim le kit §eStar");
			$transaction->discard();
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::ARROW()->getTypeId()){
			$sender->sendMessage("§aVous avez bien claim le kit §cYou§rtube");
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->getTypeId()){
			$sender->sendMessage("§aVous avez bien claim le kit §6Premium");
		}
		return $transaction->discard();
	});
	$kit->send($sender);
}
}
}