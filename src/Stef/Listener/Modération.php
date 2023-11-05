<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use Stef\Base;
use Stef\Utils\BanUtils;
use Stef\Utils\MuteUtils;

class Modération implements Listener
{
public function chat(PlayerChatEvent $e){
	$p = $e->getPlayer();
	$ps = $p->getName();
	if(MuteUtils::hasMute($ps)){
		$e->cancel();
		$time = MuteUtils::getTimes($ps);
		$raison = MuteUtils::getMuteReason($ps);
		$p->sendMessage("Tu es mute encore ".$time . " raison: ".$raison);
	}
}
public function prelogin(PlayerPreLoginEvent $e){
	$ps = $e->getPlayerInfo()->getUsername();
	if(BanUtils::hasBan($ps)){
		$time = BanUtils::getTimes($e->getPlayerInfo()->getUsername());
		$raison = BanUtils::getBanReason($e->getPlayerInfo()->getUsername());
		$e->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_PLUGIN,"Vous êtes encore ban pendant ". $time . " raison: ". $raison);
	}
	if(Base::getInstance()->getServer()->getNetwork()->getValidConnectionCount() > Base::getInstance()->getServer()->getMaxPlayers()){
		$e->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_PLUGIN, "le serveur et plein.");
	}
	if(!Base::getInstance()->getServer()->isWhitelisted($e->getPlayerInfo()->getUsername())){
		$e->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_PLUGIN, "Le serveur et sous whitelist.");
	}
}
}