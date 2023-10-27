<?php

namespace Stef\Command\Grade;

use muqsit\invmenu\InvMenu;
use pocketmine\block\inventory\CraftingTableInventory;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\inventory\PlayerCraftingInventory;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Base;

class Craft extends VanillaCommand
{
    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("craft.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
{
    $cfg = Base::getInstance()->getConfig();
    if($sender instanceof Player){
        if($sender->hasPermission("craft.use")){
            $sender->sendMessage("§aOuverture de l'établi.");
			$craft = InvMenu::create(Base::INV_MENU_TYPE_WORKBENCH);
			$craft->send($sender);

        }else{
            $sender->sendMessage($cfg->getNested("Message.perm"));
        }
    }
}
}