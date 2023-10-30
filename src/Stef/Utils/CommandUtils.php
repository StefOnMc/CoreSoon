<?php

namespace Stef\Utils;

use Stef\Base;
use Stef\Command\Admin\Forceclear;
use Stef\Command\Admin\Info;
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

class CommandUtils
{
	public static function Unregister(){
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("me"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("ver"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("kill"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("clear"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("say"));
		Base::getInstance()->getServer()->getCommandMap()->unregister(Base::getInstance()->getServer()->getCommandMap()->getCommand("msg"));
	}
	public static function Init(){
		self::RegisterPlayer();
		self::RegisterRole();
		self::RegisterStaff();
	}
private static function RegisterPlayer(){
    Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX,[
        new Nv("nv","Avoir l'effet de night vision.","/nv",[]),
		new Event("event","Ouvre une interface.","/event",[]),
		new Spawn("spawn","Se téleporté au spawn.","/spawn",["hub"]),
		new Minage("minage","Se téleporté au minage.","/minage",[]),
		new Kit("kit","Avoir sont kit.","/kit",[]),
		new Eshop("eshop","Enchanter vos items.","/eshop",[]),
		new Msg("msg","écrire un msg a quelqu'un.","/msg",[]),
    ]);
}
    private static function RegisterStaff(){
        Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX,[
            new Stats("stats","Voir les stastistique du serveur.","/stats player & server",[""]),
			new Info("info","Voir les statistiques d'un joueur.","/info joueur",[""]),
			new Forceclear("forceclear","Forcer le clearlag.","/forceclear",["fc"]),
			new Say("say","Faire une annonce.","/say msg",[]),
        ]);
    }
    private static function RegisterRole(){
        Base::getInstance()->getServer()->getCommandMap()->registerAll(Base::PREFIX,[
            new Craft("craft","Ouvre un établi.","/craft",[]),
            new Ec("ec","Ouvre un enderchest.","/ec",[]),
			new Trash("trash","Ouvre une poubelle.","/trash",[]),
			new Repair("repair","Permet de réparé un item.","/repair ou /repair all",[]),
			new Back("back","Réaparaitre a sa derniere mort.","/back",[])
        ]);
    }
}