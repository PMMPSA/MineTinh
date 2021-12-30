<?php

namespace CuaHang;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\{Server, Player};
use pocketmine\utils\TextFormat as TF;
use pocketmine\item\enchantment\Enchantment;
use PTKCustomEnchants\CustomEnchants\CustomEnchants;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};

class Main extends PluginBase implements Listener {
    
public $tag = "§l§d[§eCỬA HÀNG§d]§r ";
	
public function onEnable() {
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->CE = $this->getServer()->getPluginManager()->getPlugin("PTKCustomEnchants");
}
	
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
if($cmd->getName() == "cuahang") {
$sender->sendMessage($this->tag."§c /cuahang danhsach để xem danh sách");
if(isset($args[0])) {
switch(strtolower($args[0])) {
case "danhsach":
$sender->sendMessage("§a§l• §c§l✡§f Cúp§a Đại Lục §c✡ §b[§dcupdailuc§b]§6: §c129 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Giáp§2 Tru Tiên §c✡ §b[§dgiaptrutien§b]§6: §c329 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Cúp§6 Đại Ngọc Bảo §c✡ §b[§dcupdaingocbao§b]§6: §c739 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Cúp§5 Ma Thuật §c✡ §b[§dcupmathuat§b]§6: §c188 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Cúp§1 Canh Tý§6 2020 §c✡ §b[§dcupcanhty§b]§6: §c500 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Nón§4 Nguyệt Diệt §c✡ §b[§dnonnguyetdiet§b]§6: §c439 Kim Cương");
$sender->sendMessage("§a§l• §c§l✡§f Kiếm§6 Ma Quái §c✡ §b[§dkiemmaquai§b]§6: §c539Kim Cương");
// Bảo Trì //
#$sender->sendMessage("§a§l• §c§l✡§f Kiếm§1 Ràng Buộc §c✡ §b[§dkiemrangbuoc§b]§6: §c[Bảo Trì]");
#$sender->sendMessage("§a§l• §c§l✡§f Kiếm§3 H§cỗ§en §aH§6ợ§5p §c✡ §b[§dkiemhoden§b]§6: §c[Bảo Trì]");
#$sender->sendMessage("§a§l• §c§l✡§f Rìu§e Thiên Ma §c✡ §b[§driuthienma§b]§6: §c[Bảo Trì]");
    }
}

if(isset($args[0])) {
switch(strtolower($args[0])) {

case "cupdailuc":
$item1 = Item::get(257, 0, 1);
$name1 = $item1->setCustomName(" §c§l✡§f Cúp§a Đại Lục §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 129) {
$sender->sendMessage(TF::RED . "Bạn Không Đủ Tiền Để Mua");
}else{
$item1->addEnchantment(Enchantment::getEnchantment(15)->setLevel(7));
$item1->addEnchantment(Enchantment::getEnchantment(202)->setLevel(2));
$item1->addEnchantment(Enchantment::getEnchantment(18)->setLevel(3));
$item1->addEnchantment(Enchantment::getEnchantment(108)->setLevel(5));
$item1->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
$item1->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item1->setLore(array(" §c§l✡§f Cúp§a Đại Lục §c✡ §f: §b129 §4Đá Quý§e$\n§fĐào Nhanh Khi Phá Block:§b 2\n§fHiệu Xuất:§b 7\n§fTự sửa:§b 5\n§fGia Tài:§b 3\n§fSắt Bén:§b 5\n§fChậm Hỏng:§b 500"));
$item1->setCustomName($name1);
$sender->getInventory()->addItem($item1);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 129);
}
break;

case "giaptrutien":
$item2 = Item::get(307, 0, 1);
$name2 = $item2->setCustomName(" §c§l✡§f Giáp§2 Tru Tiên §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 329) {
$sender->sendTitle(TF::RED . "Không đủ tiền\n §b Bạn Cần Thêm Point Để\n Sở Hữu");
}else{
$item2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(10));
$item2->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item2->addEnchantment(Enchantment::getEnchantment(5)->setLevel(1));
$item2->setLore(array(" §c§l✡§f Giáp§2 Tru Tiên §c✡\n§fĐánh Giá :§5 ⋆⋆⋆\n§fPhẩm Chất :§5 Tím\n§fĐược Rèn Trong Lò Luyện Tiên Kim Nóng Nhất Vũ Trụ\n§f===================\n§6Kĩ Năng:\n§f-§7 Tốc Độ§f : khi máu càng thấp bạn sẽ nhận được tốc chạy càng cao \n§f-§b Sinh Lực§f : Tăng Máu Tối Đa"));
$this->CE->addEnchantment($item2, "Autorepair", 3);
$this->CE->addEnchantment($item2, "Overload", 1);
$item2->setCustomName($name2);
$sender->getInventory()->addItem($item2);
$sender->sendTitle($this->tag. "§a Mua Thành Công\n §e Bạn Đã Sở Hữu Giáp");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 329);
}
break;

case "cupdaingocbao":
$item3 = Item::get(278, 0, 1);
$name3 = $item3->setCustomName(" §c§l✡§f Cúp§6 Đại Ngọc Bảo §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 739) {
$sender->sendMessage(TF::RED . "Không đủ Point");
}else{
$item3->addEnchantment(Enchantment::getEnchantment(15)->setLevel(8));
$item3->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
$item3->addEnchantment(Enchantment::getEnchantment(18)->setLevel(2));
$item3->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item3->setLore(array(" §c§l✡§f Cúp§6 Đại Ngọc Bảo §c✡\n§fĐánh Giá: §5 ⋆⋆⋆⋆\n§fPhẩm Chất :§6 Cam\n§fCúp có tính năng gây nổ nên dùng cẩn thận\n§f===================\n§6Kĩ Năng:\n§f-§5 Nhặt§f : tự động hút item vào túi đồ\n§f-§b Vụ Nổ§f : Phá 1 vùng block"));
$this->CE->addEnchantment($item3, "Explosive", 1);
$item3->setCustomName($name3);
$sender->getInventory()->addItem($item3);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 739);
}
break;

