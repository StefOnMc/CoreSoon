<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\VanillaItems;
use Stef\Loader;
use Stef\Utils\ScoreBoardUtils;

class Welcome implements Listener
{
public function Join(PlayerJoinEvent $e){
	$p = $e->getPlayer();
	$e->setJoinMessage("");
	$inv = $p->getInventory();
	ScoreBoardUtils::
	$inv->clearAll();
	$inv->setItem(Loader::getInstance()->getConfig()->getNested("Inventory.Pearl.Case"),VanillaItems::ENDER_PEARL()->setCustomName(Loader::getInstance()->getConfig()->getNested("Inventory.Pearl.Name")));
	$inv->setItem(Loader::getInstance()->getConfig()->getNested("Inventory.Compass.Case"),VanillaItems::COMPASS()->setCustomName(Loader::getInstance()->getConfig()->getNested("Inventory.Compass.Name")));
	Loader::getInstance()->getServer()->broadcastMessage(Loader::getInstance()->getConfig()->getNested("Welcome.Bvn"));
	$str = str_replace('{player}',$p->getName(),Loader::getInstance()->getConfig()->getNested("Welcome.Join"));
	Loader::getInstance()->getServer()->broadcastPopup($str);
}
public function Quit(PlayerQuitEvent $e){
	$p = $e->getPlayer();
	$e->setQuitMessage("");
	$str = str_replace('{player}',$p->getName(),Loader::getInstance()->getConfig()->getNested("Welcome.Quit"));
	Loader::getInstance()->getServer()->broadcastPopup($str);
}
}