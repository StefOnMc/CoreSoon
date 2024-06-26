<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;
use Stef\Base;

class Arrivage implements Listener
{

	/**
	 * @throws \JsonException
	 */
	public function Join(PlayerJoinEvent $e): void
	{
		$p = $e->getPlayer();
		$ps = $p->getName();
		$e->setJoinMessage("");
		if($p->hasPlayedBefore()){
Base::getInstance()->getServer()->broadcastPopup("§a+ $ps +");
		}else{
			$playerc = new Config(Base::getInstance()->getServer()->getDataPath(). "count.json", Config::JSON);
			$playerCount = count($playerc->getAll());
			$playerCount++;
			$playerc->set($playerCount);
			$playerc->save();
			Base::getInstance()->getServer()->broadcastMessage($ps . " Vien de rejoindre la premiere fois, il et le ". $playerCount . " eme inscrit");
		}

	}



	public function Leave(PlayerQuitEvent $e): void
	{
		$e->setQuitMessage("");
		Base::getInstance()->getServer()->broadcastPopup("§c- ". $e->getPlayer()->getName(). " -");
	}
}