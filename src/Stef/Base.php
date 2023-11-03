<?php

namespace Stef;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Stef\Utils\BanUtils;
use Stef\Utils\CommandUtils;
use Stef\Utils\EventUtils;
use Stef\Utils\InvmenuUtils;
use Stef\Utils\KitUtils;
use Stef\Utils\MuteUtils;
use Stef\Utils\TaskUtils;
use Stef\Utils\TimeUtils;
use Stef\Utils\WebhookUtils;

class Base extends PluginBase
{
    use SingletonTrait;

	const PREFIX = "§a Soon §c » ";
	const IP = "soon.fr";
	const PORT = 19132;

	const NO_PERM = "§c Vous n'avez pas la permission.";
	public static array $pc = [];
	public static array $back = [];
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
	   CommandUtils::Unregister();
    }

    protected function onEnable(): void
    {
       $this->getLogger()->notice("Core chargé.");
	   // command
       CommandUtils::Init();
	   // event
		EventUtils::RegistryEvent($this);
		// task
		TaskUtils::RegistryTask();
		// Inv
		InvmenuUtils::RegistryInv($this);
		// Kit
		KitUtils::Init();
		// Mods
		MuteUtils::Init();
		BanUtils::Init();
		// Logs
		WebhookUtils::SrvStart("Le serveur vien de s'allumer le ". TimeUtils::GetActualTime());
    }
    protected function onDisable(): void
    {
		//Logs
		WebhookUtils::SrvStop("Le serveur vien de s'eteindre le " . TimeUtils::GetActualTime());
		// Combat
		foreach (Base::$pc as $playerName) {
			unset(Base::$pc[$playerName]);
		}
        $this->getLogger()->notice("Core déchargé.");
    }
}