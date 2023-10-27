<?php

namespace Stef\Listener;

use JsonException;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use Stef\Base;

class Safe implements Listener
{
	private array $cooldowns = [];
	private $purePerms;

	/**
	 * @throws JsonException
	 */
	public function Join(PlayerJoinEvent $e): void
	{
        $p = $e->getPlayer();
        $ps = $p->getName();
        $e->setJoinMessage("");
        if($p->hasPlayedBefore()){

        }else{
            $playerc = new Config(Base::getInstance()->getServer()->getDataPath(). "count.json", Config::JSON);
            $playerCount = count($playerc->getAll());
            $playerCount++;
            $playerc->set($playerCount);
            $playerc->save();
            Base::getInstance()->getServer()->broadcastMessage($ps . " Vien de rejoindre la premiere fois, il et le ". $playerCount . " eme inscrit");
        }

    }

    public function Leave(PlayerQuitEvent $e): void
	{
        $e->setQuitMessage("");
        Base::getInstance()->getServer()->broadcastPopup("§a+ ". $e->getPlayer()->getName(). " +");
    }
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
public function AntiHunger(PlayerMoveEvent $e){
    $p = $e->getPlayer();
    $p->getHungerManager()->addFood("20");
}
}