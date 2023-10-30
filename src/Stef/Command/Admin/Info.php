<?php

namespace Stef\Command\Admin;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\Utils;
use Stef\Base;

class Info extends VanillaCommand
{
	private $purePerms;
	public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("info.use");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if($sender instanceof Player){
			if($sender->hasPermission("info.use")){
				if(isset($args[0])){
					$t = Base::getInstance()->getServer()->getPlayerByPrefix($args[0]);
					if($t === null){
						$sender->sendMessage("§cLe joueur n'est pas connécté.");
					}else{
						$this->purePerms = Base::getInstance()->getServer()->getPluginManager()->getPlugin("PurePerms");
						$timestamp = $t->getFirstPlayed() / 1000;
						$date = new \DateTime("@$timestamp");
						$dateFormat = new \DateTimeZone('Europe/Paris');
						$date->setTimezone($dateFormat);
						$eu = $date->format('d/m/Y à H:i:s');
						$sender->sendMessage("§aInformation du joueur ". $t->getName().".\n");
						$sender->sendMessage("§e Grade: §a ". $this->getPlayerRank($t));
						$sender->sendMessage("§e Argent: ". EconomyAPI::getInstance()->myMoney($t));
						$sender->sendMessage("§cPremiere connexion: §a ". $eu);
						$sender->sendMessage("§e Os: §b ". Utils::getOS(true));
						$sender->sendMessage("§e Gamemode: ".$t->getGamemode()->name());
					}
				}else{
					$sender->sendMessage("§c/info joueur");
				}

			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
	}
	public function getPlayerRank(Player $player): string{
		$group = $this->purePerms->getUserDataMgr()->getData($player)['group'];

		if($group !== null){
			return $group;
		}else{
			return "...";
		}
	}
}