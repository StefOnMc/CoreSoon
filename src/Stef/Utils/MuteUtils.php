<?php
namespace Stef\Utils;

use pocketmine\utils\Config;
use Stef\Base;

class MuteUtils
{
	/** @var Config */
	public static $mute;

	public static function Init() {
		$mutePath = Base::getInstance()->getDataFolder() . "mute.yml";

		if (!file_exists($mutePath)) {
			file_put_contents($mutePath, "mutetime: []");
		}

		self::$mute = new Config($mutePath, Config::YAML);
	}

	private static function setMutes(string $name, int $muteTime, string $reason) {
		$muteData = self::$mute->get("mutetime", []);
		$muteData[$name] = ["time" => $muteTime, "reason" => $reason];
		self::$mute->set("mutetime", $muteData);
		self::$mute->save();
	}

	public static function Unmute(string $name){
		$muteData = self::$mute->get("mutetime", []);
		unset($muteData[$name]);
		self::$mute->set("mutetime", $muteData);
		self::$mute->save();
	}

	public static function setMute($playerName, $time, string $format, string $reason) {
		$seconds = $time;
		if ($format === 'minute') {
			$seconds *= 60;
		} elseif ($format === 'heure') {
			$seconds *= 3600;
		} elseif ($format === 'jour') {
			$seconds *= 86400;
		}

		self::setMutes($playerName, $seconds, $reason);
	}

	public static function getTimes(string $name) {
		$muteData = self::$mute->get("mutetime", []);

		if (isset($muteData[$name])) {
			return TimeUtils::FormatTime($muteData[$name]["time"]);
		}

		return 0;
	}
	public static function getMutedPlayers() {
		$muteData = self::$mute->get("mutetime", []);

		$mutedPlayers = [];
		foreach ($muteData as $playerName => $muteInfo) {
			$mutedPlayers[] = $playerName;
		}

		return $mutedPlayers;
	}

	public static function getMuteReason(string $name) {
		$muteData = self::$mute->get("mutetime", []);

		if (isset($muteData[$name])) {
			return $muteData[$name]["reason"];
		}

		return "Raison non spécifiée";
	}

	public static function hasMute(string $playerName) {
		$muteData = self::$mute->get("mutetime", []);
		return isset($muteData[$playerName]);
	}
}
