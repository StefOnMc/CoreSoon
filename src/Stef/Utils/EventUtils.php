<?php

namespace Stef\Utils;

use pocketmine\plugin\PluginBase;
use Stef\Base;
use Stef\Listener\_Server;
use Stef\Listener\Arrivage;
use Stef\Listener\Death;
use Stef\Listener\Fight;
use Stef\Listener\ItemUse;
use Stef\Listener\Logs;
use Stef\Listener\Modération;
use Stef\Listener\Open;
use Stef\Listener\Safe;
use Stef\Listener\Server;

class EventUtils
{
public static function RegistryEvent(PluginBase $c)
{

	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Safe(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Arrivage(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Death(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Fight(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Server(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Open(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new ItemUse(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Logs(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Modération(),$c);
}
}