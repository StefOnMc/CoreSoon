<?php

namespace Stef\Utils;

use Stef\Base;
use Stef\Command\Admin\Dev;
use Stef\Command\Admin\Forceclear;
use Stef\Command\Admin\Info;
use Stef\Command\Admin\Restart;
use Stef\Command\Admin\Say;
use Stef\Command\Admin\Stats;
use Stef\Command\Grade\Back;
use Stef\Command\Grade\Craft;
use Stef\Command\Grade\Ec;
use Stef\Command\Grade\Repair;
use Stef\Command\Grade\Trash;
use Stef\Command\Joueur\Eshop;
use Stef\Command\Joueur\Event;
use Stef\Command\Joueur\Kit;
use Stef\Command\Joueur\Minage;
use Stef\Command\Joueur\Msg;
use Stef\Command\Joueur\Nv;
use Stef\Command\Joueur\Spawn;
use Stef\Command\Staff\Ban;
use Stef\Command\Staff\Mute;
use Stef\Command\Staff\Unban;
use Stef\Command\Staff\Unmute;

class CommandUtils
{
	public static function Unregister()
	{
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("me"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("ver"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("kill"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("clear"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("say"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("msg"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("ban"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("unban"));
	}

	public static function Init()
	{
		self::RegisterStaff();
		self::RegisterPlayer();
		self::RegisterRole();
	}

	private static function RegisterPlayer(): void
	{
		$commands = [
			new Nv("nv", "Avoir l'effet de night vision.", "/nv", []),
			new Event("event", "Ouvre une interface.", "/event", []),
			new Spawn("spawn", "Se téléporter au spawn.", "/spawn", ["hub"]),
			new Minage("minage", "Se téléporter au minage.", "/minage", []),
			new Kit("kit", "Avoir son kit.", "/kit", []),
			new Eshop("eshop", "Enchanter vos items.", "/eshop", []),
			new Msg("msg", "écrire un msg à quelqu'un.", "/msg", []),
		];

		Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX, $commands);
		$commandCount = count($commands);
		Base::getInstance()->getLogger()->info("Commande Joueur chargé: " . $commandCount);
	}

	private static function RegisterStaff(): void
	{
		$commands = [
			new Stats("stats", "Voir les statistiques du serveur.", "/stats player & server", [""]),
			new Info("info", "Voir les statistiques d'un joueur.", "/info joueur", [""]),
			new Forceclear("forceclear", "Forcer le clearlag.", "/forceclear", ["fc"]),
			new Say("say", "Faire une annonce.", "/say msg", []),
			new Mute("mute","mute un joueur","/mute",[]),
			new Unmute("unmute","unmute un joueur","/unmute",[]),
			new Ban("ban","bannir un joueur","/ban joueur 1 jour",[]),
			new Unban("unban","débanir un joueur","/unban joueur",[]),
			new Restart("restart","redémaré le serveur.","/restart",[]),
			new Dev("dev","menu admin","/dev",[]),
		];

		Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX, $commands);

		$commandCount = count($commands);
		Base::getInstance()->getLogger()->info("Commande Staff chargé: " . $commandCount);
	}

	private static function RegisterRole(): void
	{
		$commands = [
			new Craft("craft", "Ouvre un établi.", "/craft", []),
			new Ec("ec", "Ouvre un enderchest.", "/ec", []),
			new Trash("trash", "Ouvre une poubelle.", "/trash", []),
			new Repair("repair", "Permet de réparer un item.", "/repair ou /repair all", []),
			new Back("back", "Réapparaître à sa dernière mort.", "/back", []),
		];
		Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX, $commands);
		$commandCount = count($commands);
		Base::getInstance()->getLogger()->info("Commande Gradé chargé: " . $commandCount);
	}
}