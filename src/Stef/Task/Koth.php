<?php

namespace Stef\Task;

use JsonException;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Language;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use Stef\Base;
use Stef\Utils\KothUtils;
use Stef\Utils\WebhookUtils;

class Koth extends Task
{
	public static Koth $task;

	public function __construct()
	{
		self::$task = $this;
		KothUtils::$bar->showToAll();
	}

	/**
	 * @throws JsonException
	 */
	public function onRun(): void
	{
		KothUtils::$koth->reload();
		if(KothUtils::$koth->getNested("koth.start") ?? false){
			KothUtils::$bar->addPlayers(Base::getInstance()->getServer()->getOnlinePlayers());
			if(!KothUtils::$koth->getNested("koth.king") && !KothUtils::$koth->getNested("koth.time")){
				if(KothUtils::setNewKing() instanceof Player){
					KothUtils::$koth->setNested("koth.king", KothUtils::setNewKing()->getName());
					KothUtils::$koth->setNested("koth.time", KothUtils::$koth->get("temps"));
					KothUtils::$koth->save();
				}
			}
			$this->updateKing();
		}else {
			$drops = "give {player} diamond";
				$command = $drops;
				$command = str_replace("{player}", ''.KothUtils::$koth->getNested("koth.king") ?? "".'"', $command);
				Base::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(Base::getInstance()->getServer(), new Language("fra")), $command);
			$messag = "{player} vien de gagner le koth";
			$message = str_replace("{player}", KothUtils::$koth->getNested("koth.king") ?? "Personne", $messag);
			KothUtils::$koth->remove("koth");
			KothUtils::$koth->save();
			KothUtils::$bar->removePlayers(Base::getInstance()->getServer()->getOnlinePlayers());
			Base::getInstance()->getServer()->broadcastMessage($message);
		}
	}

	/**
	 * @throws JsonException
	 */
	private function updateKing(): void {
		$king = Server::getInstance()->getPlayerExact(KothUtils::$koth->getNested("koth.king") ?? "");
		$restart = true;
		if($king instanceof Player and KothUtils::onArea($king)){
			if(KothUtils::$koth->getNested("koth.time") > 0){
				KothUtils::$koth->setNested("koth.king", $king->getName());
				KothUtils::$koth->setNested("koth.time", KothUtils::$koth->getNested("koth.time") - 1);
				KothUtils::$koth->save();
				KothUtils::$bar->setTitle("§3Koth §f- §3/event");
				KothUtils::$bar->setSubTitle("§3".$king->getName()." §f- §b".KothUtils::$koth->getNested("koth.time")." secondes");
				$pourcentage = KothUtils::$bar->getPercentage();
				KothUtils::$bar->setPercentage($pourcentage - (1 / KothUtils::$koth->get("temps") ?? 60));
			}
			else {
				WebhookUtils::Koth("Le koth vien de se finir le vainqueur et ". KothUtils::$koth->getNested("koth.king"));
				KothUtils::$bar->removePlayers(Base::getInstance()->getServer()->getOnlinePlayers());
				$drops = "give {player} diamonds";

					$command = $drops;
					$command = str_replace("{player}", ''.KothUtils::$koth->getNested("koth.king").'"', $command);
					Base::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(Base::getInstance()->getServer(), new Language("eng")), $command);

				$message = "{player} vien de gagner le koth";
				$message = str_replace("{player}", KothUtils::$koth->getNested("koth.king"), $message);
				KothUtils::$koth->remove("koth");
				KothUtils::$koth->save();
				Base::getInstance()->getServer()->broadcastMessage($message);
				$restart = false;
			}
		}
		else {
			KothUtils::$koth->removeNested("koth.king");
			KothUtils::$koth->removeNested("koth.time");

			KothUtils::$koth->save();
			KothUtils::$bar->setTitle("§3Koth §f- §3/event");
			KothUtils::$bar->setSubTitle("§3... §f- §b...");
			KothUtils::$bar->setPercentage(1);
		}
		if($restart){
			$task = new $this;
			Base::getInstance()->getScheduler()->scheduleDelayedTask($task, 1*20);
		}
	}
}
