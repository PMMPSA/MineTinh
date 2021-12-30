<?php 

namespace trade9; 

use pocketmine\command\Command; 
use pocketmine\command\CommandSender; 
use pocketmine\command\ConsoleCommandSender; 
use pocketmine\event\player\PlayerDropItemEvent; 
use pocketmine\event\Listener; 
use pocketmine\plugin\PluginBase; 
use pocketmine\Server; 
use pocketmine\item\enchantment\Enchantment; 
use pocketmine\item\Item; 
use pocketmine\Player; 
use pocketmine\utils\TextFormat as TF; 

class Main extends PluginBase implements Listener{ 

public function onEnable(){ 
$this->getServer()->getPluginManager()->registerEvents($this, $this); 
$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
$this->ce = $this->getServer()->getPluginManager()->getPlugin("PTKCustomEnchants");
$this->getLogger()->info("Enabled"); 
          } 
          
     public function onDrop(PlayerDropItemEvent $e)
      {
           if($e->getPlayer()->getInventory()->getItemInHand()->getCustomName() == "§l§c❖ §e✘§b Cúp §1V§6Craft §dMega §e✘§c❖")
                {
       $e->setCancelled(true);
     }
}
          
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){ 
         if ($cmd->getName() == "choden"){     
         if(isset($args[0])){ 
      switch(strtolower($args[0])){ 
       case "danhsach": 
       case "help":
       case "list":
       case "trogiup":
       $sender->sendMessage("§d§l♦ §aSử Dụng Lệnh §b/choden (vật phẩm) §aĐể Mua Đồ"); 
       $sender->sendMessage("§6§l• §l§c❖ §e✘§bCúp §1Mine§6New§dMega §e✘§c❖ §e- §d8000000 Xu§b[§6Cú Pháp: cupminenewmega§b] [§r§5§oLOCKED§b§5§l]"); 
       $sender->sendMessage("§6§l• §l§o§c❖ §fKiếm §aCanh Tý §c❖ §c- §d640 Nether Star §b[§6Cú Pháp: kiemcanhty§b]");
       $sender->sendMessage("§6§l• §l§o§c❖ §fMũ §bCanh Tý §c❖ §c- §d30 Nether Star§b[§6Cú Pháp: mucanhty§b]");
       $sender->sendMessage("§6§l• §l§o§c❖ §fÁo §dCanh §bTý §c❖ §c- §d30 Nether Star §b[§6Cú Pháp: aocanhty§b]");
       $sender->sendMessage("§6§l• §l§o§c❖ §fQuần §aCanh §6Tý§c ❖ §c- §d30 Nether Star§b[§6Cú Pháp: quancanhty§b]");
       $sender->sendMessage("§6§l• §l§o§c❖ §fGiày §6Canh §8Tý§e§c ❖ §c- §d30 Nether Star §b[§6Cú Pháp: giaycanhty§b]");
       break;
     case "cupminenewmega": 
$item = Item::get(278, 0, 1); 
$item->setCustomName("§l§c❖ §e✘§b Cúp §1Mine§6New §dMega §e✘§c❖"); 
if($this->eco->myMoney($sender->getName()) >= 8000000){ 
$item->setLore(array("§l§c❖ §e✘ §bCúp §1Mine§6New §dMega §e✘§c❖\n§l§dĐộ Hiếm:§e  ▬▬▬ \n§l§aĐộ Bền: §e ▬▬▬▬▬▬\n§l§3Độ Bá: §d ▬▬▬▬ \n§c§l⚠ §bCustom Enchant §c⚠\n§1§lAutorepair II §4- §aKhi Di Chuyển Cúp Sẽ Tự Động Được Sửa Chữa\n§5§lJackpot I §4- §aKhi Đào Những Khoáng Sản Có Dạng Khối Sẽ Tự Động Ra Thành Phẩm\n§c§l⚠ §eEnchant §c⚠\n§l§cChậm Hỏng: §b200\n§l§aHiệu Suất: §b50\n§o§l§5LOCKED")); 
$this->eco->reduceMoney($sender->getName(), 8000000);
$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(200)); 
$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(50)); 
$this->ce->addEnchantment($item, Jackpot, 1, $check = true, $sender);
$this->ce->addEnchantment($item, Autorepair, 2, $check = true, $sender);
$sender->getInventory()->addItem($item); 
$sender->sendMessage("§9[§1Mine§6New§9]§b» ".TF::YELLOW . "§l§c❖ §e✘§bCúp §1V§6Craft §dMega §e✘§c❖"); 
} else { 
$sender->sendMessage("§9[§1Mine§6New§9]§b» ".TF::RED . "Bạn Không Có Đủ Tiền Để Mua"); 
} 
break; 
case "kiemcanhty": 
$p = $this->getServer()->getPlayer($sender->getName()); 
$item = Item::get(276, 0, 1); 
$item->setCustomName(" §l§o§c❖ §fKiếm §aCanh Tý §c❖"); 
if ($sender->getInventory()->contains(Item::get(399,0,640))){ 
$item->setLore(array(" l§o§c=======§e[§bINFO§e]§c======= \n§a Độ Bá: ■■■■■■■ \n§a Độ Hiếm: ■■■■■■■ \n§e -Kỹ Năng- \n§cBlind I\n §dSet §eCanh Tý§d Đã Có Từ Rất Lâu Đời Được Tu Luyện Cách Đây 22 Thế Kỉ \n§a [§6+] §eKiếm Canh Tý Thường Nhận Ở Sự Kiện Tết \n§b ✔Tết 2020✔ \n§c HAPPY §eNEW §dYEAR")); 
$sender->getInventory()->removeItem(Item::get(399,0,640)); 
$item->addEnchantment(Enchantment::getEnchantment(9)->setLevel(50)); 
$item->addEnchantment(Enchantment::getEnchantment(34)->setLevel(100)); 
$item->addEnchantment(Enchantment::getEnchantment(12)->setLevel(2)); 
$sender->getInventory()->setItemInHand($item); 
$this->getServer()->dispatchCommand($sender, "ce ec Blind 1");
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::YELLOW . " §l§o§c❖ §fKiếm §aCanh Tý§c ❖ §b10Viên NetherStar"); 
} else{ 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi"); 
} 
break; 
case "mucanhty": 
$p = $this->getServer()->getPlayer($sender->getName()); 
$item = Item::get(310, 0, 1); 
$item->setCustomName("§l§o§c❖ §fMũ §bCanh Tý §c❖"); 
if ($sender->getInventory()->contains(Item::get(399,0,30))){ 
$item->setLore(array(" §l§c§o=======§e[§bINFO§e]§c======= \n§a Độ Bá: ■■■■■■■■■■ \n§a Độ Hiếm: ■■■■■■■■■■ \n§e [§a+§e] §bVật Phẩm: §cHiếm \n§6 ✘Enchant✘ \n§a ➱§e Có Độ Bền:§b600 \n§a ➱§e Có Độ Bảo Vệ:§b1350 \n§a ➱§e Gai:§b5 \n§a ➱ §6Chỉ Xuất Hiện Ở Dịp Tết \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰ \n§a •§cNgười Tạo: §eYTB_Jero §a(OWNER) \n§a ✔§cGiá Thị Trường:§e 200.000Xu \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰")); 
$sender->getInventory()->removeItem(Item::get(399,0,30)); 
$item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1350)); 
$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(600)); 
$item->addEnchantment(Enchantment::getEnchantment(5)->setLevel(5)); 
$sender->getInventory()->setItemInHand($item); 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::YELLOW . " §l§o§e30 NetherStar §a➱➱ §fMũ §eCanh §6Tý"); 
} else{ 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi"); 
} 
break; 
case "aocanhty":
$p = $this->getServer()->getPlayer($sender->getName()); 
$item = Item::get(311, 0, 1); 
$item->setCustomName(" §l§o§c❖ §fÁo §dCanh §bTý §c❖"); 
if ($sender->getInventory()->contains(Item::get(399,0,30))){ 
$item->setLore(array("§l§c§o=======§e[§bINFO§e]§c======= \n§a Độ Bá: ■■■■■■■■■■ \n§a Độ Hiếm: ■■■■■■■■■■ \n§e [§a+§e] §bVật Phẩm: §cHiếm \n§6 ✘Enchant✘ \n§a ➱§e Có Độ Bền:§b600 \n§a ➱§e Có Độ Bảo Vệ:§b1350 \n§a ➱§e Gai:§b5 \n§a ➱ §6Chỉ Xuất Hiện Ở Dịp Tết \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰ \n§a •§cNgười Tạo: §eYTB_Jero§a(OWNER) \n§a ✔§cGiá Thị Trường:§e 200.000Xu \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰")); 
$sender->getInventory()->removeItem(Item::get(399,0,30)); 
$item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1350)); 
$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(600)); 
$item->addEnchantment(Enchantment::getEnchantment(5)->setLevel(5)); 
$sender->getInventory()->setItemInHand($item); 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::YELLOW . " §l§o§e30 NetherStar§a➱➱ §fÁo §dCanh §bTý"); 
}else{ 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
} 
break;
case "quancanhty":
 $p = $this->getServer()->getPlayer($sender->getName()); 
