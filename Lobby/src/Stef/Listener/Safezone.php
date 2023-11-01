<?php

namespace Stef\Listener;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Loader;

class Safezone implements Listener
{
public function Secure(PlayerItemUseEvent $e){
	$i = $e->getItem()->getTypeId();
	if($i === VanillaItems::FLINT_AND_STEEL()->getTypeId()){
		$e->cancel();
	}
}
public function Place(BlockPlaceEvent $e){
	$p = $e->getPlayer();
	if($p->hasPermission(Loader::getInstance()->getConfig()->getNested("Perm.BlockPlace"))){

	}else{
		$e->cancel();
		$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Denied.no-place"));
	}
}
public function Break(BlockBreakEvent $e){
	$p = $e->getPlayer();
	if($p->hasPermission(Loader::getInstance()->getConfig()->getNested("Perm.BlockBreak"))){

	}else{
		$e->cancel();
		$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Denied.no-break"));
	}
}
public function Void(EntityDamageEvent $e){
	$p = $e->getEntity();
	$e->cancel();
	if($p instanceof Player){
		if($e->getCause() === EntityDamageEvent::CAUSE_VOID){
			$e->cancel();
			$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Denied.no-void"));
			$p->teleport(new Position(Loader::getInstance()->getConfig()->getNested("Spawn.X"),Loader::getInstance()->getConfig()->getNested("Spawn.Y"),Loader::getInstance()->getConfig()->getNested("Spawn.Z"),Loader::getInstance()->getServer()->getWorldManager()->getWorldByName(Loader::getInstance()->getConfig()->getNested("Spawn.World"))));
		}
	}
}
public function Drop(PlayerDropItemEvent $e){
	$p = $e->getPlayer();
	$e->cancel();
	$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Denied.no-drop"));
}
public function Pvp(EntityDamageByEntityEvent $e){
	$p = $e->getDamager();
	if($p instanceof Player){
		$e->cancel();
		$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Denied.pvp"));
	}
}
}