<?php

namespace Stef\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class Nexus implements Listener
{
	public static $name = [];
	public function EntityDamageByEntityEvent(EntityDamageByEntityEvent $event) {
		$nexus = $event->getEntity();

		if ($nexus instanceof \Stef\Entity\Nexus) {
			$damager = $event->getDamager();

				if ($damager instanceof Player) {
					$event->cancel();
					$currentHealth = $nexus->getHealth();
					$nexus->setHealth($currentHealth - 1);
					self::$name = [$damager->getName()];
					if ($nexus->getHealth() < 0) {
						$nexus->setHealth(0);
					}
					$nexus->setNameTag("Nexus (" . $nexus->getHealth() . "/2500 )");
			}
		}
	}


}