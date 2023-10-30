<?php

namespace Stef\Command\Joueur;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\block\StainedGlass;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\color\Color;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\KitUtils;

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
	$kit->getInventory()->setItem(0,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(1,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(9,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(7,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(8,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(17,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(36,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(45,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(46,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(44,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(52,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(53,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(11,VanillaItems::BLEACH()->setCustomName("Kit §7Joueur"));
	$kit->getInventory()->setItem(12,VanillaItems::COPPER_INGOT()->setCustomName("Kit §cOutils"));
	$kit->getInventory()->setItem(13,VanillaItems::COMPASS()->setCustomName("Grade 1"));
	$kit->getInventory()->setItem(14,VanillaItems::AMETHYST_SHARD()->setCustomName("Grade 2"));
	$kit->getInventory()->setItem(15,VanillaItems::GOLDEN_CARROT()->setCustomName("Grade 3"));
	$kit->getInventory()->setItem(16,VanillaItems::RAW_GOLD()->setCustomName("Grade 4"));
	$kit->getInventory()->setItem(18,VanillaItems::BONE()->setCustomName("Grade 5"));;
	$kit->getInventory()->setItem(20,VanillaItems::BRICK()->setCustomName("Kit §eStar"));
	$kit->getInventory()->setItem(21,VanillaItems::ARROW()->setCustomName("Kit §cYou§rtube"));
	$kit->getInventory()->setItem(22,VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->setCustomName("Kit §6Premium"));
	$kit->setListener(function (InvMenuTransaction $transaction) use ($sender,$kit): InvMenuTransactionResult {
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BLEACH()->getTypeId()){
			$sender->sendMessage("§aVous avez bien claim le kit §7Joueur");
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BRICK()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					KitUtils::setCooldown($sender->getName(),6,"heure","star");
					$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					// item
				}
				$kit->onClose($sender);
				$transaction->discard();
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::ARROW()->getTypeId()){
			if($sender->hasPermission("kit.youtube")){
				if(KitUtils::hasCooldown($sender->getName(),"yt")){
					$temps = KitUtils::getTime($sender->getName(),"yt");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					KitUtils::setCooldown($sender->getName(),6,"heure","yt");
					$sender->sendMessage("§aVous avez bien claim le kit §cYou§rtube");
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->getTypeId()){
			$sender->sendMessage("§aVous avez bien claim le kit §6Premium");
			$kit->onClose($sender);
		}
		return $transaction->discard();
	});
	$kit->send($sender);
}
}
}