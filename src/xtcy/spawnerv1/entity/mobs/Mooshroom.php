<?php

namespace xtcy\spawnerv1\entity\mobs;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Mooshroom extends \xtcy\spawnerv1\entity\SpawnerEntity
{

    protected function getInitialSizeInfo() : EntitySizeInfo{
        return new EntitySizeInfo(1.3, 0.9);
    }

    public static function getNetworkTypeId() : string{
        return EntityIds::MOOSHROOM;
    }


    public function getName() : string{
        return "Mooshroom";
    }

    public function getDrops() : array{
        return [
            VanillaBlocks::BROWN_MUSHROOM()->asItem()->setCount(mt_rand(1, 2)),
            VanillaBlocks::RED_MUSHROOM()->asItem()->setCount(mt_rand(1, 2)),
        ];
    }

    public function getXpDropAmount() : int{
        return 7;
    }
}