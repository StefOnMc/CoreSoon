<?php

namespace Stef\Command\Grade;


use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\item\Durable;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use Stef\Base;


class Repair extends VanillaCommand {

	private array $cooldowns = [];

	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("repair.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool
	{
		if (!$sender instanceof Player) {

			return false;
		}
if($sender->hasPermission("repair.use")){
	$player = $sender;
	$item = $player->getInventory()->getItemInHand();
	$cooldownTime = 30;


	if (empty($args)) {
		if ($item->isNull()) {
			$sender->sendMessage("§cT'es main sont vide.");
			return true;
		}

		if ($item instanceof Durable) {
			if ($this->hasCooldown($player)) {
				$remainingTime = $this->getRemainingCooldownTime($player);
				$cooldownMessage = str_replace("{time}", $remainingTime, "§c Il te reste {time} seconde pour réutulisé");
				$sender->sendMessage(str_replace("&", "§", $cooldownMessage));
				return true;
			}

			$item->setDamage(0);
			$player->getInventory()->setItemInHand($item);
			$sender->sendMessage("§aVotre item à bien été réparé.");

			if (!$player->hasPermission("ultrarepair.bypasscooldown")) {
				$this->addCooldown($player, $cooldownTime); // Add cooldown for repairing a single item
			}
		} else {
			$sender->sendMessage("§cLes blocks ne sont pas permis .");
		}
	} elseif ($args[0] === "all") {
		if ($sender->hasPermission("repairall.use")){
			if ($this->hasCooldown($player, true)) {
				$remainingTime = $this->getRemainingCooldownTime($player, true);
				$cooldownMessage = str_replace("{time_all}", $remainingTime, "§aIl faut attendre {time_all} seconde");
				$sender->sendMessage(str_replace("&", "§", $cooldownMessage));
				return true;
			}

			$this->repairAllItems($player);
			$sender->sendMessage("§aTout vos item on bien été réparé.");

			if (!$player->hasPermission("core.bypass")) {
				$this->addCooldown($player, $cooldownTime, true);
			}
		}else {
			$sender->sendMessage(Base::NO_PERM);
		}
	}
}else{
	$sender->sendMessage(Base::NO_PERM);
}


		return true;
	}

	private function repairAllItems(Player $player) {
		$inventory = $player->getInventory();
		$armorInventory = $player->getArmorInventory();
		foreach ($inventory->getContents() as $slot => $item) {
			if (!$item->isNull()) {
				if ($item instanceof Durable) {
					$item->setDamage(0);
					$inventory->setItem($slot, $item);
				}
			}
		}
		for ($slot = 0; $slot < 9; $slot++) {
			$item = $inventory->getItem($slot);
			if (!$item->isNull()) {
				if ($item instanceof Durable) {
					$item->setDamage(0);
					$inventory->setItem($slot, $item);
				}
			}
		}
		foreach ($armorInventory->getContents() as $slot => $item) {
			if (!$item->isNull()) {
				if ($item instanceof Durable) {
					$item->setDamage(0);
					$armorInventory->setItem($slot, $item);
				}
			}
		}
	}

	private function addCooldown(Player $player, int $seconds, bool $allItems = false) {
		$name = $player->getName();
		$this->cooldowns[$name] = [
			"time" => time() + $seconds,
			"allItems" => $allItems,
		];
	}

	private function hasCooldown(Player $player, bool $allItems = false): bool {
		$name = $player->getName();
		if (isset($this->cooldowns[$name])) {
			$cooldown = $this->cooldowns[$name];
			if ($allItems && $cooldown["allItems"]) {
				return time() < $cooldown["time"];
			} elseif (!$allItems && !$cooldown["allItems"]) {
				return time() < $cooldown["time"];
			}
		}
		return false;
	}

	private function getRemainingCooldownTime(Player $player, bool $allItems = false): int {
		$name = $player->getName();
		if (isset($this->cooldowns[$name])) {
			$cooldown = $this->cooldowns[$name];
			if ($allItems && $cooldown["allItems"]) {
				return $cooldown["time"] - time();
			} elseif (!$allItems && !$cooldown["allItems"]) {
				return $cooldown["time"] - time();
			}
		}
		return 0;
	}


}