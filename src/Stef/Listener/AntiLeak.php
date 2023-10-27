<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketDecodeEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use Stef\Base;

class AntiLeak implements Listener
{

	private const WHITELIST = [
		ProtocolInfo::LOGIN_PACKET,
	];
	private int $mtu = 1492;
public function query(QueryRegenerateEvent $e): void
{
	$query = $e->getQueryInfo();
	$query->setExtraData(["oe nn evite"]);
		$query->setListPlugins(false);
		$query->setWorld("Soon");
}


	public function Decode(DataPacketDecodeEvent $event): void
	{
		if (strlen($event->getPacketBuffer()) > $this->mtu and !in_array($event->getPacketId(), $this::WHITELIST)) {
			Base::getInstance()->getLogger()->info("Packet non décodé corectement : {$event->getPacketId()} (taille: " . strlen($event->getPacketBuffer()) . ") de l'ip: {$event->getOrigin()->getIp()}");
			$event->cancel();
		}
	}



}