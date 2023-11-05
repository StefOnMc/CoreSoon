<?php

namespace Stef\Utils;

use pocketmine\entity\Entity;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;
use Stef\Base;
use Stef\Entity\Nexus;

class EntityUtils
{
public static function RegisterNexus(){
	EntityFactory::getInstance()->register(Nexus::class, function(World $world, CompoundTag $nbt): Entity {
		return new Nexus(EntityDataHelper::parseLocation($nbt, $world), $nbt);
	}, [Nexus::class]);
}
public static function ClearNexus(){
	if(\Stef\Command\Admin\Nexus::$nexuss === true){
		foreach (Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $w){

			foreach ($w->getEntities() as $entity){
				if($entity instanceof \Stef\Entity\Nexus){
					$entity->close();
				}
			}
		}
	}
}
}