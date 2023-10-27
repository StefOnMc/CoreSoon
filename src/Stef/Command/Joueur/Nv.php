<?php

namespace Stef\Command\Joueur;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class Nv extends VanillaCommand
{
    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("nv.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
{
   if($sender instanceof Player){
       if($sender->getEffects()->has(VanillaEffects::NIGHT_VISION())){
           $sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
           $sender->sendMessage("§cVous avez perdu l'effet.");
       }else{
$sender->sendMessage("§aVous avez reçu l'effet vision nocturne.");
$sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(),99999999,4));
       }
   }
}
}