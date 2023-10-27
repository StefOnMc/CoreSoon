<?php

namespace Stef\Utils;

use pocketmine\plugin\PluginBase;
use Stef\Base;
use Stef\Listener\AntiLeak;
use Stef\Listener\Fight;
use Stef\Listener\Safe;

class EventUtils
{
public static function RegistryEvent(PluginBase $c){
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Safe(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new Fight(),$c);
	Base::getInstance()->getServer()->getPluginManager()->registerEvents(new AntiLeak(),$c);
}
}