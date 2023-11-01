<?php

namespace Stef\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Base;

class Death implements Listener
{
public function Customdeath(PlayerDeathEvent $e){
	$p = $e->getPlayer();
	$c = $p->getLastDamageCause()->getCause();
	if($c === EntityDamageEvent::CAUSE_FALL){
		Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName(). " c'est cassé les jambes.");
	}
	if($c === EntityDamageEvent::CAUSE_DROWNING){
		Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName(). " n'avait plus de respiration.");
	}
	if($c === EntityDamageEvent::CAUSE_FALLING_BLOCK){
		Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName(). " c'est écrasé fatalement dans un block.");
	}
}

public function Death(EntityDamageEvent $e){
	$p = $e->getEntity();
	$c = $e->getCause();
	if($p instanceof Player){
		if($c === EntityDamageEvent::CAUSE_VOID){
			$p->teleport(new Position(9,80,90,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
			$p->sendMessage("§aVous avez esseyer de sauté dans le void.");
			Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName() . " a sauté dans le vide.");

		}
	}
}
}