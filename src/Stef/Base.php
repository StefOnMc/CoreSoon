<?php

namespace Stef;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Stef\Command\CommandMgr;
use Stef\Listener\AntiLeak;
use Stef\Listener\Fight;
use Stef\Listener\Safe;
use Stef\Task\Clearlag;
use Stef\Task\Combat;
use Stef\Task\Message;
use Stef\Utils\CommandUtils;
use Stef\Utils\EventUtils;
use Stef\Utils\InvmenuUtils;
use Stef\Utils\TaskUtils;

class Base extends PluginBase
{
    use SingletonTrait;

	const PREFIX =  "§a Soon §c » ";
	// combat jsp illogique php
	public static array $pc = [];
	// aussi
	public static array $msg = [
		"oe",
		"nn",
		"salut",
		"e",
		"eee",
	];
    protected function onLoad(): void
    {
       self::setInstance($this);
    }

    protected function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
       $this->getLogger()->notice("Core chargé.");
	   // command
       CommandUtils::RegisterPlayer();
       CommandUtils::RegisterRole();
       CommandUtils::RegisterStaff();
	   // event
		EventUtils::RegistryEvent($this);
		// task
		TaskUtils::RegistryTask();
		// Inv
		InvmenuUtils::RegistryInv($this);

    }
    protected function onDisable(): void
    {
		foreach (Base::$pc as $playerName) {
			unset(Base::$pc[$playerName]);
		}
        $this->getLogger()->notice("Core déchargé.");
    }
}