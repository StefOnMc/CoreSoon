<?php

namespace Stef\Utils;

use pocketmine\utils\Config;
use Stef\Base;

class KitUtils
{
	/** @var Config */
	public static $cooldowns;
	public static function Init(){
		self::$cooldowns = new Config(Base::getInstance()->getDataFolder() . "kit.yml", Config::YAML);
	}
	private static function setCooldowns(string $name, int $cooldownTime, string $grade) {

		$cooldownData = self::$cooldowns->getNested("cooldowns.$grade", []);
		$cooldownData[$name] = $cooldownTime;
		self::$cooldowns->setNested("cooldowns.$grade", $cooldownData);
		self::$cooldowns->save();
	}
	public static function setCooldown($playerName, $time, string $format , string $grade) {
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


	public static function getTime(string $playerName,string $grade) {
		$remainingTime = self::getTimes($playerName,$grade);
		return TimeUtils::FormatTime($remainingTime);
	}

	public static function hasCooldown(string $playerName,string $grade) {
		$cooldownData = self::$cooldowns->getNested("cooldowns.$grade", []);
		return isset($cooldownData[$playerName]);
	}
}