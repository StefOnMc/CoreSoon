<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketDecodeEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use Stef\Base;

class Server implements Listener
{
	private const WHITELIST = [
		ProtocolInfo::LOGIN_PACKET,
	];
	private int $mtu = 1492;

	private function query(QueryRegenerateEvent $e): void
	{
		$query = $e->getQueryInfo();
		$query->setExtraData(["oe nn evite"]);
		$query->setListPlugins(false);
		$query->setWorld("Soon");
	}


	private function Decode(DataPacketDecodeEvent $event): void
	{
		if (strlen($event->getPacketBuffer()) > $this->mtu and !in_array($event->getPacketId(), $this::WHITELIST)) {
			Base::getInstance()->getLogger()->info("Packet non décodé corectement : {$event->getPacketId()} (taille: " . strlen($event->getPacketBuffer()) . ") de l'ip: {$event->getOrigin()->getIp()}");
			$event->cancel();
		}
	}

}