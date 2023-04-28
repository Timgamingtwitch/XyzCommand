<?php

declare(strict_types=1);

namespace TimGamingTwitch\XyzVanillaCMD\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use TimGamingTwitch\XyzVanillaCMD\Loader;

class XyzVanillaCMD extends Command {

    /** @var int */
    private $count;

    public function __construct() {
        parent::__construct("xyz", "activer / desactiver les coordonnées", "xyz", []);
        $this->count = 0;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $this->count++;
        if ($this->count % 2 == 1) {
            $pk = new GameRulesChangedPacket();
            $pk->gameRules = ["showcoordinates" => new BoolGameRule(true, false)];
            $sender->getNetworkSession()->sendDataPacket($pk);
            $sender->sendMessage(Loader::getInstance()->getConfig()->get("turned-on"));
        } else {
            $pk = new GameRulesChangedPacket();
            $pk->gameRules = ["showcoordinates" => new BoolGameRule(false, false)];
            $sender->getNetworkSession()->sendDataPacket($pk);
            $sender->sendMessage(Loader::getInstance()->getConfig()->get("turned-off"));
        }
        return true;
    }
}