<?php

namespace Stef;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Stef\Utils\EventUtils;
use Stef\Utils\TaskUtils;

class Loader extends PluginBase
{
use SingletonTrait;
protected function onLoad(): void
{
	self::setInstance($this);
}
protected function onEnable(): void
{
	@mkdir($this->getDataFolder());
	$this->saveResource("config.yml");
	$this->getLogger()->notice($this->getConfig()->getNested("Logger.Enable"));
	$this->getServer()->getNetwork()->setName($this->getConfig()->getNested("Network.Name"));
	TaskUtils::Register();
	EventUtils::Register($this);
}
protected function onDisable(): void
{
	$this->getLogger()->notice($this->getConfig()->getNested("Logger.Disable"));
}

}