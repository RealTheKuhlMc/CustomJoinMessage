<?php

namespace tkm\cjm;

use pocketmine\player\Player;

class Manager{

    public static function getJoinMessage(Player $player){
        return Main::$joinmessages->getNested($player->getName() . ".join-msg") ?? null;
    }

    public static function getQuitMessage(Player $player){
        return Main::$joinmessages->getNested($player->getName() . ".quit-msg") ?? null;
    }

    public static function setJoinMessage(Player $player, string $message){
        Main::$joinmessages->setNested($player->getName() . ".join-msg", $message);
        Main::$joinmessages->save();
        Main::$joinmessages->reload();
    }

    public static function setQuitMessage(Player $player, string $message){
        Main::$joinmessages->setNested($player->getName() . ".quit-msg", $message);
        Main::$joinmessages->save();
        Main::$joinmessages->reload();
    }

    public static function removeJoinMessage(Player $player){
        Main::$joinmessages->removeNested($player->getName() . ".join-msg");
        Main::$joinmessages->save();
        Main::$joinmessages->reload();
    }

    public static function removeQuitMessage(Player $player){
        Main::$joinmessages->removeNested($player->getName() . ".quit-msg");
        Main::$joinmessages->save();
        Main::$joinmessages->reload();
    }

    public static function hasJoinMessage(Player $player){
        return isset(Main::$joinmessages->getAll()[$player->getName()]["join-msg"]);
    }

    public static function hasQuitMessage(Player $player){
        return isset(Main::$joinmessages->getAll()[$player->getName()]["quit-msg"]);
    }
}