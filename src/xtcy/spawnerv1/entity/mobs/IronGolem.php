<?php

namespace xtcy\spawnerv1\entity\mobs;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class IronGolem extends \xtcy\spawnerv1\entity\SpawnerEntity
{

    protected function getInitialSizeInfo() : EntitySizeInfo{
        return new EntitySizeInfo(2.9, 1.4);
    }

    public static function getNetworkTypeId() : string{
        return EntityIds::IRON_GOLEM;
    }

    public function attack(EntityDamageEvent $source) : void{

        if($source->getCause() === EntityDamageEvent::CAUSE_LAVA){
            $source->setBaseDamage($source->getBaseDamage() / 2);
        }

        parent::attack($source);
    }

    public function getXpDropAmount() : int{
        return 8;
    }

    public function getName() : string{
        return "Iron Golem";
    }

    public function getDrops() : array{
        return [
            VanillaBlocks::IRON()->asItem()->setCount(mt_rand(1, 2)),
        ];
    }
}