case "cupmathuat":
$item4 = Item::get(278, 0, 1);
$name4 = $item4->setCustomName(" §c§l✡§f Cúp§5 Ma Thuật §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 188) {
$sender->sendMessage(TF::RED . "Không đủ tiền");
}else{
$item4->addEnchantment(Enchantment::getEnchantment(15)->setLevel(7));
$item4->addEnchantment(Enchantment::getEnchantment(18)->setLevel(4));
$item4->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item4->addEnchantment(Enchantment::getEnchantment(2)->setLevel(30));
$item4->setLore(array(" §c§l✡§f Cúp§5 Ma Thuật §c✡\n§fĐánh Giá :§5 ⋆⋆\n§fPhẩm Chất :§6 Cam\n§fCúp Cao Cấp Thuộc Hệ §5Ma Thuật\n§f===================\n§6Kĩ Năng:\n§f-§5 Nhặt§f : tự động hút item vào túi đồ\n§f-§b Tăng Tốc Chạy§f : Khi Phá Block sẽ nhận BUFF"));
$this->CE->addEnchantment($item4, "Haste", 1);
$this->CE->addEnchantment($item4, "Autorepair", 3);
$this->CE->addEnchantment($item4, "Telepathy", 1);
$item4->setCustomName($name4);
$sender->getInventory()->addItem($item4);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 188);				}
break;

