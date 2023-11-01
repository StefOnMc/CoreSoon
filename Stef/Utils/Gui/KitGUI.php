<?php

namespace Stef\Utils\Gui;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use Stef\Base;
use Stef\Utils\KitUtils;

class KitGUI
{
public static function send(Player $sender){
	$kit = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
	$kit->setName("§c- §bKit §c-");
	$kit->getInventory()->setItem(0,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(1,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(9,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(7,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(8,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(17,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(36,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(45,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(46,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(44,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(52,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(53,VanillaBlocks::STAINED_GLASS()->setColor(DyeColor::LIGHT_BLUE())->asItem());
	$kit->getInventory()->setItem(11,VanillaItems::BLEACH()->setCustomName("Kit §7Joueur"));
	$kit->getInventory()->setItem(12,VanillaItems::COPPER_INGOT()->setCustomName("Kit §cOutils"));
	$kit->getInventory()->setItem(13,VanillaItems::COMPASS()->setCustomName("Grade 1"));
	$kit->getInventory()->setItem(14,VanillaItems::AMETHYST_SHARD()->setCustomName("Grade 2"));
	$kit->getInventory()->setItem(15,VanillaItems::GOLDEN_CARROT()->setCustomName("Grade 3"));
	$kit->getInventory()->setItem(16,VanillaItems::RAW_GOLD()->setCustomName("Grade 4"));
	$kit->getInventory()->setItem(18,VanillaItems::BONE()->setCustomName("Grade 5"));;
	$kit->getInventory()->setItem(20,VanillaItems::BRICK()->setCustomName("Kit §eStar"));
	$kit->getInventory()->setItem(21,VanillaItems::ARROW()->setCustomName("Kit §cYou§rtube"));
	$kit->getInventory()->setItem(22,VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->setCustomName("Kit §6Premium"));
	$kit->setListener(function (InvMenuTransaction $transaction) use ($sender,$kit): InvMenuTransactionResult {
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BLEACH()->getTypeId()){
			if(KitUtils::hasCooldown($sender->getName(),"star")){
				$temps = KitUtils::getTime($sender->getName(),"star");
				$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
			}else{
				if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
					KitUtils::setCooldown($sender->getName(),6,"heure","star");
					$sender->sendMessage("§aVous avez bien claim le kit §eStar");
				}else{
					$sender->sendMessage("vous ne pouvez pas récupéré");
				}
				// item
			}
			$kit->onClose($sender);
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::COPPER_INGOT()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::COMPASS()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::AMETHYST_SHARD()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::GOLDEN_CARROT()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::RAW_GOLD()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BONE()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::BRICK()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::ARROW()->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		if($transaction->getItemClicked()->getTypeId() === VanillaItems::POTION()->setType(PotionType::NIGHT_VISION())->getTypeId()){
			if($sender->hasPermission("kit.star")){
				if(KitUtils::hasCooldown($sender->getName(),"star")){
					$temps = KitUtils::getTime($sender->getName(),"star");
					$sender->sendMessage("Il reste " . $temps . " pour récupérer le kit.");
				}else{
					if($sender->getInventory()->canAddItem(VanillaItems::COPPER_INGOT())){
						KitUtils::setCooldown($sender->getName(),6,"heure","star");
						$sender->sendMessage("§aVous avez bien claim le kit §eStar");
					}else{
						$sender->sendMessage("vous ne pouvez pas récupéré");
					}
					// item
				}
				$kit->onClose($sender);
			}else{
				$sender->sendMessage(Base::NO_PERM);
			}
		}
		return $transaction->discard();
	});
	$kit->send($sender);
}
}