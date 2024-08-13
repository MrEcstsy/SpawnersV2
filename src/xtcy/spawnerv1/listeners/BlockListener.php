<?php

namespace xtcy\spawnerv1\listeners;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemBlock;
use pocketmine\item\Pickaxe;
use pocketmine\item\StringToItemParser;
use xtcy\spawnerv1\block\MonsterSpawner;
use pocketmine\block\MonsterSpawner as PMMonsterSpawner;
use pocketmine\event\player\PlayerInteractEvent;
use xtcy\spawnerv1\block\tile\CMonsterSpawner;
use xtcy\spawnerv1\item\items;
use xtcy\spawnerv1\Loader;

class BlockListener implements Listener
{

    public function onPlace(BlockPlaceEvent $event) {
        if($event->isCancelled()) return;
    
        $item = $event->getItem();
        if(!$item instanceof ItemBlock) return;
    
        $block = $item->getBlock();
    
        if(!$block instanceof PMMonsterSpawner || $block instanceof MonsterSpawner) {
            return;
        }
    
        $transaction = $event->getTransaction();
        foreach($transaction->getBlocks() as [$x, $y, $z, $blocks]){
            $transaction->addBlock($blocks->getPosition()->asVector3(), items::MONSTER_SPAWNER()->setLegacyEntityId(items::getSpawnerEntityId($item)));
        }
    }
    

    public function onSpawnerBreak(BlockBreakEvent $event): void
    {
        if($event->isCancelled()){
            return;
        }
        $item = $event->getItem();
        $tile = ($position = $event->getBlock()->getPosition())->getWorld()->getTile($position);
        if(
            !$tile instanceof CMonsterSpawner or
            !$item instanceof Pickaxe or
            !$item->hasEnchantment(VanillaEnchantments::SILK_TOUCH())
        ){
            return;
        }
        $event->setDrops([StringToItemParser::getInstance()->parse($this->convert($tile->getLegacyEntityId()) . "_spawner") ?? items::MONSTER_SPAWNER()->asItem()]);
    }

    public function convert(int $id): string
    {
        return match ($id) {
            10 => "chicken",
            11 => "cow",
            12 => "pig",
            17 => "squid",
            20 => "iron_golem",
            32 => "zombie",
            36 => "zombie_pigman",
            34 => "skeleton",
            37 => "slime",
            16 => "mooshroom",
            43 => "blaze",
            default => "unknown",
        };
    }

    public function onInteract(PlayerInteractEvent $event): void {
        if($event->isCancelled()) {
            return;
        }
    
        $block = $event->getBlock();
        $player = $event->getPlayer();
        $position = $block->getPosition();
    
        $tile = $block->getPosition()->getWorld()->getTile($position);
    
        if ($tile instanceof CMonsterSpawner) {            
            $entityId = $tile->getEntityTypeId();
            $value = $tile->getSpawnerValue();

            
        }
    }
}