case "cupcanhty":
$item5 = Item::get(278, 0, 1);
$name5 = $item5->setCustomName(" §c§l✡§f Cúp§e Thần Tài§6 2020 §c✡ §f[§1Canh Tý§f]");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 500){
$sender->sendMessage(TF::RED . "Không đủ tiền");
}else{
$item5->addEnchantment(Enchantment::getEnchantment(15)->setLevel(55));
$item5->addEnchantment(Enchantment::getEnchantment(18)->setLevel(30));
$item5->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item5->setLore(array(" §c§l✡§f Cúp§e Thần Tài§6 2020 §c✡\n§fĐánh Giá :§5 ⋆⋆\n§fPhẩm Chất :§6 Cam\n§fCúp Cao Cấp Thuộc Hệ §5Ma Thuật\n§f===================\n§6Kĩ Năng:\n§f-§5 Nhặt§f : tự động hút item vào túi đồ\n§f-§b Tăng Tốc Chạy§f : Khi Phá Block sẽ nhận BUFF"));
$this->CE->addEnchantment($item5, "Haste", 3);
$this->CE->addEnchantment($item5, "Autorepair", 4);
$this->CE->addEnchantment($item5, "Jackpot", 2);
$this->CE->addEnchantment($item5, "Smelting", 1);
$this->CE->addEnchantment($item5, "Telepathy", 1);
$sender->getInventory()->addItem($item5);
$item5->setCustomName($name5);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 500);
}
break;

case "nonnguyetdiet":
$item6 = Item::get(310, 0, 1);
$name6 = $item6->setCustomName(" §c§l✡§f Nón§4 Nguyệt Diệt §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 439){
$sender->sendMessage(TF::RED . "Không đủ tiền");
}else{
$item6->addEnchantment(Enchantment::getEnchantment(9)->setLevel(1000));
$item6->addEnchantment(Enchantment::getEnchantment(0)->setLevel(15));
$item6->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item6->setLore(array(" §c§l✡§f Nón§4 Nguyệt Diệt §c✡\n§fĐánh Giá :§5 ⋆⋆⋆\n§fPhẩm Chất :§6 Cam\n§fmột Tu Sĩ Mù đã giam cầm linh hồn\n§fMột con Qủy Vào Cái nón này\n§fAi sở Hữu sẽ có khả năng bất bại\n§f===================\n§6Kĩ Năng:\n§f-§7 Miễn Thương§f : Giảm 30/100 sát thương từ§6 Kiếm§f và§6 Cung\n§f-§b Sinh Lực§f : Tăng Máu Tối Đa"));
$item6->setCustomName($name6);
$sender->getInventory()->addItem($item6);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 439);				}
break;

case "kiemmaquai":
$item7 = Item::get(276, 0, 1);
$name7 = $item7->setCustomName(" §c§l✡§f Kiếm§6 Ma Quái §c✡");
$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myPoint($sender->getName());
if($money < 539) {
$sender->sendMessage(TF::RED . "Không đủ tiền");
}else{
$item7->addEnchantment(Enchantment::getEnchantment(9)->setLevel(50));
$item7->addEnchantment(Enchantment::getEnchantment(9)->setLevel(15));
$item7->addEnchantment(Enchantment::getEnchantment(17)->setLevel(500));
$item7->addEnchantment(Enchantment::getEnchantment(19)->setLevel(10));
$item7->setLore(array(" §c§l✡§f Kiếm§6 Ma Quái §c✡\n§fĐánh Gía :§5 ⋆⋆⋆⋆\n§fPhẩm Chất :§6 Cam\n§fĐây là vũ khí đã tiêu diệt§4 Annabell§f và§4 The Nun\n§fMang Nguồn Sức Mạnh Tâm Linh Đáng Sợ\n§f===================\n§6Kĩ Năng:\n§f-§3 Hiệu Ứng: Gây Nhiều Loại Buff khác nhau\n§f-§b Chí Mạng§f : Tăng Sát Thương Khi Nhảy và đánh"));
$item7->setCustomName($name7);
$sender->getInventory()->addItem($item7);
$sender->sendMessage($this->tag. "§a Mua Thành Công");
$this->getServer()->getPluginManager()->getPlugin("PointAPI")->reducePoint($sender->getName(), 539);
}
break;
                }
			}
		}
    }
}