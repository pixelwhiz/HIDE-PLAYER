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
	public $skin = [];
	
	public function onEnable(){
	}
	
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		unset($this->name[$player->getName()]);
		unset($this->skin[$player->getName()]);
	}
	
	public function onCommand(CommandSender $player, command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()){
			case "hide":
			if($player instanceof Player){
				if(!isset($args[0])){
					$player->sendMessage("§aUsage: /hide <skin, nametag>");
					return true;
				}
				$arg = array_shift($args);
				switch($arg){
					case "nametag":
					if(!isset($this->name[$player->getName()])){
						$this->name[$player->getName()] = $player->getName();
						$player->setNameTagVisible(true);
						$player->sendMessage("§eYour nametag has been Hidden!");
					}else{
						unset($this->name[$player->getName()]);
						$player->setNameTagVisible(false);
						$player->sendMessage("§cYour nametag has been Shown!");
					}
					break;
					case "skin":
					if(!isset($this->skin[$player->getName()])){
						$this->skin[$player->getName()] = $player->getName();
						$player->setInvisible(true);
						$player->sendMessage("§eYour skin has been Hidden!");
					}else{
						unset($this->skin[$player->getName()]);
						$player->setInvisible(false);
						$player->sendMessage("§cYour skin has been Shown!");
					}
					break;
				}
					
			}else{
				$player->sendMessage("§cUse this command in game");
			}
		}
		return true;
	}
	
	public function onDisable(){
	}
	

}
