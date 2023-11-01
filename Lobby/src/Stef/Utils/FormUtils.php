<?php

namespace Stef\Utils;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use Stef\Loader;

class FormUtils
{
public static function Send(Player $p){
$form = new SimpleForm(function(Player $p,$data){
if($data === null){
	$p->sendMessage(Loader::getInstance()->getConfig()->getNested("Form-compass.close"));
}
switch ($data){
	case 0:
		$p->transfer(Loader::getInstance()->getConfig()->getNested("Network.Ip"),Loader::getInstance()->getConfig()->getNested("Network.Port"));
}
});

$form->setTitle(Loader::getInstance()->getConfig()->getNested("Form-compass.name"));
$form->addButton(Loader::getInstance()->getConfig()->getNested("Form-compass.button"));
$p->sendForm($form);
}
}