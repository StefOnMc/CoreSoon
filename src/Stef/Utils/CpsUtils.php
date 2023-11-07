<?php

namespace Stef\Utils;

use pocketmine\player\Player;

class CpsUtils
{
	public static  array $cps = [];
	public static array $cooldown = [];
	public static function hasCooldown(Player $player): bool{
		return isset(self::$cooldown[$player->getName()]) && self::$cooldown[$player->getName()] > time();
	}

	public static function updateCooldown(Player $player): void{
		self::$cooldown[$player->getName()] = time() + 1;
	}

	public static function addCPS(Player $player): void{
		$time = microtime(true);
		self::$cps[$player->getName()][] = $time;
	}

	public static function getCPS(Player $player): int{
		$time = microtime(true);
		return count(array_filter(self::$cps[$player->getName()] ?? [], static function(float $t) use ($time):bool{
			return ($time - $t) <= 1;
		}));
	}
}