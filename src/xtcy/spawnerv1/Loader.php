<?php

namespace xtcy\spawnerv1;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\block\tile\TileFactory;
use pocketmine\data\bedrock\block\BlockTypeNames;
use pocketmine\item\StringToItemParser;
use pocketmine\item\ToolTier;
use pocketmine\plugin\PluginBase;
use xtcy\spawnerv1\block\MonsterSpawner;
use xtcy\spawnerv1\block\tile\CMonsterSpawner;
use xtcy\spawnerv1\item\items;
use xtcy\spawnerv1\listeners\BlockListener;

class Loader extends PluginBase {

    public static Loader $instance;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        items::getAll();
        items::initHack();

        TileFactory::getInstance()->register(CMonsterSpawner::class, ['MobSpawner', 'minecraft:mob_spawner']);

        $this->getServer()->getPluginManager()->registerEvents(new BlockListener(), $this);
        $this->saveDefaultConfig();
    }

    public static function getInstance(): Loader {
        return self::$instance;
    }
}