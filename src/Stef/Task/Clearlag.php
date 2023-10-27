<?php

namespace Stef\Task;

use pocketmine\entity\Entity;
use pocketmine\entity\object\ItemEntity;
use pocketmine\scheduler\Task;
use Stef\Base;

class Clearlag extends Task
{
	private static int $time = 300;
	public function onRun(): void
	{
		self::$time--;
		if (self::$time === 0) {
		foreach (Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $list){
			$entities = $list->getEntities();
			foreach($entities as $entity) {
				if ($entity instanceof ItemEntity) {
					$entity->close();
					$se = str_replace('{count}',count([$entity]),"Il y'a {count} suprimée.");
					Base::getInstance()->getServer()->broadcastMessage($se);
				}
				self::$time = 300;
				break;
			}
		}
		}else {
			if (self::$time >= 100) {

				$minutes = floor(self::$time / 60);
				$seconds = self::$time % 60;
				$timeRemaining = "{$minutes} minute(s)";
				if ($seconds > 0) {
					$timeRemaining .= " {$seconds} seconde(s)";
				}
			} else {

				$timeRemaining = self::$time . " seconde(s)";
			}

			$msg = str_replace('{temps}', $timeRemaining, "Les entités seront supprimées dans {temps} !");

			if (self::$time === 260 or self::$time === 160 or self::$time === 100 or self::$time === 60 or self::$time === 45 or self::$time === 30 or self::$time === 15 or self::$time === 10 or self::$time === 5 or self::$time === 4 or self::$time === 3 or self::$time === 2 or self::$time === 1) {
				Base::getInstance()->getServer()->broadcastMessage($msg);
			}
		}
	}

}