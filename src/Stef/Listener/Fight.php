<?php

namespace Stef\Listener;

use onebone\economyapi\EconomyAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\CommandEvent;
use pocketmine\player\Player;
use pocketmine\world\Position;
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
	public function onDamage(EntityDamageByEntityEvent $event): void
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
	public function death(PlayerDeathEvent $e)
	{
		$p = $e->getPlayer();
		$cause = $p->getLastDamageCause();
		$c = $p->getLastDamageCause()->getCause();
		if($c === EntityDamageEvent::CAUSE_FALL){
			Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName(). " C'est cassé les jambes.");
		}
		if($c === EntityDamageEvent::CAUSE_DROWNING){
			Base::getInstance()->getServer()->broadcastMessage("§c".$p->getName(). " N'avait plus de respiration.");
		}
		$e->setDeathMessage("");
		$e->setDeathScreenMessage("Appuie sur résucité :) ");
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
	public function onQuit(PlayerQuitEvent $event): void
	{
		$player = $event->getPlayer();
		if (!isset(Base::$pc[$player->getName()])) return;
		if (!$this->quit) return;
		$player->kill();
	}


	public function OnCommand(CommandEvent $e): void
	{
		$p = $e->getSender();
		if (!isset(Base::$pc[$p->getName()])) return;
		if($this->allcmd){
			$e->cancel();
			$p->sendMessage("§c Les commande sont banni pendant le combat.");
		}

	}


}