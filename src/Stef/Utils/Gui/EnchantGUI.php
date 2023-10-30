<?php

namespace Stef\Utils\Gui;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\inventory\Inventory;
use pocketmine\item\Armor;
use pocketmine\item\Axe;
use pocketmine\item\Durable;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\Pickaxe;
use pocketmine\item\Shovel;
use pocketmine\item\Sword;
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
			$c = $p->getInventory()->getItemInHand();
			if ($i === VanillaItems::WOODEN_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}

			}
			if ($i === VanillaItems::STONE_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}
			}

			if ($i === VanillaItems::IRON_SHOVEL()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}
			}
            // Unbreaking
			if ($i === VanillaItems::DIAMOND_AXE()->getTypeId()) {
				self::SendAxeEnchantement($enchant);
			}
			if ($i === VanillaItems::WOODEN_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor || $c instanceof Pickaxe || $c instanceof  Axe || $c instanceof Shovel || $c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}
			}
			if ($i === VanillaItems::STONE_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor || $c instanceof Pickaxe || $c instanceof  Axe || $c instanceof Shovel || $c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}
			}

			if ($i === VanillaItems::IRON_AXE()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Armor || $c instanceof Pickaxe || $c instanceof  Axe || $c instanceof Shovel || $c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block ou autre item.");
					}
				}
			}
			// Sharpness
			if ($i === VanillaItems::DIAMOND_SWORD()->getTypeId()) {
				self::SendSharpnessEnchantement($enchant);
			}
			if ($i === VanillaItems::WOODEN_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 1))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
			}
			if ($i === VanillaItems::STONE_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 2))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
			}

			if ($i === VanillaItems::IRON_SWORD()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 3))->getTypeId()) {
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Sword){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
			}
			// Pickaxe
			if ($i === VanillaItems::DIAMOND_PICKAXE()->getTypeId()) {
				self::SendEfficiencyEnchantement($enchant);
			}
			if($i === VanillaItems::WOODEN_PICKAXE()){
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Pickaxe || $c instanceof Shovel){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
			}
			if($i === VanillaItems::STONE_PICKAXE()){
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Pickaxe || $c instanceof Shovel){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
			}
			if($i === VanillaItems::IRON_PICKAXE()){
				if($p->getInventory()->getItemInHand()->hasEnchantment(VanillaEnchantments::PROTECTION(),1)){
					$p->sendMessage("§cVous avez déja le méme enchantement.");
				}else{
					if($c instanceof Pickaxe || $c instanceof Shovel){
						if(EconomyAPI::getInstance()->myMoney($p) >= 1001){
							$p->sendMessage("test");
							$e = $p->getInventory()->getItemInHand()->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
							$p->getInventory()->setItemInHand($e);
							$enchant->onClose($p);
							EconomyAPI::getInstance()->reduceMoney($p,1001);
						}else{
							$p->sendMessage("sa marche pas ta pas de tune");
							$enchant->onClose($p);
						}
					}else{
						$p->sendMessage("§cImposible d'enchanter un block.");
					}
				}
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
