<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemOnEntityTransactionData;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use Stef\Base;
use Stef\Utils\CpsUtils;
use Stef\Utils\WebhookUtils;

class Cps implements Listener
{
	public function onDisconnect(PlayerQuitEvent $event){
		unset(CpsUtils::$cps[$event->getPlayer()->getName()]);
	}

	public function onDataPacketReceive(DataPacketReceiveEvent $event){
		$packet = $event->getPacket();

		if($packet instanceof LevelSoundEventPacket){
			if($packet->sound === LevelSoundEvent::ATTACK_NODAMAGE){
				CpsUtils::addCPS($event->getOrigin()->getPlayer());
				if(CpsUtils::getCPS($event->getOrigin()->getPlayer()) >= 20){
					$players = Base::getInstance()->getServer()->getOnlinePlayers();
					if(!CpsUtils::hasCooldown($event->getOrigin()->getPlayer())){
						CpsUtils::updateCooldown($event->getOrigin()->getPlayer());
						WebhookUtils::Cps($event->getOrigin()->getPlayer()->getName() . " fait ". CpsUtils::getCPS($event->getOrigin()->getPlayer()) . " cps");
						foreach($players as $playerName){
							if($playerName->hasPermission("cps.use")){
								$playerName->sendMessage($event->getOrigin()->getPlayer()->getName() . " fait ". CpsUtils::getCPS($event->getOrigin()->getPlayer()) . " cps");
							}
						}
					}
				}
			}
		}
		if($packet instanceof InventoryTransactionPacket){
			if($packet->trData instanceof UseItemOnEntityTransactionData){
				CpsUtils::addCPS($event->getOrigin()->getPlayer());
				if(CpsUtils::getCPS($event->getOrigin()->getPlayer()) >= 20){
					$players = Base::getInstance()->getServer()->getOnlinePlayers();

					if(!CpsUtils::hasCooldown($event->getOrigin()->getPlayer())){
						CpsUtils::updateCooldown($event->getOrigin()->getPlayer());
						WebhookUtils::Cps($event->getOrigin()->getPlayer()->getName() . " fait ". CpsUtils::getCPS($event->getOrigin()->getPlayer()) . " cps");
						foreach($players as $playerName){
							if($playerName->hasPermission("cps.use")){
								$playerName->sendMessage($event->getOrigin()->getPlayer()->getName() . " fait ". CpsUtils::getCPS($event->getOrigin()->getPlayer()) . " cps");
							}
						}
					}
				}
			}
			if(CpsUtils::getCPS($event->getOrigin()->getPlayer()) > 21){
				$event->cancel();
			}
		}
	}

}