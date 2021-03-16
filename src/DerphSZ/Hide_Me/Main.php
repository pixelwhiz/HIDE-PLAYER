<?php

declare(strict_types=1);

namespace DerphSZ\Hide_Me;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;

class Main extends PluginBase implements Listener {
	
	public $name = [];
	public $body = [];
	
	public function onEnable(){
		$this->getLogger("");
	}
	
	public function onCommand(CommandSender $player, command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()){
			case "hide":
			if($player instanceof Player){
				if(!isset($args[0])){
					$player->sendMessage("§6Usage: /hide <body, name>");
					return true;
				}
				$arg = array_shift($args);
				switch($arg){
					case "name":
					if(!isset($this->name[$player->getName()])){
						$player->setNameTagVisible(true);
						$player->sendMessage("§aYour name has been Hidden!");
					}else{
						$player->setNameTagVisible(false);
						$player->sendMessage("§cYour name has been Shown!");
					}
					break;
					case "body":
					if(!isset($this->body[$player->getName()])){
						$player->setInvisible(true);
						$player->sendMessage("§aYour body has been Hidden!");
					}else{
						$player->setInvisible(false);
						$player->sendMessage("§cYour body has been Shown!");
					}
					break;
				}
			}
			break;
		}
		return true;
	}
	
	public function onDisable(){
	}
	

}
