<?php

namespace xtcy\spawnerv1\entity\mobs;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Pig extends \xtcy\spawnerv1\entity\SpawnerEntity
{

    protected function getInitialSizeInfo() : EntitySizeInfo{
        return new EntitySizeInfo(0.9, 0.9);
    }

    public static function getNetworkTypeId() : string{
        return EntityIds::PIG;
    }


    public function getName() : string{
        return "Pig";
    }

    public function getDrops() : array{
        return [
            VanillaItems::RAW_PORKCHOP()->setCount(mt_rand(1, 2)),
        ];
    }

    public function getXpDropAmount() : int{
        return 4;
    }
}