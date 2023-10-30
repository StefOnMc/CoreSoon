<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\entity\object\ItemEntity;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Forceclear extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
	parent::__construct($name, $description, $usageMessage, $aliases);
	$this->setPermission("clear.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
	if($sender instanceof Player){
		if($sender->hasPermission("clear.use")){
			foreach (Base::getInstance()->getServer()->getWorldManager()->getWorlds() as $list){
				$entities = $list->getEntities();
				foreach($entities as $entity) {
					if ($entity instanceof ItemEntity) {
						$entity->close();
						$se = str_replace('{count}',count([$entity]),$sender->getName() . " vien de forcer le clearlag \n il y a {count} suprimée.");
						Base::getInstance()->getServer()->broadcastMessage($se);
					}else{
						$sender->sendMessage("§cAucune entité trouvé.");
					}
				}
			}
		}else{
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}
}