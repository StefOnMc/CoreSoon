<?php

namespace Stef\Command\Grade;

use muqsit\invmenu\InvMenu;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\InvmenuUtils;

class Craft extends VanillaCommand
{
    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("craft.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
{
    if($sender instanceof Player){
        if($sender->hasPermission("craft.use")){
            $sender->sendMessage("§aOuverture de l'établi.");
			$craft = InvMenu::create(InvmenuUtils::INV_MENU_TYPE_WORKBENCH);
			$craft->send($sender);

        }else{
            $sender->sendMessage(Base::NO_PERM);
        }
    }
}
}