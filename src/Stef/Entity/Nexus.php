<?php



declare(strict_types=1);

namespace Stef\Entity;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\WebhookUtils;
use function mt_rand;

class Nexus extends Living {
	private ?Player $killer = null;
	public static function getNetworkTypeId() : string{ return EntityIds::ENDER_CRYSTAL; }

	protected function getInitialSizeInfo() : EntitySizeInfo{
		return new EntitySizeInfo(0.3, 0.3); //TODO: eye height ??
	}

	public function getName() : string{
		return "Nexus";
	}
	// a debug
	protected function onDeath(): void
	{
		$c = \Stef\Listener\Nexus::$name;
		foreach ($c as $s){
			Base::getInstance()->getServer()->broadcastMessage($s . " vien de gagner");
\Stef\Command\Admin\Nexus::$nexuss = false;
				WebhookUtils::Nexus($s . " vien de vaincre le Nexus !");
		}
		\Stef\Listener\Nexus::$name = [];
		}

	public function getDrops() : array{
		$drops = [
			VanillaItems::ENDER_PEARL()
		];

		return $drops;
	}
}