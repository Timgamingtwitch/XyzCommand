<?php
    
declare(strict_types=1);

namespace TimGamingTwitch\XyzVanillaCMD;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use TimGamingTwitch\XyzVanillaCMD\command\XyzVanillaCMD;

class Loader extends PluginBase {

	protected $config;
	protected static $instance;

	public function onEnable(): void {
		self::$instance = $this;

        ($this->getDataFolder());
		$this->saveResource('config.yml');
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);

		$this->getServer()->getCommandMap()->register("XyzVanillaCMD", new XyzVanillaCMD());
	}

	public static function getInstance(): self {
		return self::$instance;
	}

}