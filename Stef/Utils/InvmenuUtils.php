<?php

namespace Stef\Utils;

use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use Stef\Utils\Gui\CraftTypegui;
use Stef\Utils\Gui\Furnacetypegui;

class InvmenuUtils
{
	public const INV_MENU_TYPE_WORKBENCH = "core:workbench";
	public const INV_MENU_TYPE_FURNACE = "core:furnace";
	public static function RegistryInv(PluginBase $c): void
	{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($c);
		}
		InvMenuHandler::getTypeRegistry()->register(self::INV_MENU_TYPE_FURNACE, new Furnacetypegui());
		InvMenuHandler::getTypeRegistry()->register(self::INV_MENU_TYPE_WORKBENCH, new CraftTypegui());
	}

}