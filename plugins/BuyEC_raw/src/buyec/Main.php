<?php

namespace buyec;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\Enchantment;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase {
	
	public $eco;
	public $enchants;
	
	public function onEnable() {
		$this->eco = EconomyAPI::getInstance();
		
		$this->enchant = ["§c§l0: §6Protection","§c§l1:§6Fire Protection","§c§l2:§6Feather Falling","§c§l3:§6Blast Protection","§c§l4:§6Projectile Protection","§c§l5:§6Thorns","§c§l6:§6Respiration","§c§l7:§6Depth Strider","§c§l8:§6Aqua Affinity","§c§l9:§6Sharpness","§c§l10:§6Smite","§c§l11:§6Bane of Athropods","§c§l12:§6Knockback","§c§l13:§6Fire Aspect","§c§l14:§6Looting","§c§l15:§6Efficiency","§c§l16:§6Silk Touch","§c§l17:§6Unbreaking","§c§l18:§6Fortune","§c§l19:§6Power","§c§l20:§6Punch","§c§l21:§6Flame","§c§l22:§6Infinity","§c§l23:§6Luck of the Sea",
"§c§l24:§6Lure"];
	}
	
	/*
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	!                                !
	!     Khong them dau vao chu     !
	!                                !
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	*/
	
	public function onCommand(CommandSender $s, Command $cmd, $label, array $args) {
		
		if($cmd->getName() == "muaec") {
			
		  if(isset($args[0]) && isset($args[1])) {
			  
			  if(is_numeric($args[0])) {
				  
				if(is_numeric($args[1])) {
					
				  if($this->eco->myMoney($s->getName()) >= $args[1] ."000") {
					  
					  
		$enchantLevel = $args[1] <= 5 ? $args[1] : 1;
		$enchantId = $args[0];
		
		
		$enchantment = Enchantment::getEnchantment($enchantId);
		
		if($enchantment->getId() === Enchantment::TYPE_INVALID){
			
			$enchantment = Enchantment::getEnchantmentByName($enchantId);
			
			if($enchantment->getId() === Enchantment::TYPE_INVALID){
	    		$s->sendMessage("•§a§lKhông Tìm Thy Enchant");
				return true;
			}
		}
		$id = $enchantment->getId();
		$maxLevel = Enchantment::getEnchantMaxLevel($id);
		if($enchantLevel > $maxLevel or $enchantLevel <= 0){
			$s->sendMessage("Max Enchant Level:". $maxLevel);
			return true;
		}
		
		$enchantment->setLevel($enchantLevel);
		$item = $s->getInventory()->getItemInHand();
		if($item->getId() <= 0){
			$s->sendMessage("§a§l•Không Tìm Thy Item enchant");
			return true;
		}
		
		if(Enchantment::getEnchantAbility($item) === 0){
			$s->sendMessage("§a§l•Không Th Enchant");
			return true;
		}
		$item->addEnchantment($enchantment);
		$s->getInventory()->setItemInHand($item);
						
						$this->eco->reduceMoney($s->getName(), $args[1] ."000");
						
						$s->sendMessage("Enchant thành công!");
						return true;
				  } else {
					  $s->sendMessage("Không  tin");
					  return false;
				  }
				} else {
					$s->sendMessage("Level phi là s");
					return false;
				}
			  
		  } else {
			  $s->sendMessage("ID phi là s");
		     return false;
		  }
		} else {
			$s->sendMessage("/muaec <name|id> <level>");
			return false;
		}
		}
		
		if($cmd->getName() == "listec") {
			
		  if(isset($args[0])) {

			 			  $pages = array_chunk($this->enchant, 5);
			  if($args[0] <= count($pages) || $args[0] < 1) {
				  
			  
			  $s->sendMessage("Trang ". $args[0] ."/". count($pages));
			  $s->sendMessage("(Tên trc, ID sau)");
			  foreach($pages[$args[0] - 1] as $enchant) {
				  $is = explode(":", $enchant);
				  $s->sendMessage("| ". $is[1] .":". $is[0]);
			  }
			  $s->sendMessage("de mua mot enchant, thuc hien len: /muaec <ID> <cap(toi da la cap 5)>");
			  return true;
		  } else {
			  $s->sendMessage("Khong tim thay trang dó");
			  return false;
		  }
		  } else {
			  $s->sendMessage("/listec 1");
			  return true;
		  }
		}
	}
}