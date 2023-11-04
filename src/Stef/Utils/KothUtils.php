<?php

namespace Stef\Utils;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use Stef\Base;
use xenialdan\apibossbar\BossBar;

class KothUtils
{
	/** @var Config */
	public static $koth;
	public static BossBar $bar;

	public static function Init(){
		self::$koth = new Config(Base::getInstance()->getDataFolder()."koth.yml", Config::YAML, array(
			"pos1" => "0:0:0",
			"pos2" => "0:0:0",
			"world" => "",
			"temps" => 60,));
		self::$bar = new BossBar();
		self::$bar->setPercentage(1);
		self::$bar->setColor(2);
}
	public static function onArea(Player $player): bool
	{
		if($player->isCreative() === true or $player->isSpectator() === true){

		}else{
			$pos1 = explode(":", self::$koth->get("pos1"));
			$pos2 = explode(":", self::$koth->get("pos2"));
			$minX = min($pos1[0], $pos2[0]);
			$maxX = max($pos1[0], $pos2[0]);
			$minY = min($pos1[1], $pos2[1]);
			$maxY = max($pos1[1], $pos2[1]);
			$minZ = min($pos1[2], $pos2[2]);
			$maxZ = max($pos1[2], $pos2[2]);

			if($player->getPosition()->x >= $minX && $player->getPosition()->x <= $maxX
				&& $player->getPosition()->y >= $minY && $player->getPosition()->y <= $maxY
				&& $player->getPosition()->z >= $minZ && $player->getPosition()->z <= $maxZ) {
				return true;
			} else return false;
		}
		return false;
	}

	public static function setNewKing(): Player|null {
		$first = false;
		global $king;
		$king = null;
		$players = Base::getInstance()->getServer()->getOnlinePlayers();
		shuffle($players);
		foreach ($players as $player){
			if(self::onArea($player) and !$first){
				$first = true;
				$king = $player;
			}
		}
		return $king;
	}

	public static function isStarted(): bool|null {
		return self::$koth->getNested("koth.start");
	}
}