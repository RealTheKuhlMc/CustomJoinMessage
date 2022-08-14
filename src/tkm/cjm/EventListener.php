<?php

namespace tkm\cjm;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{


    public function onJoin(PlayerJoinEvent $e){
        $player = $e->getPlayer();
        if(Manager::hasJoinMessage($player)){
            $e->setJoinMessage(str_replace("{player_name}", $player->getName(), Manager::getJoinMessage($player)));
        }else{
            $e->setJoinMessage(str_replace("{player_name}", $player->getName(), Main::$message->get("default-join-message")));
        }
    }

    public function onQuit(PlayerQuitEvent $e){
        $player = $e->getPlayer();
        if(Manager::hasQuitMessage($player)){
            $e->setQuitMessage(str_replace("{player_name}", $player->getName(), Manager::getQuitMessage($player)));
        }else{
            $e->setQuitMessage(str_replace("{player_name}", $player->getName(), Main::$message->get("default-quit-message")));
        }
    }
}