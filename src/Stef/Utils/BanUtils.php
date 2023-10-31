<?php
namespace Stef\Utils;

use pocketmine\utils\Config;
use Stef\Base;

class BanUtils
{
	/** @var Config */
	public static $ban;

	public static function Init() {
		$banPath = Base::getInstance()->getDataFolder() . "ban.yml";

		if (!file_exists($banPath)) {
			// Si le fichier n'existe pas, créez-le avec un tableau vide en utilisant le format YAML.
			file_put_contents($banPath, "bantime: []");
		}

		self::$ban = new Config($banPath, Config::YAML);
	}

	private static function setBans(string $name, int $banTime, string $reason) {
		$banData = self::$ban->get("bantime", []);
		$banData[$name] = ["time" => $banTime, "reason" => $reason];
		self::$ban->set("bantime", $banData);
		self::$ban->save();
	}

	public static function Unban(string $name) {
		$banData = self::$ban->get("bantime", []);
		unset($banData[$name]);
		self::$ban->set("bantime", $banData);
		self::$ban->save();
	}

	public static function setBan($playerName, $time, string $format, string $reason) {
		$seconds = $time;
		if ($format === 'minute') {
			$seconds *= 60;
		} elseif ($format === 'heure') {
			$seconds *= 3600;
		} elseif ($format === 'jour') {
			$seconds *= 86400;
		}

		self::setBans($playerName, $seconds, $reason);
	}

	public static function getTimes(string $name) {
		$banData = self::$ban->get("bantime", []);

		if (isset($banData[$name])) {
			return TimeUtils::FormatTime($banData[$name]["time"]);
		}

		return 0;
	}

	public static function getBanReason(string $name) {
		$banData = self::$ban->get("bantime", []);

		if (isset($banData[$name])) {
			return $banData[$name]["reason"];
		}

		return "Raison non spécifiée";
	}

	public static function hasBan(string $playerName) {
		$banData = self::$ban->get("bantime", []);
		return isset($banData[$playerName]);
	}
}
