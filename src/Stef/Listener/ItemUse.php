<?php

namespace Stef\Listener;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use Stef\Base;

class ItemUse implements Listener
{
	private array $c1 = [];
	private array $c2 = [];
	private array $c3 = [];
	private array $c4 = [];
	private array $c5 = [];
	public function checkItemHeld(Player $player, Item $item)
	{
		$playerName = $player->getName();
		$playerEffect = $player->getEffects();
		if ($item->getTypeId() === VanillaItems::IRON_PICKAXE()->getTypeId()) {
			$effect = new EffectInstance(VanillaEffects::HASTE(), 3600 *20, 1, false);
			$playerEffect->add($effect);
			$this->c5[$playerName] = true;
		} elseif ($this->Isonpickaxe($player)) {
			$playerEffect->remove(VanillaEffects::HASTE());
			unset($this->c5[$playerName]);
		}
	}

	public function Isonpickaxe(Player $player): bool
	{
		return isset($this->c5[$player->getName()]);
	}

	public function itemHeld(PlayerItemHeldEvent $event)
	{
		$this->checkItemHeld($event->getPlayer(), $event->getItem());
	}

	public function playerJoinEvent(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$this->checkItemHeld($player, $player->getInventory()->getItemInHand());
	}

	public function playerQuitEvent(PlayerQuitEvent $event)
	{
		$player = $event->getPlayer();
		$this->checkItemHeld($player, VanillaItems::AIR());
	}

	public function ItemUse(PlayerItemUseEvent $e){
$p = $e->getPlayer();
$ps = $p->getName();
$i = $e->getItem();
if($i->getTypeId() === VanillaItems::BONE()->getTypeId()){
	if (isset($this->c1[$ps]) && time() - $this->c1[$ps] < 120) {
		$e->cancel();
		$restant = 120 - (time() - $this->c1[$ps]);
		$p->sendMessage("§cIl te reste ". $restant . " seconde pour réutilisée.");
	}else{
		$this->c1[$ps] = time();
		$p->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(),5*20,3));
		$p->sendMessage("§aVous avez bien utilisé votre stick de speed.");
	}
}
if($i->getTypeId() === VanillaItems::ARROW()->getTypeId()){
	if (isset($this->c2[$ps]) && time() - $this->c2[$ps] < 120) {
		$e->cancel();
		$restant = 120 - (time() - $this->c2[$ps]);
		$p->sendMessage("§cIl te reste ". $restant . " seconde pour réutilisée.");
	}else{
		$this->c2[$ps] = time();
		$p->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(),15*20,3));
		$p->sendMessage("§aVous avez bien utilisé votre stick de resistance.");
	}
}
if($i->getTypeId() === VanillaItems::CARROT()->getTypeId()){
	if (isset($this->c3[$ps]) && time() - $this->c3[$ps] < 120) {
		$e->cancel();
		$restant = 120 - (time() - $this->c3[$ps]);
		$p->sendMessage("§cIl te reste ". $restant . " seconde pour réutilisée.");
	}else{
		$this->c3[$ps] = time();
		$p->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(),15*20,2));
		$p->sendMessage("§aVous avez bien utilisé votre stick de force.");
	}
}
	if($i->getTypeId() === VanillaItems::ENDER_PEARL()->getTypeId()){

		if (isset($this->c4[$ps]) && time() - $this->c4[$ps] < 15) {
			$e->cancel();
			$restant = 15 - (time() - $this->c4[$ps]);
			$p->sendMessage("§cIl te reste ". $restant . " seconde pour réutilisée.");
		}else{
			$this->c4[$ps] = time();
		}
	}
}
}