<?php

namespace tream;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
class TransferWorld extends PluginBase implements Listener{
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) :bool {
		$command = $command->getName ();
		if ($command == "월드이동") {
			if(!isset($args[0])){
				$sender->sendMessage("/월드이동 <월드명>");
				return true;
			}
			if(file_exists($this->getServer()->getDataPath ()."worlds/".$args[0])){
			    $sender->addTitle("§l§b>> §f".$args[0]."월드로 이동....");
			    $this->getServer()->isLevelLoaded($args[0]) == false ? $this->getServer()->loadLevel($args[0]) : $this->getServer()->loadLevel($args[0]);
				$sender->teleport($this->getServer()->getLevelByName($args[0])->getSpawnLocation());
			}else{
				$sender->sendMessage("그런 이름의 월드는 없습니다.");
			}
			return true;
		}
		if ($command == "월드목록") {
			if(isset($args[0])){
				$sender->sendMessage("/월드목록");
				return true;
			}
			$w = "";
			foreach(scandir($this->getServer()->getDataPath ()."worlds") as $a){
				$w .= $a."\n";			
			}
			$sender->sendMessage("§l:: 월드목록 ::\n§r§b".$w."");
			return true;
		}
	}
}