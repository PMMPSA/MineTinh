<?php

namespace Reincarnated;

use pocketmine\{Player, Server};
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\{PlayerJoinEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

public function onEnable() {
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
$this->coin = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
//////////////// Tạo config /////////////////
@mkdir($this->getDataFolder());
$this->cfg = new Config($this->getDataFolder()."chuyensinh.yml",Config::YAML);
}
	////////////////// Đặt level 1 chuyển sinh khi vô máy chủ lần đầu //////////////////////////////
public function onJoin(PlayerJoinEvent $event) {
$player = $event->getPlayer();
			if(!$this->cfg->exists($player)){
				$this->cfg->set($player, 1);
				$this->cfg->save();
    }
}

public function onBreak(BlockBreakEvent $ev){
  	     $p = $ev->getPlayer();
  $a = $this->myReincarnated($p) * 1000;
  $b = $this->myReincarnated($p) * 100;
  $c = $this->myReincarnated($p) * 1 - 1;
$rand = mt_rand(1, 100);
 if ($this->myReincarnated($p) > 1){ 
switch($rand){ 
case 5: 
$p->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aBạn Đã Nhận Được".$a."Xu Khi Mine(Xu Này Từ Nguồn Rebirh Của Bạn)");
$this->money->addMoney($p, $a);
break;
case 20:
$p->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aBạn Đã Nhận Được".$b."Xu Khi Mine(Xu Này Từ Nguồn Rebirh Của Bạn)");
$this->money->addMoney($p, $a);
break;
case 50:
$p->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aBạn Đã Nhận Được".$b."Xu Khi Mine(Xu Này Từ Nguồn Rebirh Của Bạn)");
$this->money->addMoney($p, $b);
break;
case 70:
$this->coin->addPoint($p, $c);
$event->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aBạn Đã Nhận Được".$c."Point Khi Mine(Point Này Từ Nguồn Rebirh Của Bạn)");
break;
default:
break;
    }
    }
    }
///////////////////////// Câu lệnh ////////////////////////
public function onCommand(CommandSender $sender, Command $command, $label, array $args){
	switch($command->getName()) {
		case "chuyensinh":
		$player = $sender->getName();
		// Fix Bởi Nguyễn Công Danh (Danh Miner) Và Master Jero.
		$money = $this->money->myMoney($player);
		if($money < $this->myReincarnated($player) * 1000000){
			$sender->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aBạn Không Đủ Tiền Lên Cấp Tiếp Theo");
			 $sender->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §eBạn Cần Phải Cày Thêm Nha ".$player."");
			$sender->sendMessage("§a§l❦ §e[§bMine§aTinh§e] §aSố Tiền Để Lên Cấp Tiếp Theo Là". $this->myReincarnated($player) * 1000000 ."Xu");
		} else {
			  $this->cfg->set($player, (int)$this->cfg->get($player) + 1);
			$sender->sendMessage(" §a§l❦ §e[§bMine§aTinh§e] §aLên Cấp Thành Công Bạn Đã Đạt Cấp". $this->myReincarnated($player) ."");
			$this->money->reduceMoney($player, $this->myReincarnated($player) * 1000000);
			  $this->cfg->save();
		}
		break;
		
		case "mychuyensinh":
		$player = $sender->getName();
		if($this->myReincarnated($player) >= 1){
			$sender->sendMessage("§e§l⊹⊱§dChuyển Sinh§e⊰⊹ §bCấp Độ §dChuyển Sinh§b Của Bạn Hiện Tại Là: §e". $this->myReincarnated($player) ."");
		} else {
			$sender->sendMessage("§e§l⊹⊱§dChuyển Sinh§e⊰⊹ §b Bạn §a Không Có §cCấp Độ §dChuyển Sinh");
			}
		break;
		
case "topchuyensinh":
$max = 0;
foreach($this->cfg->getAll() as $c) {
$max += count($c);
    }
$max = ceil(($max / 5));
$page = array_shift($args);
$page = max(1, $page);
$page = min($max, $page);
$page = (int)$page;
$sender->sendMessage("§e§l⊹⊱§aBảng Xếp Hạng Tái Sinh Của Máy Chủ §bMine§aTinh§e⊰⊹");
$aa = $this->cfg->getAll();
arsort($aa);
$i = 1;
foreach($aa as $b=>$a) {
if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
$i1 = $i + 1;
$c = $this->cfg->get($b);
$sender->sendMessage("§l§e⊹⊱§aXếp Hạng §e".$i."§a Thuộc Về§b ".$b." §aVới§a".$c."§b Cấp§e⊰⊹");
    }
$i++;
}
break;
    }
}

public function myReincarnated($player) {
if($player instanceof Player) {
$player = $player->getName();
	}
$reincarnated = $this->cfg->get($player);
return $reincarnated;
    }
    public function addLevel($player, $cfg){
     if($player instanceof Player){
         $player = $player->getName();
         }
         $this->cfg = new Config($this->getDataFolder()."config.yml",Config::YAML);
         $this->cfg->set($player, (int)$this->cfg->get($player) + $cfg);
         $this->cfg->save();
    }
}