<?php

namespace Stef\Utils;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use Stef\Base;

class KitUtils
{
	/** @var Config */
	public static $cooldowns;
	private static function setCooldowns(string $name, int $cooldownTime, string $grade) {
		self::$cooldowns = new Config(Base::getInstance()->getDataFolder() . "cooldowns.yml", Config::YAML);
		$cooldownData = self::$cooldowns->getNested("cooldowns.$grade", []);
		$cooldownData[$name] = $cooldownTime;
		self::$cooldowns->setNested("cooldowns.$grade", $cooldownData);
		self::$cooldowns->save();
	}
	public static function setCooldown($playerName, $time, string $format, string $grade) {
		$seconds = $time;
		if ($format === 'minute') {
			$seconds *= 60;
		} elseif ($format === 'heure') {
			$seconds *= 3600;
		} elseif ($format === 'jour') {
			$seconds *= 86400;
		}

		self::setCooldowns($playerName, $seconds,$grade);
	}
	private static function getTimes(string $name,string $grade) {
		$cooldownData = self::$cooldowns->getNested("cooldowns.$grade", []);

		if (isset($cooldownData[$name])) {
			return $cooldownData[$name];
		}

		return 0;
	}
	public static function formatTime($seconds) {
		if ($seconds >= 86400) {
			$days = floor($seconds / 86400);
			$hours = floor(($seconds % 86400) / 3600);
			$minutes = floor(($seconds % 3600) / 60);
			return "$days jour(s), $hours heure(s) et $minutes minute(s)";
		} elseif ($seconds >= 3600) {
			$hours = floor($seconds / 3600);
			$minutes = floor(($seconds % 3600) / 60);
			return "$hours heure(s) et $minutes minute(s)";
		} elseif ($seconds >= 60) {
			$minutes = floor($seconds / 60);
			return "$minutes minute(s)";
		} else {
			return "$seconds seconde(s)";
		}
	}

	public static function getTime(string $playerName,string $grade) {
		$remainingTime = self::getTimes($playerName,$grade);
		return self::formatTime($remainingTime);
	}

	public static function hasCooldown(string $playerName,string $grade) {
		$cooldownData = self::$cooldowns->getNested("cooldowns.$grade", []);
		return isset($cooldownData[$playerName]);
	}
}