$item = Item::get(312, 0, 1); 
$item->setCustomName(" §l§o§c❖ §fQuần §aCanh §6Tý§c ❖"); 
if ($sender->getInventory()->contains(Item::get(399,0,30))){ 
$item->setLore(array("§l§c§o=======§e[§bINFO§e]§c======= \n§a Độ Bá: ■■■■■■■■■■ \n§a Độ Hiếm: ■■■■■■■■■■ \n§e [§a+§e] §bVật Phẩm: §cHiếm \n§6 ✘Enchant✘ \n§a ➱§e Có Độ Bền:§b600 \n§a ➱§e Có Độ Bảo Vệ:§b1350 \n§a ➱§e Gai:§b5 \n§a ➱ §6Chỉ Xuất Hiện Ở Dịp Tết \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰ \n§a •§cNgười Tạo: §eYTB_Jero §a(OWNER) \n§a ✔§cGiá Thị Trường:§e 200.000Xu \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰")); 
$sender->getInventory()->removeItem(Item::get(399,0,30)); 
$item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1350)); 
$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(600)); 
$item->addEnchantment(Enchantment::getEnchantment(5)->setLevel(5)); 
$sender->getInventory()->setItemInHand($item); 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::YELLOW . " §l§o§e30 NetherStar §a➱➱§f Quần §aCanh §eTý"); 
}else{ 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
} 
break;
case "giaycanhty": 
$p = $this->getServer()->getPlayer($sender->getName()); 
$item = Item::get(313, 0, 1); 
$item->setCustomName("§l§o§e§fGiày §6Canh §8Tý§e"); 
if ($sender->getInventory()->contains(Item::get(399,0,704))){ 
$item->setLore(array(" §l§c§o=======§e[§bINFO§e]§c======= \n§a Độ Bá: ■■■■■■■■■■ \n§a Độ Hiếm: ■■■■■■■■■■ \n§e [§a+§e] §bVật Phẩm: §cHiếm \n§6 ✘Enchant✘ \n§a ➱§e Có Độ Bền:§b600 \n§a ➱§e Có Độ Bảo Vệ:§b1350 \n§a ➱§e Gai:§b5 \n§6 ✘Custom Enchant✘ \n§a ➱§e Jetpack II\n§a ➱ §6Chỉ Xuất Hiện Ở Dịp Tết \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰ \n§a •§cNgười Tạo: §eYTB_Jero §a(OWNER) \n§a ✔§cGiá Thị Trường:§e 200.000Xu \n§e ▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰▰")); 
$sender->getInventory()->removeItem(Item::get(399,0,704)); 
$item->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1350)); 
$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(600)); 
$item->addEnchantment(Enchantment::getEnchantment(5)->setLevel(5)); 
$sender->getInventory()->setItemInHand($item);
$this->getServer()->dispatchCommand($sender, "ce ec Jetpack 2");
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::YELLOW . " §l§o§e30 NetherStar §a➱➱§f Giày §6Canh §8Tý"); 
}else{ 
$sender->sendMessage("§9[§a§l➢§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
} 
break;
} 
} 
} 
return true;
} 
} 
