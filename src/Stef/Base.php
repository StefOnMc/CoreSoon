<?php

namespace Stef;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use Stef\Utils\CommandUtils;
use Stef\Utils\EventUtils;
use Stef\Utils\InvmenuUtils;
use Stef\Utils\KitUtils;
use Stef\Utils\TaskUtils;
use Stef\Utils\WebhookUtils;

class Base extends PluginBase
{
    use SingletonTrait;

	const PREFIX =  "§a Soon §c » ";
	const NO_PERM= "§c Vous n'avez pas la permission.";
	public bool $joinop = false;
	public bool $creativedirect = false;
	// combat jsp illogique php
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
       CommandUtils::RegisterPlayer();
       CommandUtils::RegisterRole();
       CommandUtils::RegisterStaff();
	   // event
		EventUtils::RegistryEvent($this);
		// task
		TaskUtils::RegistryTask();
		// Inv
		InvmenuUtils::RegistryInv($this);
		KitUtils::$cooldowns = new Config($this->getDataFolder() . "cooldowns.yml", Config::YAML);
// Logs
		$date = new \DateTime();
		$dateFormat = new \DateTimeZone('Europe/Paris');
		$date->setTimezone($dateFormat);
		$eu = $date->format('d/m/Y à H:i:s');
		WebhookUtils::SrvStart("Le serveur vien de s'allumer le ". $eu);
    }
    protected function onDisable(): void
    {
		//Logs
		$date = new \DateTime();
		$dateFormat = new \DateTimeZone('Europe/Paris');
		$date->setTimezone($dateFormat);
		$eu = $date->format('d/m/Y à H:i:s');
		WebhookUtils::SrvStop("Le serveur vien de s'eteindre le " . $eu);
		// combat
		foreach (Base::$pc as $playerName) {
			unset(Base::$pc[$playerName]);
		}
        $this->getLogger()->notice("Core déchargé.");
    }
}