<?php

namespace Stef\Task;

use pocketmine\scheduler\Task;
use Stef\Base;
use Stef\Utils\BanUtils;
use Stef\Utils\WebhookUtils;

class Ban extends Task
{
	public function onRun(): void {
		$banData = BanUtils::$ban->get("bantime", []);

		if ($banData === null) {
			$banData = [];
		}

		foreach ($banData as $player => $data) {
			$banTime = $data["time"];
			$reason = $data["reason"];

			$banTime--;

			if ($banTime <= 0) {
				unset($banData[$player]);
				WebhookUtils::Ban($player . " a été unban automatiquement. Raison : " . $reason);
				Base::getInstance()->getLogger()->notice($player . " a été unban automatiquement. Raison :" . $reason);
			} else {
				$data["time"] = $banTime;
				$banData[$player] = $data;
			}
		}

		BanUtils::$ban->set("bantime", $banData);
		BanUtils::$ban->save();
	}
}