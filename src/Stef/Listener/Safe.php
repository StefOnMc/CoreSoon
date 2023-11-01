<?php

namespace Stef\Listener;

use JsonException;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use Stef\Base;
use Stef\Utils\WebhookUtils;

class Safe implements Listener
{
	private array $cooldowns = [];
private $purePerms;
	public function onEntityDamage(EntityDamageEvent $event): void
	{
		$entity = $event->getEntity();
		if ($entity instanceof Player) {
			$this->purePerms = Base::getInstance()->getServer()->getPluginManager()->getPlugin("PurePerms");
			$PPrank = $this->getPlayerRank($entity);
			$maxHealth = $entity->getMaxHealth();
			$health = $entity->getHealth();
			$percentage = round(($health / $maxHealth) * 100);

			$entity->setNameTag("[$PPrank] ". $entity->getDisplayName() . " " . "\n§e" . "" . $percentage . "%");
		}
	}
	public function getPlayerRank(Player $player): string{
		$group = $this->purePerms->getUserDataMgr()->getData($player)['group'];

		if($group !== null){
			return $group;
		}else{
			return "...";
		}
	}
	public function Chat(PlayerChatEvent $e){
			$p = $e->getPlayer();
			$msg = $e->getMessage();
 $psd = $p->getName();
			$domaine = [
				"pornhub",
				"telegram",
				"youporn",
				"porndroid",
				"xhamster",
				"http://",
				"https://",
				"tukif.com",
				"discord",
			];

			$found = false;
			foreach ($domaine as $element) {
				if (str_contains($msg, $element)) {
					$found = true;
					break;
				}
			}
		if (isset($this->cooldowns[$psd]) && time() - $this->cooldowns[$psd] < 3) {
			$restant = 3 - (time() - $this->cooldowns[$psd]);
$p->sendMessage("§cIl te reste ". $restant . " seconde pour reparlé.");
$e->cancel();
			return true;
		}else{
			if($p->hasPermission("spam.use")){
			}else{
				$this->cooldowns[$psd] = time();
			}
		}

			if ($found) {
				$p->sendMessage("§c La publication de lien est interdite.");
				$e->cancel();
			}
			if (str_contains($msg,"§")) {
				$p->sendMessage("§c La coloration du chat n'est pas authorisé .");
				$e->cancel();
			}
			if(str_contains($msg,"@here")){
				if($p->hasPermission("mention.use")){

				}else{
					$p->sendMessage("§c La mention n'est pas authorisé .");
					$e->cancel();
				}
			}
			if(str_contains($msg,"@everyone")){
				if($p->hasPermission("mention.use")){

				}else{
					$p->sendMessage("§c La mention n'est pas authorisé .");
					$e->cancel();
				}
			}
	}
	public function regenareevent(EntityRegainHealthEvent $ev)
	{
		$entity = $ev->getEntity();
		if ($entity instanceof Player) {
			$this->purePerms = Base::getInstance()->getServer()->getPluginManager()->getPlugin("PurePerms");
			$PPrank = $this->getPlayerRank($entity);
			$maxHealth = $entity->getMaxHealth();
			$health = $entity->getHealth();
			$percentage = round(($health / $maxHealth) * 100);

			$entity->setNameTag("[$PPrank] " . $entity->getDisplayName() . " " . "\n§e" . "" . $percentage . "%");
		}
	}
public function move(PlayerMoveEvent $e){
    $p = $e->getPlayer();
	$world = $p->getLocation()->getWorld();
	$pos = $p->getPosition();
	$block = $world->getBlock($pos);
	$direction = $p->getDirectionPlane()->normalize()->multiply(2);
if($block->getTypeId() === VanillaBlocks::MANGROVE_PRESSURE_PLATE()->getTypeId()){
	if($p->getEffects()->has(VanillaEffects::SPEED())){
		$p->getEffects()->remove(VanillaEffects::SPEED());
	}else{
		$p->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(),3*20,2));
	}
}
if($block->getTypeId() === VanillaBlocks::OAK_PRESSURE_PLATE()->getTypeId()){
$p->setHealth($p->getHealth());
}
if($block->getTypeId() === VanillaBlocks::ACACIA_PRESSURE_PLATE()->getTypeId()){
	$p->setMotion(new Vector3($direction->getX(),1,$direction->getY()));
}
    $p->getHungerManager()->addFood("20");
}
}