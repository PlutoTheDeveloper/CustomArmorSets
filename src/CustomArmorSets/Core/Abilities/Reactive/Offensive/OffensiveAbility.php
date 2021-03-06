<?php

namespace CustomArmorSets\Core\Abilities\Reactive\Offensive;

use CustomArmorSets\Core\Abilities\Reactive\ReactiveAbility;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;

class OffensiveAbility extends ReactiveAbility
{
    public function canActivate(Player $damager): bool
    {
        return true;
    }

    public function activate(EntityDamageByEntityEvent $event)
    {

    }
}