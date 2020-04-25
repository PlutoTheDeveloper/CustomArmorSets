<?php

namespace CustomArmorSets\Core\ArmorSets;

use CustomArmorSets\Core\Pocketmine\Chain\ChainBoots;
use CustomArmorSets\Core\Pocketmine\Chain\ChainChestplate;
use CustomArmorSets\Core\Pocketmine\Chain\ChainHelmet;
use CustomArmorSets\Core\Pocketmine\Chain\ChainLeggings;
use CustomArmorSets\Core\Pocketmine\Diamond\DiamondBoots;
use CustomArmorSets\Core\Pocketmine\Diamond\DiamondChestplate;
use CustomArmorSets\Core\Pocketmine\Diamond\DiamondHelmet;
use CustomArmorSets\Core\Pocketmine\Diamond\DiamondLeggings;
use CustomArmorSets\Core\Pocketmine\Gold\GoldBoots;
use CustomArmorSets\Core\Pocketmine\Gold\GoldChestplate;
use CustomArmorSets\Core\Pocketmine\Gold\GoldHelmet;
use CustomArmorSets\Core\Pocketmine\Gold\GoldLeggings;
use CustomArmorSets\Core\Pocketmine\Iron\IronBoots;
use CustomArmorSets\Core\Pocketmine\Iron\IronChestplate;
use CustomArmorSets\Core\Pocketmine\Iron\IronHelmet;
use CustomArmorSets\Core\Pocketmine\Iron\IronLeggings;
use CustomArmorSets\Core\Pocketmine\Leather\LeatherBoots;
use CustomArmorSets\Core\Pocketmine\Leather\LeatherCap;
use CustomArmorSets\Core\Pocketmine\Leather\LeatherPants;
use CustomArmorSets\Core\Pocketmine\Leather\LeatherTunic;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as C;

class ArmorSetUtils
{

    /**
     * @param string $name
     * @return int|null
     */
    public static function getTierFromName(string $name): ?int
    {
        switch ($name) {
            case "leather":
                return CustomArmorSet::TIER_LEATHER;
            case "chainmail":
                return CustomArmorSet::TIER_CHAIN;
            case "gold":
                return CustomArmorSet::TIER_GOLD;
            case "iron":
                return CustomArmorSet::TIER_IRON;
            case "diamond":
                return CustomArmorSet::TIER_DIAMOND;
            default:
                return null;
        }
    }

    /**
     * @param int $tier
     * @return Item
     */
    public static function getHelmetFromTier(int $tier): Item
    {
        switch ($tier) {
            case CustomArmorSet::TIER_DIAMOND:
                return new DiamondHelmet();
            case CustomArmorSet::TIER_IRON:
                return new IronHelmet();
            case CustomArmorSet::TIER_GOLD:
                return new GoldHelmet();
            case CustomArmorSet::TIER_CHAIN:
                return new ChainHelmet();
            case CustomArmorSet::TIER_LEATHER:
                return new LeatherCap();
            default:
                return Item::get(Item::AIR);
        }
    }

    /**
     * @param int $tier
     * @return Item
     */
    public static function getChestplateFromTier(int $tier): Item
    {
        switch ($tier) {
            case CustomArmorSet::TIER_DIAMOND:
                return new DiamondChestplate();
            case CustomArmorSet::TIER_IRON:
                return new IronChestplate();
            case CustomArmorSet::TIER_GOLD:
                return new GoldChestplate();
            case CustomArmorSet::TIER_CHAIN:
                return new ChainChestplate();
            case CustomArmorSet::TIER_LEATHER:
                return new LeatherTunic();
            default:
                return Item::get(Item::AIR);
        }
    }

    /**
     * @param int $tier
     * @return Item
     */
    public static function getLeggingsFromTier(int $tier): Item
    {
        switch ($tier) {
            case CustomArmorSet::TIER_DIAMOND:
                return new DiamondLeggings();
            case CustomArmorSet::TIER_IRON:
                return new IronLeggings();
            case CustomArmorSet::TIER_GOLD:
                return new GoldLeggings();
            case CustomArmorSet::TIER_CHAIN:
                return new ChainLeggings();
            case CustomArmorSet::TIER_LEATHER:
                return new LeatherPants();
            default:
                return Item::get(Item::AIR);
        }
    }

    /**
     * @param int $tier
     * @return Item
     */
    public static function getBootsFromTier(int $tier): Item
    {
        switch ($tier) {
            case CustomArmorSet::TIER_DIAMOND:
                return new DiamondBoots();
            case CustomArmorSet::TIER_IRON:
                return new IronBoots();
            case CustomArmorSet::TIER_GOLD:
                return new GoldBoots();
            case CustomArmorSet::TIER_CHAIN:
                return new ChainBoots();
            case CustomArmorSet::TIER_LEATHER:
                return new LeatherBoots();
            default:
                return Item::get(Item::AIR);
        }
    }

    public static function getHelmetLore(array $lores, array $setBonusLore)
    {
        $lore = [];
        $itemLore = [];
        $setBonus = implode("\n", $setBonusLore);

        if (isset($lores["helmet"])) {
            $itemLore = $lores["helmet"];
        }
        foreach ($itemLore as $line) {
            $lore[] = C::RESET . C::colorize(str_replace("{FULLSETBONUS}", $setBonus, $line));
        }

        return $lore;
    }

    public static function getChestplateLore(array $lores, array $setBonusLore)
    {
        $lore = [];
        $itemLore = [];
        $setBonus = implode("\n", $setBonusLore);

        if (isset($lores["chestplate"])) {
            $itemLore = $lores["chestplate"];
        }
        foreach ($itemLore as $line) {
            $lore[] = C::RESET . C::colorize(str_replace("{FULLSETBONUS}", $setBonus, $line));
        }

        return $lore;
    }

    public static function getLeggingsLore(array $lores, array $setBonusLore)
    {
        $lore = [];
        $itemLore = [];
        $setBonus = implode("\n", $setBonusLore);

        if (isset($lores["leggings"])) {
            $itemLore = $lores["leggings"];
        }
        foreach ($itemLore as $line) {
            $lore[] = C::RESET . C::colorize(str_replace("{FULLSETBONUS}", $setBonus, $line));
        }

        return $lore;
    }

    public static function getBootsLore(array $lores, array $setBonusLore)
    {
        $lore = [];
        $itemLore = [];
        $setBonus = implode("\n", $setBonusLore);

        if (isset($lores["boots"])) {
            $itemLore = $lores["boots"];
        }
        foreach ($itemLore as $line) {
            $lore[] = C::RESET . C::colorize(str_replace("{FULLSETBONUS}", $setBonus, $line));
        }

        return $lore;
    }

    public static function getTotalStrengthPoints(int $tier, array $strength): int
    {
        $helmetStrength = self::getHelmetFromTier($tier)->getDefensePoints();
        if (isset($strength["helmet"])) {
            $helmetStrength = $strength["helmet"];
        }

        $chestplateStrength = self::getChestplateFromTier($tier)->getDefensePoints();
        if (isset($strength["chestplate"])) {
            $chestplateStrength = $strength["chestplate"];
        }

        $leggingsStrength = self::getLeggingsFromTier($tier)->getDefensePoints();
        if (isset($strength["leggings"])) {
            $leggingsStrength = $strength["leggings"];
        }

        $bootsStrength = self::getBootsFromTier($tier)->getDefensePoints();
        if (isset($strength["boots"])) {
            $helmetStrength = $strength["boots"];
        }

        return $helmetStrength + $chestplateStrength + $leggingsStrength + $bootsStrength;

    }
}