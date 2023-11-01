<?php

namespace Stef\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use Stef\Utils\FormUtils;

class Item implements Listener
{
	public function Item(PlayerItemUseEvent $e){
		$i = $e->getItem();
		if($i->getTypeId() === VanillaItems::ENDER_PEARL()->getTypeId()){
			$e->cancel();
			$d = $e->getPlayer()->getDirectionVector()->normalize()->multiply(2.5);
			$e->getPlayer()->setMotion(new Vector3($d->getX(),$d->getY(),$d->getZ()));
		}
	}
	public function Compass(PlayerInteractEvent $e){
		$p = $e->getPlayer();
        $i = $e->getItem()->getTypeId();
		if($i === VanillaItems::COMPASS()->getTypeId()){
			FormUtils::Send($p);
		}
	}
}