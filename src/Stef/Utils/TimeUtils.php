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
}