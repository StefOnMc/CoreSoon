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
use pocketmine\world\World;
use Stef\Base;
use Stef\Utils\BanUtils;
use Stef\Utils\MuteUtils;

class DevGUI
{

	private static bool $wl = false;
	public static bool $day = false;
	private static int $pageban = 1;
	private static int $pagemute = 1;
public static function Send(Player $p){
	$dev = InvMenu::create(InvMenu::TYPE_CHEST);
	$dev->setName("§c - §9French§r§f-§cDev -");
	$MuteList = MuteUtils::getMutedPlayers();
	$banList = BanUtils::getBannedPlayers();
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
	$dev->getInventory()->setItem(16,VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::DRAGON())->asItem()->setCustomName("§6- §aJoueur §6-"));
	$dev->getInventory()->setItem(2,VanillaItems::POTION()->setCustomName("§6- §cListe des joueurs banni §6-")->setLore(["Joueur actuelement banni: \n". count($banList)]));
	$dev->getInventory()->setItem(6,VanillaItems::ENDER_PEARL()->setCustomName("§6- §cListe des joueurs mutes §6-")->setLore(["Joueur actuelement mute: \n". count($MuteList)]));
	if(self::$wl === true){
		$dev->getInventory()->setItem(12,VanillaItems::GOLDEN_SWORD()->setCustomName("§7- §r§fWhitelist §7-")->setLore(["§3Status: §aActivé."]));
	}else{
		$dev->getInventory()->setItem(12,VanillaItems::GOLDEN_SWORD()->setCustomName("§7- §r§fWhitelist §7-")->setLore(["§3Status: §cDésactivé."]));
	}
	if(self::$day === true){
		$dev->getInventory()->setItem(14,VanillaItems::CLOCK()->setCustomName("§6- §cTemps §6-")->setLore(["§3Status: §aLifetime"]));
	}else{
		$dev->getInventory()->setItem(14,VanillaItems::CLOCK()->setCustomName("§6- §cTemps §6-")->setLore(["§3Status: §cNormal"]));
	}
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
		if($i === VanillaItems::CLOCK()->getTypeId()){
			if(self::$day === false){
				self::$day = true;
				$dev->onClose($p);
				$p->sendMessage("§aLifetime activé.");
				foreach(Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $w){
					$w->setTime(World::TIME_DAY);
					$w->stopTime();
				}
			}else{
				self::$day = false;
				$dev->onClose($p);
				$p->sendMessage("§cJour activé.");
				foreach(Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $w){
					$w->startTime();
				}
			}
		}

		if($i ===  VanillaItems::ENDER_PEARL()->getTypeId()){
		self::SendPageMute($dev);
		}
		if($i ===  VanillaItems::POTION()->getTypeId()){
			self::SendPageBan($dev);
		}
		if ($i === VanillaItems::COPPER_INGOT()->getTypeId()) {
			self::SendNextPageBan($dev);

		}
		if ($i === VanillaItems::IRON_INGOT()->getTypeId()) {
		self::SendOldPageBan($dev);
		}
		if ($i === VanillaItems::GOLD_INGOT()->getTypeId()) {
			self::SendNextPageMute($dev);
		}
		if ($i === VanillaItems::NETHERITE_INGOT()->getTypeId()) {
			self::SendOldPageMute($dev);
		}

		return $transaction->discard();
	});
	$dev->send($p);
}
	private static function SendNextPageBan(InvMenu $dev) {
		self::$pageban++;
		self::SendPageBan($dev);
	}

	private static function SendOldPageBan(InvMenu $dev) {
		if (self::$pageban > 1) {
			self::$pageban--;
			self::SendPageBan($dev);
		}
	}
	private static function SendPageBan(InvMenu $dev){
		$banList = BanUtils::getBannedPlayers();
		$itemsPerPage = 17;
		$startIndex = (self::$pageban - 1) * $itemsPerPage;
		$endIndex = $startIndex + $itemsPerPage;
		$banPlayersItems = [];

		for ($i = $startIndex; $i < $endIndex && $i < count($banList); $i++) {
			$banPlayer = $banList[$i];
			$playerName = $banPlayer;
			$remainingTime = BanUtils::getTimes($playerName);
			$banReason = BanUtils::getBanReason($playerName);
			$customMobHead = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem()->setCustomName($playerName);
			$lore = ["Banni: $playerName", "Temps restant: $remainingTime", "Raison: $banReason"];
			$customMobHead->setLore($lore);

			$banPlayersItems[] = $customMobHead;
		}
		$dev->getInventory()->clearAll();

		$slot = 0;

		foreach ($banPlayersItems as $item) {
			$dev->getInventory()->setItem($slot, $item);
			$slot++;
		}
		$nextPageItem = VanillaItems::COPPER_INGOT()->setCustomName("Page suivante");
		$prevPageItem = VanillaItems::IRON_INGOT()->setCustomName("Page précédente");

		$dev->getInventory()->setItem(24, $nextPageItem);
		$dev->getInventory()->setItem(20, $prevPageItem);
	}
	private static function SendNextPageMute(InvMenu $dev) {
		self::$pagemute++;
		self::SendPageMute($dev);
	}

	private static function SendOldPageMute(InvMenu $dev) {
		if (self::$pagemute > 1) {
			self::$pagemute--;
			self::SendPageMute($dev);
		}
	}
	private static function SendPageMute(InvMenu $dev){
		$MuteList = MuteUtils::getMutedPlayers();
		$itemsPerPage = 17;
		$startIndex = (self::$pagemute - 1) * $itemsPerPage;
		$endIndex = $startIndex + $itemsPerPage;
		$MutePlayersItems = [];

		for ($i = $startIndex; $i < $endIndex && $i < count($MuteList); $i++) {
			$MutePlayer = $MuteList[$i];
			$playerName = $MutePlayer;
			$remainingTime = MuteUtils::getTimes($playerName);
			$muteReason = MuteUtils::getMuteReason($playerName);
			$customMobHead = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem()->setCustomName($playerName);
			$lore = ["Muet: $playerName", "Temps restant: $remainingTime", "Raison: $muteReason"];
			$customMobHead->setLore($lore);

			$MutePlayersItems[] = $customMobHead;
		}
		$dev->getInventory()->clearAll();

		$slot = 0;

		foreach ($MutePlayersItems as $item) {
			$dev->getInventory()->setItem($slot, $item);
			$slot++;
		}
		$nextPageItem = VanillaItems::GOLD_INGOT()->setCustomName("Page suivante");
		$prevPageItem = VanillaItems::NETHERITE_INGOT()->setCustomName("Page précédente");

		$dev->getInventory()->setItem(24, $nextPageItem);
		$dev->getInventory()->setItem(20, $prevPageItem);
	}

}