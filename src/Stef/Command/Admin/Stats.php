<?php

namespace Stef\Command\Admin;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use Stef\Base;

class Stats extends VanillaCommand
{
    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("stats.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
{
if($sender instanceof Player){
    if($sender->hasPermission("stats.use")){
        if(isset($args[0])){
            switch ($args[0]){
                case "player":
					$playerNames = array_map(function(Player $player) : string{
						return $player->getName();
					}, array_filter($sender->getServer()->getOnlinePlayers(), function(Player $player) use ($sender) : bool{
						return !($sender instanceof Player) || $sender->canSee($player);
					}));
                    $sender->sendMessage("§aListe des joueurs conéctée  " ."(".count($playerNames).")");
                    break;
                case "server":

                    $server = $sender->getServer();
                    $tpsColor = TextFormat::GREEN;
                    if($server->getTicksPerSecond() < 12){
                        $tpsColor = TextFormat::RED;
                    }elseif($server->getTicksPerSecond() < 17){
                        $tpsColor = TextFormat::GOLD;
                    }

                    $time = (int) (microtime(true) - $server->getStartTime());

                    $seconds = $time % 60;
                    $minutes = null;
                    $hours = null;
                    $days = null;

                    if($time >= 60){
                        $minutes = floor(($time % 3600) / 60);
                        if($time >= 3600){
                            $hours = floor(($time % (3600 * 24)) / 3600);
                            if($time >= 3600 * 24){
                                $days = floor($time / (3600 * 24));
                            }
                        }
                    }

                    $uptime = ($minutes !== null ?
                            ($hours !== null ?
                                ($days !== null ?
                                    "$days jour "
                                    : "") . "$hours heures "
                                : "") . "$minutes minutes "
                            : "") . "$seconds secondes";
                    $date = new \DateTime();
                    $dateFormat = new \DateTimeZone('Europe/Paris');
                    $date->setTimezone($dateFormat);
                    $eu = $date->format('H:i');
                    $sender->sendMessage("§aStatstique du serveur  à " . $eu);

                    $sender->sendMessage("§cUptime actuel : ". $uptime);
                    $sender->sendMessage("§bTps actuel : {$tpsColor}{$server->getTicksPerSecond()} ({$server->getTickUsage()}%)");
                    $sender->sendMessage("§bTps moyen : {$tpsColor}{$server->getTicksPerSecondAverage()} ({$server->getTickUsageAverage()}%)");
                    break;
                default:
                    $sender->sendMessage("§c /stats player & server");
            }
        }
    }else{
        $cfg = Base::getInstance()->getConfig();
        $sender->sendMessage($cfg->getNested("Message.perm"));
    }
}
}
}