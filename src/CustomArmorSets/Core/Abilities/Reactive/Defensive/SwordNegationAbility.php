<?php

namespace CustomArmorSets\Core\Abilities\Reactive\Defensive;

use pocketmine\item\Sword;
use pocketmine\Player;

class SwordNegationAbility extends DamageNegationAbility
{
    public function canActivate(Player $damager): bool
    {
        if ($damager->getInventory()->getItemInHand() instanceof Sword) {
            return true;
        }
        return false;
    }
}