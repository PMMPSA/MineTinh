<?php
namespace BarPlus;
 use BarPlus\Tasks\BarTask;
 use pocketmine\event\Listener;
 use pocketmine\plugin\PluginBase;
 use pocketmine\Server;
 use pocketmine\utils\TextFormat;
 use pocketmine\utils\Config;
 use pocketmine\event\player\PlayerJoinEvent;
 use pocketmine\event\player\PlayerDeathEvent;
 use pocketmine\event\entity\EntityDamageByEntityEvent;
 use pocketmine\Player;
 class HotBar extends PluginBase implements Listener {
	public $eco;
 	public $PP;
 	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");
		$this->cs = $this->getServer()->getPluginManager()->getPlugin("ChuyenSinh");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new BarTask($this), 10);
 		$this->getLogger()->info("§aBar was Enable!");
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->PP = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
 		$config = $this->getConfig();
 		$this->saveResource("config.yml");
 	}
 public function onJoin(PlayerJoinEvent $event) {
 		$name = $event->getPlayer()->getName();
 		$kills = new Config($this->getDataFolder()."kills.yml",Config::YAML);
 		$deaths = new Config($this->getDataFolder()."deaths.yml",Config::YAML);
 		if($kills->get($name) == null) {
 			$kills->set($name,0);
 			$kills->save();
 		}
 if($deaths->get($name) == null) {
 			$deaths->set($name,0);
 			$deaths->save();
 		}
 	}
 public function onDeath(PlayerDeathEvent $event) {
 		$entity = $event->getEntity();
 		$cause = $entity->getLastDamageCause();
 		if($entity instanceof Player) {
 			$name = $entity->getName();
 			$deaths = new Config($this->getDataFolder()."deaths.yml",Config::YAML);
 			$deaths->set($name,$deaths->get($name) + 1);
 			$deaths->save();
 			$config = new Config($this->getDataFolder()."config.yml",Config::YAML);
 		}
 if($cause instanceof EntityDamageByEntityEvent) {
 			$killer = $event->getEntity()->getLastDamageCause()->getDamage();
 			if($killer instanceof Player) {
 				$kills = new Config($this->getDataFolder()."kills.yml",Config::YAML);
 				$name = $killer->getName();
 				$kills->set($name,$kills->get($name) + 1);
 				$kills->save();
 				$config = new Config($this->getDataFolder()."config.yml",Config::YAML);
 			}
 		}
 	}
 public function getKills($name) {
 		$kills = new Config($this->getDataFolder()."kills.yml",Config::YAML);
 		return $kills->get($name);
 	}
 public function getDeaths($name) {
 		$deaths = new Config($this->getDataFolder()."deaths.yml", Config::YAML);
 		return $deaths->get($name);
 	}
 public function onBar() {
		foreach($this->getServer()->getOnlinePlayers() as $p) {
			$config = $this->getConfig();
 			$player = $p->getPlayer();
 			$name = $player->getName();
 			$onl = $online = count(Server::getInstance()->getOnlinePlayers());
 			$tps = $this->getServer()->getTicksPerSecond();
 			$usage = $this->getServer()->getTickUsage();
 			$maxo = $this->getServer()->getMaxPlayers();
 			$hp = $player->getHealth();
 			$max = $player->getMaxHealth();
 			$gm = $player->getGamemode();
 			$xx = $player->getX();
 			$yy = $player->getY();
 			$zz = $player->getZ();
 			$x = round($xx, 0);
 			$y = round($yy, 0);
 			$z = round($zz, 0);
 			$group = $this->PP->getUserDataMgr()->getGroup($player)->getName();
 			$money = $this->eco->myMoney($player->getName());
			$coin = $this->coin->myCoin($player->getName());
			$cs = $this->cs->myReincarnated($player->getName());
 			$item = $player->getInventory()->getItemInHand()->getName();
 			$id = $player->getInventory()->getItemInHand()->getId();
 			$ids = $player->getInventory()->getItemInHand()->getDamage();
 			$level = $player->getLevel()->getName();
 			$ip = $player->getAddress();
 			$tag = $player->getNameTag();
 			$date = date("H.i.s");
 			$kill = $this->getKills($name);
 			$deaths = $this->getDeaths($name);
 			$colors1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
 			$colors2 = [2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1];
 			$colors3 = [3, 4, 6, 7, 8, 9, 'a', 'b', 'c', 'e', 'f', 1, 2];
 			$colors4 = [4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3];
 			$colors5 = [5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4];
 			$colors6 = [6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5];
 			$colors7 = [7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5, 6,];
 			$colors8 = [8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5, 6, 7];
 			$colors9 = [9, 'a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5, 6, 7, 8];
 			$colors10 = ['a', 'b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5, 6, 7, 8, 9];
 			$colors11 = ['b', 'c', 'd', 'e', 'f', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a'];
 			$colors12 = ['c', 'e', 'f', 1, 2, 3, 4, 6, 7, 8, 9, 'a', 'b'];
 			$colors13 = ['d', 'e', 'f', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c'];
 			$colors14 = ['e', 'f', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd'];
 			$colors15 = ['f', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e'];
			$colors16 = ['e', 'f', 6];
         $icon = ['♩', '♪', '♫', '♬', '♭', '♮', '♯', '★'];
         $gt = ['=========================', '-------------------------'];
         $icons = ['★', '☆', '✡', '✦', '✧', '✩', '✪', '✫', '✬', '✭', '✮', '✯', '✰', '⁂', '✢', '✣', '✤', '✥'];
 			$bar = $config->get("CatPlus");
 			$bar = str_replace("{player}", $name, $bar);
 			$bar = str_replace("{level}", $level, $bar);
 			$bar = str_replace("{time}", $date, $bar);
 			$bar = str_replace("{id}", $id, $bar);
 			$bar = str_replace("{ids}", $ids, $bar);
 			$bar = str_replace("{item}", $item, $bar);
 			$bar = str_replace("{group}", $group, $bar);
 			$bar = str_replace("{gm}", $gm, $bar);
 			$bar = str_replace("{maxhp}", $max, $bar);
 			$bar = str_replace("{hp}", $hp, $bar);
 			$bar = str_replace("{monl}", $maxo, $bar);
 			$bar = str_replace("{onl}", $onl, $bar);
 			$bar = str_replace("{tps}", $tps, $bar);
 			$bar = str_replace("{usage}", $usage, $bar);
 			$bar = str_replace("{kill}", $kill, $bar);
 			$bar = str_replace("{tag}", $tag, $bar);
 			$bar = str_replace("{IP}", $ip, $bar);
 			$bar = str_replace("{X}", $x, $bar);
 			$bar = str_replace("{Y}", $y, $bar);
 			$bar = str_replace("{Z}", $z, $bar);
 			$bar = str_replace("{money}", $money, $bar);
			$bar = str_replace("{coin}", $coin, $bar);
			$bar = str_replace("{cs}", $cs, $bar);
 			$bar = str_replace("{deaths}", $deaths, $bar);
 			$bar = str_replace("{R1}", "§".$colors1[array_rand($colors1)], $bar);
 			$bar = str_replace("{R2}", "§".$colors2[array_rand($colors2)], $bar);
 			$bar = str_replace("{R3}", "§".$colors3[array_rand($colors3)], $bar);
 			$bar = str_replace("{R4}", "§".$colors4[array_rand($colors4)], $bar);
 			$bar = str_replace("{R5}", "§".$colors5[array_rand($colors5)], $bar);
 			$bar = str_replace("{R6}", "§".$colors6[array_rand($colors6)], $bar);
 			$bar = str_replace("{R7}", "§".$colors7[array_rand($colors7)], $bar);
 			$bar = str_replace("{R8}", "§".$colors8[array_rand($colors8)], $bar);
 			$bar = str_replace("{R9}", "§".$colors9[array_rand($colors9)], $bar);
 			$bar = str_replace("{R10}", "§".$colors10[array_rand($colors10)], $bar);
 			$bar = str_replace("{R11}", "§".$colors11[array_rand($colors11)], $bar);
 			$bar = str_replace("{R12}", "§".$colors12[array_rand($colors12)], $bar);
 			$bar = str_replace("{R13}", "§".$colors13[array_rand($colors13)], $bar);
 			$bar = str_replace("{R14}", "§".$colors14[array_rand($colors14)], $bar);
 			$bar = str_replace("{R15}", "§".$colors15[array_rand($colors15)], $bar);
			$bar = str_replace("{R16}", "§".$colors16[array_rand($colors16)], $bar);
        $bar = str_replace("{icon}", $icon[array_rand($icon)], $bar);
        $bar = str_replace("{gt}", $gt[array_rand($gt)], $bar);
        $bar = str_replace("{icons}", $icons[array_rand($icons)], $bar);
 			$h = str_repeat(" ", 70);
 			$h2 = str_repeat(" ", 40);
 			$n = str_repeat("\n", 20);
 			$bar = str_replace("{h}", $h, $bar);
 			$bar = str_replace("{h2}", $h2, $bar);
 			$bar = str_replace("{n}", $n, $bar);
 			$player->sendTip($bar);
 		}
 	}
 }