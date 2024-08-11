<?php

namespace xtcy\spawnerv1\entity\mobs;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Squid extends \xtcy\spawnerv1\entity\SpawnerEntity
{

    protected function getInitialSizeInfo() : EntitySizeInfo{
        return new EntitySizeInfo(0.95, 0.95);
    }

    public static function getNetworkTypeId() : string{
        return EntityIds::SQUID;
    }


    public function getName() : string{
        return "Squid";
    }

    public function getDrops() : array{
        return [
            VanillaItems::INK_SAC()->setCount(mt_rand(1, 2)),
        ];
    }

    public function getXpDropAmount() : int{
        return 7;
    }
}