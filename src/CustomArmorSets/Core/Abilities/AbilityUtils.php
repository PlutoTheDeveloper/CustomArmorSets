<?php

namespace CustomArmorSets\Core\Abilities;

use CustomArmorSets\Core\Abilities\Reactive\Defensive\AxeNegationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Defensive\BowNegationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Defensive\DamageNegationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Defensive\KnockbackNegationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Defensive\SwordNegationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Offensive\AxeAmplificationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Offensive\BowAmplificationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Offensive\DamageAmplificationAbility;
use CustomArmorSets\Core\Abilities\Reactive\Offensive\SwordAmplificationAbility;
use CustomArmorSets\Core\Abilities\Togglable\CapeAbility;
use CustomArmorSets\Core\Abilities\Togglable\EffectAbility;
use CustomArmorSets\Core\Abilities\Togglable\PermissionAbility;
use CustomArmorSets\Core\Abilities\Togglable\ScaleAbility;
use CustomArmorSets\Core\Main;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\Server;

class AbilityUtils
{

    /**
     * @param string $ability
     * @param mixed $value
     * @return ArmorAbility|null
     */
    public static function getAbility(string $ability, $value): ?ArmorAbility
    {
        switch ($ability) {
            case "Scale":
                return new ScaleAbility($value);
            case "Permission":
                return new PermissionAbility($value);
            case "Knockback":
                return new KnockbackNegationAbility($value);
            case "DamageNegation":
                return new DamageNegationAbility($value);
            case "SwordNegation":
                return new SwordNegationAbility($value);
            case "AxeNegation":
                return new AxeNegationAbility($value);
            case "BowNegation":
                return new BowNegationAbility($value);
            case "DamageAmplification":
                return new DamageAmplificationAbility($value);
            case "SwordAmplification":
                return new SwordAmplificationAbility($value);
            case "AxeAmplification":
                return new AxeAmplificationAbility($value);
            case "BowAmplification":
                return new BowAmplificationAbility($value);
            case "Cape":
                if (!extension_loaded("gd")) {
                    Server::getInstance()->getLogger()->info(Main::PREFIX . ": gd extension missing! Cape Ability Disabled.");
                    return null;
                }
                return new CapeAbility($value);
            default:
                return null;
        }
    }

    /**
     * @param string $ability
     * @param array $value
     * @return array
     */
    public static function getEffectAbilities(string $ability, array $value): array
    {
        $abilities = [];
        if ($ability !== "Effect") {
            return $abilities;
        }
        foreach ($value as $effect) {
            foreach ($effect as $effectName => $level) {
                $effectInstance = new EffectInstance(Effect::getEffectByName($effectName), 999999, $level - 1);
                $abilities[] = new EffectAbility($effectInstance);
            }
        }
        return $abilities;
    }
}