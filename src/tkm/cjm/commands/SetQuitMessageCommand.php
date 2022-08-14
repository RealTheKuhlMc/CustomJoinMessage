<?php

namespace tkm\cjm\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use tkm\cjm\FormManager;
use tkm\cjm\Main;

class SetQuitMessageCommand extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("setquitmessage.use");
        $this->setPermissionMessage(Main::$message->get("no-perms"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(Main::getPrefix() . Main::$message->get("no-player"));
            return true;
        }

        if (!$this->testPermission($sender)) {
            return true;
        }

        $formmanger = new FormManager();
        $formmanger->setQuitMessage($sender);
    }
}
