<?php

namespace Stef\Utils\Gui;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\utils\MobHeadType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use Stef\Base;

class DevGUI
{
	private static bool $wl = false;
public static function Send(Player $p){
	$dev = InvMenu::create(InvMenu::TYPE_CHEST);
	$dev->setName("§c - §9French§r-§cDev -");
	$dev->getInventory()->setItem(1,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::BLUE())->asItem());
	$dev->getInventory()->setItem(9,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::BLUE())->asItem());
	$dev->getInventory()->setItem(0,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::BLUE())->asItem());
	$dev->getInventory()->setItem(7,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::RED())->asItem());
	$dev->getInventory()->setItem(8,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::RED())->asItem());
	$dev->getInventory()->setItem(17,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::RED())->asItem());
	$dev->getInventory()->setItem(21,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::WHITE())->asItem());
	$dev->getInventory()->setItem(22,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::WHITE())->asItem());
	$dev->getInventory()->setItem(23,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::WHITE())->asItem());
	$dev->getInventory()->setItem(10,VanillaItems::COMPASS()->setCustomName("§6- §cServeur §6-"));
	$dev->getInventory()->setItem(13,VanillaItems::DIAMOND_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(),10))->setCustomName("§o§cRestart")->setLore(["§ctqt sa va pas exploser le serveur."]));
	$dev->getInventory()->setItem(16,VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem()->setCustomName("§6- §aJoueur §6-"));
	$dev->getInventory()->setItem(12,VanillaItems::GOLDEN_SWORD()->setCustomName("§7- §7Whitelist §7-"));
	$dev->setListener(function (InvMenuTransaction $transaction) use ($dev): InvMenuTransactionResult {
		$i = $transaction->getItemClicked()->getTypeId();
		$p = $transaction->getPlayer();
		if($i === VanillaItems::COMPASS()->getTypeId()){
			$dev->onClose($p);
			Base::getInstance()->getServer()->dispatchCommand($p,"stats server");
		}
		if($i === VanillaItems::DIAMOND_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(),10))->getTypeId()){
			$dev->onClose($p);
			Base::getInstance()->getServer()->dispatchCommand($p,"restart");
		}
		if($i === VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem()->getTypeId()){
			$dev->onClose($p);
			Base::getInstance()->getServer()->dispatchCommand($p,"stats player");
		}
		if($i === VanillaItems::GOLDEN_SWORD()->getTypeId()){
			$dev->onClose($p);
			if(self::$wl === false){
				self::$wl = true;
				$p->sendMessage("§aWhitelist activé");
				Base::getInstance()->getServer()->dispatchCommand($p,"whitelist on");
				foreach (Base::getInstance()->getServer()->getOnlinePlayers() as $s){
					if(Base::getInstance()->getServer()->isOp($s->getName())){
					}else{
						$s->kick("Liste blanche activé");
					}
				}
			}else{
				self::$wl = false;
				$p->sendMessage("§cWhitelist désactivé");
				Base::getInstance()->getServer()->dispatchCommand($p,"whitelist off");
			}
		}

		return $transaction->discard();
	});
	$dev->send($p);
}
}