<?php

namespace Stef\Utils;

use pocketmine\plugin\PluginBase;
use Stef\Listener\Item;
use Stef\Listener\Safezone;
use Stef\Listener\Welcome;
use Stef\Loader;

class EventUtils
{
public static function Register(PluginBase $c){
Loader::getInstance()->getServer()->getPluginManager()->registerEvents(new Item(),$c);
Loader::getInstance()->getServer()->getPluginManager()->registerEvents(new Safezone(),$c);
Loader::getInstance()->getServer()->getPluginManager()->registerEvents(new Welcome(),$c);
}
}