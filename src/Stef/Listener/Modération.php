<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use Stef\Utils\BanUtils;
use Stef\Utils\MuteUtils;

class Modération implements Listener
{
private function chat(PlayerChatEvent $e){
	$p = $e->getPlayer();
	$ps = $p->getName();
	if(MuteUtils::hasMute($ps)){
		$e->cancel();
		$time = MuteUtils::getTimes($ps);
		$raison = MuteUtils::getMuteReason($ps);
		$p->sendMessage("Tu es mute encore ".$time . " raison: ".$raison);
	}
}
private function prelogin(PlayerPreLoginEvent $e){
	$ps = $e->getPlayerInfo()->getUsername();
	if(BanUtils::hasBan($ps)){
		$time = BanUtils::getTimes($e->getPlayerInfo()->getUsername());
		$raison = BanUtils::getBanReason($e->getPlayerInfo()->getUsername());
		$e->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_PLUGIN,"Vous êtes encore ban pendant ". $time . " raison: ". $raison);
	}
}
}