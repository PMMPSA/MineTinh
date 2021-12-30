<?php

namespace DanhHieu;

use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent, PlayerMoveEvent};
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};

class Main extends PluginBase implements Listener {

public function onEnable() {
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
$this->pp = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
@mkdir($this->getDataFolder(), 0744, true);
$this->cfg = new Config($this->getDataFolder()."DanhHieu.yml",Config::YAML);
}

public function onMove(PlayerMoveEvent $ev) {
if($this->cfg->get($ev->getPlayer()->getName()) == 0) {
$ev->getPlayer()->setNameTag("Tân Thủ\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
}
if($this->cfg->get($ev->getPlayer()->getName()) == 1) {
$ev->getPlayer()->setNameTag("Phụng Hoàng Lửa\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
}
if($this->cfg->get($ev->getPlayer()->getName()) == 2) {
$ev->getPlayer()->setNameTag("Bà Tân Vlog\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
}
if($this->cfg->get($ev->getPlayer()->getName()) == 3) {
$ev->getPlayer()->setNameTag("Tay Chơi Miệt Vườn\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
}
if($this->cfg->get($ev->getPlayer()->getName()) == 4) {
$ev->getPlayer()->setNameTag("YouTuber Nổi Tiếng\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
}
if($this->cfg->get($ev->getPlayer()->getName()) == 5) {
$ev->getPlayer()->setNameTag("Thánh Máy Chủ\n".$this->pp->getUserDataMgr()->getGroup($ev->getPlayer())->getName()." ".$ev->getPlayer()->getDisplayName());
    }
}

public function onJoin(PlayerJoinEvent $ev) {
if(!$this->cfg->exists($ev->getPlayer()->getName())) {
$this->cfg->set($ev->getPlayer()->getName(), 0);
$this->cfg->save();
    }
}

public function onQuit(PlayerQuitEvent $ev) {
$this->cfg->save();
}
	
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
if(!$sender instanceof Player) {
$sender->sendMessage("Vui Lòng Sử Dụng Lệnh Trong Trò Chơi");
return true;
}

if ($cmd == "danhhieu") {
if(empty($args[0]) or !isset($args[0]) or $args[0] == "help") {
$sender->sendMessage("Danh Sách Danh Hiệu\nPhụng Hoàng Lửa | 20 Coin | Cú Pháp [PHL]\nBà Tân Vlog | 40 Coin | Cú Pháp [BTV]\nTay Chơi Miệt Vườn | 60 Coin | Cú Pháp [TCMV]\nYouTuber Nổi Tiếng | 85 Coin | Cú Pháp [YNT]\nThánh Máy Chủ | 115 Coin | Cú Pháp [TMC]\nĐể Mua Danh Hiệu Sử Dụng Lệnh: /danhhieu [Cú Pháp]\nVí Dụ: /danhhieu PHL");
return true;
}

if(!empty($args[0]) or isset($args[0])) {
switch(strtoupper($args[0])) {
case "PHL":
if($this->coin->myCoin($sender->getName()) < 20) {
$sender->sendMessage("Bạn Cần 20 Coin Để Mua Danh Hiệu Phụng Hoàng Lửa");
}else{
$this->coin->reduceCoin($sender->getName(), 20);
$sender->getServer()->broadcastMessage("Người Chơi ".$sender->getName()." Đã Mua Thành Công Danh Hiệu Phụng Hoàng Lửa");
$sender->sendMessage("Mua Thành Công Danh Hiệu Phụng Hoàng Lửa");
$this->cfg->set($sender->getName(), 1);
$this->cfg->save();
}
break;

case "BTV":
if($this->coin->myCoin($sender->getName()) < 40) {
$sender->sendMessage("Bạn Cần 40 Coin Để Mua Danh Hiệu Bà Tân Vlog");
}else{
$this->coin->reduceCoin($sender->getName(), 40);
$sender->getServer()->broadcastMessage("Người Chơi ".$sender->getName()." Đã Mua Thành Công Danh Hiệu Bà Tân Vlog");
$sender->sendMessage("Mua Thành Công Danh Hiệu Bà Tân Vlog");
$this->cfg->set($sender->getName(), 2);
$this->cfg->save();
}
break;

case "TCMV":
if($this->coin->myCoin($sender->getName()) < 60) {
$sender->sendMessage("Bạn Cần 60 Coin Để Mua Danh Hiệu Tay Chơi Miệt Vườn");
}else{
$this->coin->reduceCoin($sender->getName(), 60);
$sender->getServer()->broadcastMessage("Người Chơi ".$sender->getName()." Đã Mua Thành Công Danh Hiệu Tay Chơi Miệt Vườn");
$sender->sendMessage("Mua Thành Công Danh Hiệu Tay Chơi Miệt Vườn");
$this->cfg->set($sender->getName(), 3);
$this->cfg->save();
}
break;

case "YNT":
if($this->coin->myCoin($sender->getName()) < 85) {
$sender->sendMessage("Bạn Cần 85 Coin Để Mua Danh Hiệu YouTuber Nổi Tiếng");
}else{
$this->coin->reduceCoin($sender->getName(), 85);
$sender->getServer()->broadcastMessage("Người Chơi ".$sender->getName()." Đã Mua Thành Công Danh Hiệu YouTuber Nổi Tiếng");
$sender->sendMessage("Mua Thành Công Danh Hiệu YouTuber Nổi Tiếng");
$this->cfg->set($sender->getName(), 4);
$this->cfg->save();
}
break;

case "TMC":
if($this->coin->myCoin($sender->getName()) < 115) {
$sender->sendMessage("Bạn Cần 115 Coin Để Mua Danh Hiệu Thánh Máy Chủ");
}else{
$this->coin->reduceCoin($sender->getName(), 115);
$sender->getServer()->broadcastMessage("Người Chơi ".$sender->getName()." Đã Mua Thành Công Danh Hiệu Thánh Máy Chủ");
$sender->sendMessage("Mua Thành Công Danh Hiệu Thánh Máy Chủ");
$this->cfg->set($sender->getName(), 5);
$this->cfg->save();
}
break;
				}
			}
		}
return true;
	}
}