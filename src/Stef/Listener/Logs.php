<?php

namespace Stef\Listener;

use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\CommandEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use Stef\Base;
use Stef\Utils\WebhookUtils;

class Logs implements Listener
{
	private array $c1 = [];
	const PACKET = ["MovePlayerPacket",
		"InteractPacket",
		"TickSyncPacket",
		"TextPacket",
		"RequestChunkRadiusPacket",
		"ResourcePackClientResponsePacket",
		"ClientCacheStatusPacket",
		"ClientToServerHandshakePacket",
		"RequestNetworkSettingsPacket",
		"PlayerAuthInputPacket",
		"PlayerActionPacket",
		"AnimatePacket",
		"NetworkStackLatencyPacket",
		"ContainerClosePacket",
		"ItemStackRequestPacket",
		"InventoryTransactionPacket"
		];
	/** @var float[] */
	private $breakTimes = [];
public function Join(PlayerJoinEvent $e){
$ps = $e->getPlayer()->getName();

WebhookUtils::Join($ps ." vien de rejoindre le serveur.");
}

public function Quit(PlayerQuitEvent $e){
	$ps = $e->getPlayer()->getName();
	WebhookUtils::Quit($ps. " vien de quitter le serveur.");
}
public function Chat(PlayerChatEvent $e){
	$ps = $e->getPlayer()->getName();
	$msg = $e->getMessage();
	if($msg === "@here" or $msg === "@here" or $msg === "<@759389053937385492>" or $msg === "<@1012704749302325358>"){
Base::getInstance()->getLogger()->info("Attention : ". $ps ." et suspecté de spam de mention.");
	}else{
		WebhookUtils::Chat($ps . " » ".$msg);
	}
}
public function Command(CommandEvent $e){
	$p = $e->getSender()->getName();
	$cmd = $e->getCommand();
	if($cmd === "msg"){
		if (isset($this->c1[$p]) && time() - $this->c1[$p] < 3) {
			$restant = 3 - (time() - $this->c1[$p]);
			$e->getSender()->sendMessage("§cIl te reste ". $restant . " seconde pour executer la commande.");
			$e->cancel();
			return true;
		}else{
			$this->c1[$p] = time();
		}
	}
	WebhookUtils::Commands($p . " vien d'executer la commande /".$cmd);
}
public function DataPacketRecieve(DataPacketReceiveEvent $e){
$p = $e->getOrigin()->getDisplayName();
$ps = $e->getPacket()->getName();
	if (in_array($ps,self::PACKET)) {

	} else {

		WebhookUtils::Packet_recieve($p . " a reçu le paquet " . $ps);
	}
}
	public function onPlayerInteract(PlayerInteractEvent $event) : void{
		if($event->getAction() === PlayerInteractEvent::LEFT_CLICK_BLOCK){
			$this->breakTimes[$event->getPlayer()->getUniqueId()->getBytes()] = floor(microtime(true) * 20);
		}
	}
	public function onBlockBreak(BlockBreakEvent $event) : void{
		if(!$event->getInstaBreak()){
			$player = $event->getPlayer();
			if(!isset($this->breakTimes[$uuid = $player->getUniqueId()->getBytes()])){
				WebhookUtils::Nuke($player->getName() . " a tenté de cassé un block d'un coup.");
				$event->cancel();
				return;
			}

			$target = $event->getBlock();
			$item = $event->getItem();

			$expectedTime = ceil($target->getBreakInfo()->getBreakTime($item) * 20);

			if(($haste = $player->getEffects()->get(VanillaEffects::HASTE())) !== null){
				$expectedTime *= 1 - (0.2 * $haste->getEffectLevel());
			}

			if(($miningFatigue = $player->getEffects()->get(VanillaEffects::MINING_FATIGUE())) !== null){
				$expectedTime *= 1 + (0.3 * $miningFatigue->getEffectLevel());
			}

			$expectedTime -= 1; //1 tick compensation

			$actualTime = ceil(microtime(true) * 20) - $this->breakTimes[$uuid];
			if($actualTime < $expectedTime){
				WebhookUtils::Nuke($player->getName() . " casse trop vite les blocks a ". $actualTime. " s.");
				$event->cancel();
				return;
			}

			unset($this->breakTimes[$uuid]);
		}
	}

	public function onPlayerQuit(PlayerQuitEvent $event) : void{
		unset($this->breakTimes[$event->getPlayer()->getUniqueId()->getBytes()]);
	}
}