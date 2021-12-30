<?php 

namespace PTKCustomEnchants\Commands;

 use PTKCustomEnchants\CustomEnchants\CustomEnchants;
 use PTKCustomEnchants\Main;
 use pocketmine\command\CommandSender;
 use pocketmine\command\ConsoleCommandSender;
 use pocketmine\command\PluginCommand;
 use pocketmine\Player;
 use pocketmine\utils\TextFormat;
 class CustomEnchantCommand extends PluginCommand { public function __construct($name, Main $plugin) { parent::__construct($name, $plugin);
 $this->setDescription("Enchant with custom enchants");
 $this->setUsage("/ce <about|enchant|help|info|list>");
 $this->setAliases(["ce", "customenchants", "customenchantments", "customenchant"]);
 $this->setPermission("ptkcustomenchants.command.ce");
 } public function execute(CommandSender $sender, $Label, array $args): bool { if (count($args) < 1) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Xin Hãy Sử Dụng Lệnh: /ce <ec|help|info|list>");
 return false;
 } $plugin = $this->getPlugin();
 if ($plugin instanceof Main) { switch ($args[0]) { case "about": if (!$sender->hasPermission("ptkcustomenchants.command.ce.about")) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "You do not have permission to do this.");
 return false;
 } break;
 case "enchant": case "ec": if (!$sender->hasPermission("ptkcustomenchants.command.ce.enchant")) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "You do not have permission to do this.");
 return false;
 } if (count($args) < 2) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Xin Hãy Sử Dụng Lệnh: /ce ec <ID Enchant> [Cấp] [Người Chơi]");
 return false;
 } $target = $sender;
 if (!isset($args[2])) { $args[2] = 1;
 } if (!is_numeric($args[2])) { $args[2] = 1;
 $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Số Cấp Độ Phải Là Số! Đã Đặt Cấp Độ Là 1.");
 } if (isset($args[3])) { $target = $this->getPlugin()->getServer()->getPlayer($args[3]);
 } if (!$target instanceof Player) { if ($target instanceof ConsoleCommandSender) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Please provide a player.");
 return false;
 } $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Invalid player.");
 return false;
 } $target->getInventory()->setItemInHand($plugin->addEnchantment($target->getInventory()->getItemInHand(), $args[1], $args[2], $sender->hasPermission("ptkcustomenchants.overridecheck") ? false : true, $sender));
 break;
 case "help": if (!$sender->hasPermission("ptkcustomenchants.command.ce.help")) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "You do not have permission to do this.");
 return false;
 } $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::GREEN . "---PTKCE Help---\n" . TextFormat::RESET . "/ce enchant: Enchant an item\n/ce help: Show the help page\n/ce info: Get description of enchant\n/ce list: List of enchants");
 break;
 case "info": if (!$sender->hasPermission("ptkcustomenchants.command.ce.info")) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "You do not have permission to do this.");
 return false;
 } if (count($args) < 2) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Xin Hãy Sử Dụng Lệnh: /ce info <ID Enchant>");
 return false;
 } if ((is_numeric($args[1]) && ($enchant = CustomEnchants::getEnchantment($args[1])) !== null) || ($enchant = CustomEnchants::getEnchantmentByName($args[1])) !== null) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::GREEN . $enchant->getName() . "\nMô Tả: " . $plugin->getEnchantDescription($enchant) . "\nLoại: " . $plugin->getEnchantType($enchant) . "\nĐộ Hiếm: " . $plugin->getEnchantRarity($enchant) . "\nCấp Cao Nhất: " . $plugin->getEnchantMaxLevel($enchant));
 } else { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Invalid enchantment.");
 } break;
 case "list": if (!$sender->hasPermission("ptkcustomenchants.command.ce.list")) { $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "You do not have permission to do this.");
 return false;
 } $sorted = $plugin->sortEnchants();
 $list = "";
 foreach ($sorted as $type => $enchants) { $list .= "\n" . TextFormat::GREEN . TextFormat::BOLD . $type . "\n" . TextFormat::RESET;
 $list .= implode(", ", $enchants);
 } $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".$list);
 break;
 default: $sender->sendMessage("§b[§eCustom§dEnchants§b] §r".TextFormat::RED . "Usage: /customenchant <about|enchant|help|info|list>");
 break;
 } return true;
 } return false;
 } }