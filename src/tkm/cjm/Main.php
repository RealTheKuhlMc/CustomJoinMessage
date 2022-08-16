<?php

namespace tkm\cjm;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use tkm\cjm\commands\SetJoinMessageCommand;
use tkm\cjm\commands\SetQuitMessageCommand;


class Main extends PluginBase{

    public static self $instance;
    public static Config $joinmessages;
    public static Config $message;

    protected function onEnable(): void
    {
        self::$joinmessages = new Config(self::getDataFolder() . "joinmessages.yml", 2);
        self::saveResource("messages.yml");
        self::$message = new Config(self::getDataFolder() . "messages.yml", 2);
        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);

        Server::getInstance()->getCommandMap()->registerAll("CustomJoinMessage",[
            new SetJoinMessageCommand("setjoinmessage", self::$message->get("setjoinmessage-description"), null, self::$message->get("setjoinmessage-aliases")),
            new SetQuitMessageCommand("setquitmessage", self::$message->get("setquitmessage-description"), null, self::$message->get("setquitmessage-aliases"))
            ]);
    }


    public static function getPrefix(){
        $cfg = Main::$message;
        return $cfg->get("prefix");
    }
}
