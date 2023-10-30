<?php

namespace Stef\Task;

use pocketmine\scheduler\Task;
use Stef\Utils\KitUtils;

class Kit extends Task
{
	public function onRun(): void {
		$allData = KitUtils::$cooldowns->getAll();

		foreach ($allData as $grade => $cooldownData) {
			if (!is_array($cooldownData)) {
				continue;
			}

			foreach ($cooldownData as $player => $cooldownArray) {
				if (!is_array($cooldownArray)) {
					continue;
				}

				foreach ($cooldownArray as $playerName => $cooldown) {
					if (is_numeric($cooldown)) {
						$cooldownArray[$playerName] = $cooldown - 1;

						if ($cooldownArray[$playerName] <= 0) {
							unset($cooldownArray[$playerName]);
						}
					}
				}

				$cooldownData[$player] = $cooldownArray;
			}

			KitUtils::$cooldowns->setNested("$grade", $cooldownData);
		}

		KitUtils::$cooldowns->save();
	}




}