<?php

namespace Stef\Listener;

use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use Stef\Command\Joueur\Anvil;
use Stef\Utils\Gui\EnchantGUI;

class Open implements Listener
{

	public function interact(PlayerInteractEvent $e){
		$i = $e->getBlock()->getTypeId();
		$p = $e->getPlayer();
		if($e->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			if($i === VanillaBlocks::ENCHANTING_TABLE()->getTypeId()){
				$e->cancel();
				if($p->getInventory()->getItemInHand()->isNull()){
					$p->sendMessage("§cIl te faut un item dans ta main.");
				}else{
					EnchantGUI::SendShop($p);
				}
			}
			if($i === VanillaBlocks::ANVIL()->getTypeId()){
				$e->cancel();
				Anvil::SendAnvil($p);
			}
		}
	}
}