<?php

namespace Stef\Utils\Gui;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class EnchantGUI
{
	// a débuger
	public static function SendShop(Player $p)
	{
		$enchant = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
		$enchant->setName("§6- §eEnchant §6-");
		$enchant->getInventory()->setItem(14, VanillaItems::DIAMOND_HELMET()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION()))->setLore(["§bEnchantement disponible:§r \n Protection 1 §e20$ §r \n Protection 2 §e240$ §r\n Protection 3 §e250$ §r"]));
		$enchant->getInventory()->setItem(15, VanillaItems::DIAMOND_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
		$enchant->getInventory()->setItem(16, VanillaItems::DIAMOND_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS())));
		$enchant->getInventory()->setItem(17, VanillaItems::DIAMOND_PICKAXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY())));
		$enchant->setListener(function (InvMenuTransaction $transaction) use ($p, $enchant): InvMenuTransactionResult {
			$i = $transaction->getItemClicked()->getTypeId();
			// Protection
			if ($i === VanillaItems::DIAMOND_HELMET()->getTypeId()) {
				self::SendHeldEnchantement($enchant);
			}
			if ($i === VanillaItems::WOODEN_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement protection 1.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
			if ($i === VanillaItems::STONE_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),2)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement protection 2.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}

			if ($i === VanillaItems::IRON_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),3)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement protection 3.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
            // Unbreaking
			if ($i === VanillaItems::DIAMOND_AXE()->getTypeId()) {
				self::SendAxeEnchantement($enchant);
			}
			if ($i === VanillaItems::WOODEN_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::UNBREAKING(),1)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement solidité 1.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
			if ($i === VanillaItems::STONE_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::UNBREAKING(),2)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement solidité 2.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 2));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}

			if ($i === VanillaItems::IRON_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::UNBREAKING(),3)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement solidité 3.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
			// Sharpness
			if ($i === VanillaItems::DIAMOND_SWORD()->getTypeId()) {
				self::SendSharpnessEnchantement($enchant);
			}
			if ($i === VanillaItems::WOODEN_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::SHARPNESS(),1)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement tranchant 1.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
			if ($i === VanillaItems::STONE_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::SHARPNESS(),2)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement tranchant 2.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}

			if ($i === VanillaItems::IRON_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::SHARPNESS(),3)){
					$p->sendMessage("§cVous ne pouvez pas vous enchanter car vous avez déja l'enchantement tranchant 3.");
					$enchant->onClose($p);
				}else{
					if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
						$p->sendMessage("test");
						$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 3));
						$p->getInventory()->setItemInHand($e);
						$enchant->onClose($p);
					}else{
						$p->sendMessage("sa marche pas ta pas de tune");
						$enchant->onClose($p);
					}
				}
			}
			// Pickaxe
			if ($i === VanillaItems::DIAMOND_PICKAXE()->getTypeId()) {
				self::SendEfficiencyEnchantement($enchant);
			}
			return $transaction->discard();
		});
		$enchant->send($p);
	}
	private static function SendHeldEnchantement(InvMenu $enchant){
		$enchant->getInventory()->clearAll();
		$enchant->getInventory()->setItem(14, VanillaItems::WOODEN_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1))->setLore(["Protection 1 §e230$ "]));
		$enchant->getInventory()->setItem(15, VanillaItems::STONE_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2))->setLore(["Protection 2 §e230$ "]));
		$enchant->getInventory()->setItem(16, VanillaItems::IRON_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3))->setLore(["Protection 3 §e230$ "]));
	}
	private static function SendAxeEnchantement(InvMenu $enchant){
		$enchant->getInventory()->clearAll();
		$enchant->getInventory()->setItem(14, VanillaItems::WOODEN_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1))->setLore(["Solidité 1 §e230$ "]));
		$enchant->getInventory()->setItem(15, VanillaItems::STONE_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 2))->setLore(["Solidité 2 §e230$ "]));
		$enchant->getInventory()->setItem(16, VanillaItems::IRON_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3))->setLore(["Solidité 3 §e230$ "]));

	}
	private static function SendSharpnessEnchantement(InvMenu $enchant){

		$enchant->getInventory()->clearAll();
		$enchant->getInventory()->setItem(14, VanillaItems::WOODEN_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1))->setLore(["Tranchant 1 §e230$ "]));
		$enchant->getInventory()->setItem(15, VanillaItems::STONE_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 2))->setLore(["Tranchant 2 §e230$ "]));
		$enchant->getInventory()->setItem(16, VanillaItems::IRON_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 3))->setLore(["Tranchant 3 §e230$ "]));

	}
	private static function SendEfficiencyEnchantement(InvMenu $enchant){
		$enchant->getInventory()->clearAll();
		$enchant->getInventory()->setItem(14, VanillaItems::WOODEN_PICKAXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), 1))->setLore(["éficacité 1 §e230$ "]));
		$enchant->getInventory()->setItem(15, VanillaItems::STONE_PICKAXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), 2))->setLore(["éficacité 2 §e230$ "]));
		$enchant->getInventory()->setItem(16, VanillaItems::IRON_PICKAXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), 3))->setLore(["éficacité 3 §e230$ "]));

	}
}
