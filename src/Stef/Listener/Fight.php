<?php

namespace Stef\Listener;

use onebone\economyapi\EconomyAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\CommandEvent;
use pocketmine\player\Player;
use Stef\Base;

class Fight implements Listener
{
private bool $allcmd = true;

	private int $time = 30;
	private bool $quit = true;

	// code d'un plugin
	/**
	 * @priority HIGHEST
	 */
	private function onDamage(EntityDamageByEntityEvent $event): void
	{
		$player = $event->getEntity();
		$damager = $event->getDamager();

		if ($event->isCancelled()) return;
		if (!$player instanceof Player || !$damager instanceof Player) return;
		if ($player->isCreative() || $damager->isCreative()) return;
		foreach ([$player, $damager] as $player)
		{
			if (!isset(Base::$pc[$player->getName()]))
			{
				$player->sendMessage("§aVous êtes en combat.");
				$player->sendMessage("§c La déconexion et pas authorisé sous peine de perte de l'inventaire .");
			}
			Base::$pc[$player->getName()] = $this->time;
		}
	}

	private function death(PlayerDeathEvent $e)
	{
		$p = $e->getPlayer();
		$cause = $p->getLastDamageCause();
		Base::$back[$e->getPlayer()->getName()] = $e->getPlayer()->getPosition();
		if ($cause instanceof EntityDamageByEntityEvent) {
			$damager = $cause->getDamager();
			if ($damager instanceof Player) {
$luck = mt_rand(1,75);
$damager->sendMessage("§aTu vien de gagnez ".$luck."$ en tuant ". $p->getName());
EconomyAPI::getInstance()->addMoney($damager,$luck);
				Base::getInstance()->getServer()->broadcastMessage($p->getName() . " Vien de perdre contre  " . $damager->getName() . " avec l'item " . $damager->getInventory()->getItemInHand()->getName());
			}
		}
	}
	private function skip(EntityDamageEvent $e){
		if($e->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK){

		}
	}
	private function onQuit(PlayerQuitEvent $event): void
	{
		$player = $event->getPlayer();
		if (!isset(Base::$pc[$player->getName()])) return;
		if (!$this->quit) return;
		$player->kill();
	}


	private function OnCommand(CommandEvent $e): void
	{
		$p = $e->getSender();
		if (!isset(Base::$pc[$p->getName()])) return;
		if($this->allcmd){
			$e->cancel();
			$p->sendMessage("§c Les commande sont banni pendant le combat.");
		}

	}


}