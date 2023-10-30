<?php

declare(strict_types=1);

namespace Stef\Utils\Gui;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\graphic\InvMenuGraphic;
use muqsit\invmenu\type\InvMenuType;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;
use pocketmine\block\inventory\FurnaceInventory;
use pocketmine\block\VanillaBlocks;
use pocketmine\crafting\FurnaceType;
use pocketmine\inventory\Inventory;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;
use pocketmine\world\Position;

final class Furnacetypegui implements InvMenuType{

	private InvMenuType $inner;

	public function __construct(){
		$this->inner = InvMenuTypeBuilders::BLOCK_FIXED()
			->setBlock(VanillaBlocks::FURNACE())
			->setSize(2)
			->setNetworkWindowType(WindowTypes::FURNACE)
			->build();
	}

	public function createGraphic(InvMenu $menu, Player $player) : ?InvMenuGraphic{
		return $this->inner->createGraphic($menu, $player);
	}

	public function createInventory() : Inventory{
		return new FurnaceInventory(Position::fromObject(Vector3::zero(), null),FurnaceType::FURNACE());
	}
}