<?php

namespace Stef\Command\Joueur;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\world\Position;
use Stef\Base;

class Event extends VanillaCommand
{
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("event.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if($sender instanceof Player){
			$event = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
			$event->setName("§aEvent");
			$event->getInventory()->setItem(3,VanillaItems::WOODEN_SHOVEL()->setCustomName("§aKoth")->setLore(["§c Se téleporté au Koth"])->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(),100)));
			$event->getInventory()->setItem(20,VanillaItems::STONE_SHOVEL()->setCustomName("§bNexus")->setLore(["§c Se téleporté au Nexus."]));
			$event->getInventory()->setItem(40,VanillaItems::IRON_SHOVEL()->setCustomName("§bSOON")->setLore(["§b SOON"]));
			$event->getInventory()->setItem(24,VanillaItems::DIAMOND_SHOVEL()->setCustomName("§bSOON")->setLore(["§b SOON"]));
			$event->getInventory()->setItem(22,VanillaItems::NETHERITE_SHOVEL()->setCustomName("§bSOON")->setLore(["§b SOON"]));
			$event->setListener(function (InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult {
				// Koth
				if($transaction->getItemClicked()->getTypeId() === VanillaItems::WOODEN_SHOVEL()->getTypeId()){
$sender->teleport(new Position(9,2,2,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
$sender->sendMessage("§aVous avez bien été téleporté au koth.");
				}
				// Nexus
				if($transaction->getItemClicked()->getTypeId() === VanillaItems::STONE_SHOVEL()->getTypeId()){
					$sender->teleport(new Position(9,2,2,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
					$sender->sendMessage("§aVous avez bien été téleporté au Nexus.");
				}
				//soon
				if($transaction->getItemClicked()->getTypeId() === VanillaItems::IRON_SHOVEL()->getTypeId()){
					$sender->teleport(new Position(9,2,2,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
				}
				// soon
				if($transaction->getItemClicked()->getTypeId() === VanillaItems::DIAMOND_SHOVEL()->getTypeId()){
					$sender->teleport(new Position(9,2,2,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
				}
				// soon
				if($transaction->getItemClicked()->getTypeId() === VanillaItems::NETHERITE_SHOVEL()->getTypeId()){
					$sender->teleport(new Position(9,2,2,Base::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
				}
				return $transaction->discard();
			});
			$event->send($sender);
		}
	}
}