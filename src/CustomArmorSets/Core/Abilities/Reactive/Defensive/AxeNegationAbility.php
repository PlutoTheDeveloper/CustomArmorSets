<?php

namespace CustomArmorSets\Core\Abilities\Reactive\Defensive;

use pocketmine\item\Axe;
use pocketmine\Player;

class AxeNegationAbility extends DamageNegationAbility
{
    public function canActivate(Player $damager): bool
    {
        if ($damager->getInventory()->getItemInHand() instanceof Axe) {
            return true;
        }
        return false;
    }
}