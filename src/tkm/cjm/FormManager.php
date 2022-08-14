<?php

namespace tkm\cjm;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class FormManager{



    public function setQuitMessage(Player $player){
        $form = new CustomForm(function (Player $player, $data = null){
            if($data === null){
                return true;
            }
            if($data[2] === true){
                if(Manager::hasQuitMessage($player)){
                    Manager::removeQuitMessage($player);
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("delete-quitmessage"));
                }else{
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("no-quitmessage"));
                }
            }else{
                if(is_null($data[1])){
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("no-quitmessage-provided"));
                    return true;
                }
                Manager::setQuitMessage($player, $data[1]);
                $player->sendMessage(Main::getPrefix() . str_replace("{quit_message}", $data[1], Main::$message->get("set-quitmessage")));
            }
        });
        $form->setTitle(Main::$message->get("setquitmessage.title"));
        $form->addLabel(str_replace("{line}", "\n", Main::$message->get("setquitmessage.content")));
        if(Manager::hasQuitMessage($player)){
            $form->addInput(Main::$message->get("setquitmessage.input_name"), "name", Manager::getQuitMessage($player));
        }else{
            $form->addInput(Main::$message->get("setquitmessage.input_name"));
        }
        $form->addToggle(Main::$message->get("setquitmessage.toggle_name"));
        $form->sendToPlayer($player);
    }
    public function setJoinMessage(Player $player){
        $form = new CustomForm(function (Player $player, $data = null){
            if($data === null){
                return true;
            }
            if($data[2] === true){
                if(Manager::hasJoinMessage($player)){
                    Manager::removeJoinMessage($player);
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("delete-joinmessage"));
                }else{
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("no-joinmessage"));
                }
            }else{
                if(!$data[1]){
                    $player->sendMessage(Main::getPrefix() . Main::$message->get("no-joinmessage-provided"));
                    return true;
                }
                Manager::setJoinMessage($player, $data[1]);
                $player->sendMessage(Main::getPrefix() . str_replace("{join_message}", $data[1], Main::$message->get("set-joinmessage")));
            }
        });
        $form->setTitle(Main::$message->get("setjoinmessage.title"));
        $form->addLabel(str_replace("{line}", "\n", Main::$message->get("setjoinmessage.content")));
        if(Manager::hasJoinMessage($player)){
            $form->addInput(Main::$message->get("setjoinmessage.input_name"), "name", Manager::getJoinMessage($player));
        }else{
            $form->addInput(Main::$message->get("setjoinmessage.input_name"));
        }
        $form->addToggle(Main::$message->get("setjoinmessage.toggle_name"));
        $form->sendToPlayer($player);
    }
}