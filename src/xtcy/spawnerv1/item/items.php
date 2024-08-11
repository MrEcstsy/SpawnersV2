<?php

namespace xtcy\spawnerv1\item;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\item\ToolTier;
use pocketmine\utils\CloningRegistryTrait;
use pocketmine\utils\TextFormat;
use xtcy\spawnerv1\block\MonsterSpawner;
use xtcy\spawnerv1\block\tile\CMonsterSpawner;

/**
 * @method static MonsterSpawner MONSTER_SPAWNER()
 */

class items {

    use CloningRegistryTrait;

    private static int $spawnerRuntimeId = 0;

    protected static function setup(): void
    {
        self::registerOverriders();
    }

    private static function registerOverriders() : void {
        self::_registryRegister('monster_spawner',
            new MonsterSpawner(new BlockIdentifier(self::$spawnerRuntimeId = BlockTypeIds::MONSTER_SPAWNER, CMonsterSpawner::class),
                'SB Monster Spawner',
                new BlockTypeInfo(new BlockBreakInfo(5.0, BlockToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel()))));
    }

    /**
     * @return items[]
     */
    public static function getAll(): array {
        return self::_registryGetAll();
    }

    protected static function register(string $name, items $item) : void {
        self::_registryRegister($name, $item);
    }

    public static function fromString(string $name): items {
        $result = self::_registryFromString($name);
        assert($result instanceof items);
        return $result;
    }

    public static function initHack() :void {
        static $nameToMeta = [
            10 => "Chicken",
            11 => "Cow",
            12 => "Pig",
            17 => "Squid",
            20 => "Iron Golem",
            32 => "Zombie",
            36 => "Zombie Pigman",
            34 => "Skeleton",
            37 => "Slime",
            16 => "Mooshroom",
            43 => "Blaze",
        ];

        foreach($nameToMeta as $meta => $name){
            StringToItemParser::getInstance()->override($name . "_spawner", fn() => self::setSpawnerEntityId(
                self::MONSTER_SPAWNER()->asItem(), $meta
            )->setCustomName(
                TextFormat::colorize("&r&d{$name} &r&fSpawner&r"
            )));

        }
    }

    public static function setSpawnerEntityId(Item $item, Int $id) : Item{
        $namedtag = $item->getNamedTag();
        $namedtag->setInt('SpawnerEntityId', $id);
        $item->setNamedTag($namedtag);
        return $item;
    }
}