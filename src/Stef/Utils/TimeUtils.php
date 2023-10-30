<?php

namespace Stef\Utils;

class TimeUtils
{
public static function GetActualTime(){
	$date = new \DateTime();
	$dateFormat = new \DateTimeZone('Europe/Paris');
	$date->setTimezone($dateFormat);
	$eu = $date->format('d/m/Y à H:i:s');
	return $eu;
}
	public static function FormatTime($seconds) {
		if ($seconds >= 86400) {
			$days = floor($seconds / 86400);
			$hours = floor(($seconds % 86400) / 3600);
			$minutes = floor(($seconds % 3600) / 60);
			return "$days jour(s), $hours heure(s) et $minutes minute(s)";
		} elseif ($seconds >= 3600) {
			$hours = floor($seconds / 3600);
			$minutes = floor(($seconds % 3600) / 60);
			return "$hours heure(s) et $minutes minute(s)";
		} elseif ($seconds >= 60) {
			$minutes = floor($seconds / 60);
			return "$minutes minute(s)";
		} else {
			return "$seconds seconde(s)";
		}
	}
}