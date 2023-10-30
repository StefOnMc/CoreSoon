<?php

namespace Stef\Command\Grade;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;

class Ec extends VanillaCommand
{
public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
{
    parent::__construct($name, $description, $usageMessage, $aliases);
    $this->setPermission("ec.use");
}
public function execute(CommandSender $sender, string $commandLabel, array $args)
{
    if($sender instanceof Player){

        if($sender->hasPermission("ec.use")){
            $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
            $menu->setName("§aEnderchest de ". $sender->getName());
            $menu->getInventory()->setContents($sender->getEnderInventory()->getContents());
            $menu->setListener(function (InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult {
                $sender->getEnderInventory()->setItem($transaction->getAction()->getSlot(), $transaction->getIn());
                return $transaction->continue();
            });
            $menu->send($sender);
        }else{
            $sender->sendMessage(Base::NO_PERM);
        }

    }
}
}