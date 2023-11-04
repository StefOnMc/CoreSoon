<?php

namespace Stef\Task;

use pocketmine\block\tile\Chest;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use Stef\Base;
use Stef\Utils\TimeUtils;
use Stef\Utils\WebhookUtils;
class Reffil extends Task
{
	private static int $time = 30;
	const STUFF1 = "https://cdn.discordapp.com/attachments/1165961692207911052/1170144174247514162/image.png?ex=6557f8af&is=654583af&hm=96c97377a953e34d20e486646ed3690a03a6e421ccdc3e60910b80eda649011b&";
	const STUFF2 = "https://cdn.discordapp.com/attachments/1165961692207911052/1170144218644217948/image.png?ex=6557f8b9&is=654583b9&hm=9d37663ca0d1abbd7c0b53a77b7fb9bb43ea4a94df6a73bc115fa1e4bd2e0f2a&";
	const STUFF3 = "https://tenor.com/view/cops-police-sirens-catching-crminals-what-you-gonna-do-gif-22472645";
public function onRun(): void
{
	self::$time--;
	if(self::$time === 0){
		Base::getInstance()->getServer()->broadcastMessage("le chestreffil vien de se regen nv stuff !!!");
		foreach (Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $w){
			if(str_starts_with($w->getFolderName(),"world")){
				$w->setBlock(new Vector3(2,80,5),VanillaBlocks::CHEST());
				$tile = $w->getTileAt(2, 80, 5);
				if($tile instanceof \pocketmine\block\tile\Chest){
					$randomFunction = rand(1, 3);
					switch ($randomFunction){
						case 1:
							$this->Stuff1($tile);
							WebhookUtils::Chest("Le coffre vien de se régen a ". TimeUtils::GetTime(). " \n Stuff: \n ", self::STUFF1);
							break;
						case 2:
							$this->Stuff2($tile);
							WebhookUtils::Chest("Le coffre vien de se régen a ". TimeUtils::GetTime(). " \n Stuff: \n ", self::STUFF2);
							break;
						case 3:
							$this->Stuff3($tile);
						WebhookUtils::Chest("Le coffre vien de se régen a ". TimeUtils::GetTime(). " \n Stuff: \n ", self::STUFF3);
							break;
					}
				}
			}

		}
		self::$time = 30;

	}else{
		if(self::$time === 10 or self::$time === 5 or self::$time === 4 or self::$time === 3 or self::$time === 2 or self::$time === 1){
			Base::getInstance()->getServer()->broadcastMessage("le refill spawn dans ". self::$time. " seconde.");
		}
	}
}
public static function Stuff1(Chest $e){
	$e->setName("ChestReffill");
	$e->getInventory()->clearAll();
	$e->getInventory()->setItem(2,VanillaItems::PAPER());
	$e->getInventory()->setItem(3,VanillaItems::GOLD_INGOT());
	$e->getInventory()->setItem(4,VanillaItems::NETHERITE_INGOT());
}
	public static function Stuff2(Chest $e){
		$e->setName("ChestReffill");
		$e->getInventory()->clearAll();
		$e->getInventory()->setItem(2,VanillaItems::PAPER());
		$e->getInventory()->setItem(3,VanillaItems::BONE());
		$e->getInventory()->setItem(4,VanillaItems::COPPER_INGOT());

	}
	public static function Stuff3(Chest $e){
		$e->setName("ChestReffill");
		$e->getInventory()->clearAll();
		$e->getInventory()->setItem(2,VanillaItems::PAPER());
		$e->getInventory()->setItem(3,VanillaItems::PAPER());
		$e->getInventory()->setItem(4,VanillaItems::PAPER());
	}
}