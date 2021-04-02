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
	public $player = [];
	
	public function onEnable(){
	}
	
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		foreach($this->getServer()->getOnlinePlayers() as $players){
			
			unset($this->player[$player->getName()]);
			unset($this->name[$player->getName()]);
			unset($this->skin[$player->getName()]);
			
			$player->setNameTagVisible(false);
			$player->setInvisible(false);
			$players->showPlayer($player);
			
		}
	}
	
	public function onRespawn(PlayerRespawnEvent $event){
		$player = $event->getPlayer();
		
		foreach($this->getServer()->getOnlinePlayers() as $players){
			
			unset($this->player[$player->getName()]);
			unset($this->name[$player->getName()]);
			unset($this->skin[$player->getName()]);
			
			$player->setNameTagVisible(false);
			$player->setInvisible(false);
			$players->showPlayer($player);
			
		}
		
	}
	
	public function onCommand(CommandSender $player, command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()){
			case "hide":
			if($player instanceof Player){
				
				switch(array_shift($args)){
					case "nametag":
					
					if(!isset($this->name[$player->getName()])){
						$this->name[$player->getName()] = $player->getName();
						$player->setNameTagVisible(true);
						$player->sendMessage("§eYour §anametag §ehas been hidden");
					}else{
						unset($this->name[$player->getName()]);
						$player->setNameTagVisible(false);
						$player->sendMessage("§eYour §anametag §ehas been shown");
					}
					break;
					case "skin":
					if(!isset($this->skin[$player->getName()])){
						$this->skin[$player->getName()] = $player->getName();
						$player->setInvisible(true);
						$player->setNameTag($player->getNameTag());
						$player->sendMessage("§eYour §askin §ehas been hidden");
					}else{
						unset($this->skin[$player->getName()]);
						$player->setInvisible(false);
						$player->sendMessage("§eYour §askin §ehas been shown");
					}
					break;
					case "player":
					if(!isset($this->player[$player->getName()])){
						foreach($this->getServer()->getOnlinePlayers() as $players){
							$this->player[$player->getName()] = $player->getName();
							$players->hidePlayer($player);
							$player->sendMessage("§eYour §aplayer §ehas been hidden");
						}
					}else{
						foreach($this->getServer()->getOnlinePlayers() as $players){
							unset($this->player[$player->getName()]);
							$players->showPlayer($player);
							$player->sendMessage("§eYour §aplayer §ehas been shown");
						}
					}
					break;
					default:
					$player->sendMessage("§cUsage: /hide <nametag|skin|player>");
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
