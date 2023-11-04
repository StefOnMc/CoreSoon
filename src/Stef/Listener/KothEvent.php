<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use Stef\Utils\KothUtils;

class KothEvent implements Listener
{
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		if(KothUtils::isStarted() === true){
			KothUtils::$bar->addPlayer($player);
		}
	}
	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();

			KothUtils::$bar->removePlayer($player);

	}
}