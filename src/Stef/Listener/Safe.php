<?php

namespace Stef\Listener;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use Stef\Base;


class Safe implements Listener
{
	private array $cooldowns = [];
private $purePerms;
	private static bool $isGameActive = true;
	private static  $currentGameType;
	public static $currentGameQuestionMath;
	public static $currentGameQuestionChat;
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
	public static function startGame($gameType) {
		self::$isGameActive = true;
		self::$currentGameType = $gameType;

		if ($gameType === "math") {
			self::startMath();
		} elseif ($gameType === "mot") {
			self::startMot();
		}

		Base::getInstance()->getServer()->broadcastMessage("Un jeu de type $gameType a commencé ! Essayez de deviner la réponse.");
	}
	private static function startMath() {
		$num1 = mt_rand(1, 1000);
		$num2 = mt_rand(1, 1000);
		$result = "$num1 + $num2 ?";
		self::$currentGameQuestionMath = [$num1 + $num2];
		Base::getInstance()->getServer()->broadcastMessage("Quelle est la réponse à cette équation : ". $result);
	}

	private static function startMot() {
		$wordList = ["bigtor", "zebinet", "stefi"];
		$c = $wordList[array_rand($wordList)];
		$shuffledWord = str_shuffle($c);
		self::$currentGameQuestionChat = [$wordList[array_rand($wordList)]];
		Base::getInstance()->getServer()->broadcastMessage("Devinez le mot : $shuffledWord");
	}
	protected static array $recipients;


	public function Chat(PlayerChatEvent $e){
			$p = $e->getPlayer();
			$msg = $e->getMessage();
		if (self::$isGameActive) {
			$message = strtolower($msg);
			if (self::$currentGameType === "mot" && self::$currentGameQuestionChat[$message]) {
				Base::getInstance()->getServer()->broadcastMessage($p->getName() . " a bien remis le mot en place !");
			} elseif (self::$currentGameType === "math" && self::$currentGameQuestionMath[$message]) {
				Base::getInstance()->getServer()->broadcastMessage($p->getName() . " a donné le bon calcul !");
			}
		}
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