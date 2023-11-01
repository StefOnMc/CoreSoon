<?php

namespace Stef\Task;

use pocketmine\scheduler\Task;
use Stef\Utils\MuteUtils;
use Stef\Utils\WebhookUtils;

class Mute extends Task
{
	public function onRun(): void {
		$muteData = MuteUtils::$mute->get("mutetime", []);

		if ($muteData === null) {
			$muteData = [];
		}

		foreach ($muteData as $player => $data) {
			$time = $data["time"];
			$reason = $data["reason"];

			$time--;

			if ($time <= 0) {
				unset($muteData[$player]);
				WebhookUtils::Mute($player . " a été unmute automatiquement. Raison : " . $reason);
			} else {
				$data["time"] = $time;
				$muteData[$player] = $data;
			}
		}

		MuteUtils::$mute->set("mutetime", $muteData);
		MuteUtils::$mute->save();
	}

}