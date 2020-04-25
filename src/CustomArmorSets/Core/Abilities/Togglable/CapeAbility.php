<?php

namespace CustomArmorSets\Core\Abilities\Togglable;

use CustomArmorSets\Core\Utils\Utils;
use pocketmine\Player;

class CapeAbility extends TogglableAbility
{
    /**
     * @var string
     */
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function on(Player $player)
    {
        Utils::addCape($player, $this->file);
    }

    public function off(Player $player)
    {
        Utils::removeCape($player);
    }
}