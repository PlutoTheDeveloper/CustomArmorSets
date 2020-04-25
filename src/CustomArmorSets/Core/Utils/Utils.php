<?php

namespace CustomArmorSets\Core\Utils;

use CustomArmorSets\Core\Main;
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
use pocketmine\entity\Skin;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Player;

class Utils
{
    /**
     * @param Level $level
     * @return bool
     */
    public static function checkProtectionLevel(Level $level): bool
    {
        $blacklist = Main::$instance->getConfig()->get("enable-world-blacklist");
        $whitelist = Main::$instance->getConfig()->get("enable-world-whitelist");
        $levelName = $level->getName();

        if ($blacklist === $whitelist) return true;

        if ($blacklist) {
            $disallowedWorlds = Main::$instance->getConfig()->get("blacklisted-worlds");
            if (in_array($levelName, $disallowedWorlds)) return false;
            return true;
        }

        if ($whitelist) {
            $allowedWorlds = Main::$instance->getConfig()->get("whitelisted-worlds");
            if (in_array($levelName, $allowedWorlds)) return true;
            return false;
        }

        return false;
    }

    /**
     * "Borrowed" from UltraCapes
     * @param string $fileName
     * @return string
     */
    public static function createCape(string $fileName)
    {
        $img = @imagecreatefrompng(Main::$instance->getDataFolder() . $fileName);
        $bytes = '';
        $l = (int)@getimagesize(Main::$instance->getDataFolder() . $fileName)[1];
        for ($y = 0; $y < $l; $y++) {
            for ($x = 0; $x < 64; $x++) {
                $rgba = @imagecolorat($img, $x, $y);
                $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                $r = ($rgba >> 16) & 0xff;
                $g = ($rgba >> 8) & 0xff;
                $b = $rgba & 0xff;
                $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }
        @imagedestroy($img);
        return $bytes;
    }

    /**
     * @param Player $player
     * @param string $fileName
     */
    public static function addCape(Player $player, string $fileName)
    {
        $oldSkin = $player->getSkin();
        $capeData = self::createCape($fileName);
        $skin = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
        $player->setSkin($skin);
        $player->sendSkin();
    }

    /**
     * @param Player $player
     */
    public static function removeCape(Player $player)
    {
        $oldSkin = $player->getSkin();
        $capeData = "";
        $skin = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
        $player->setSkin($skin);
        $player->sendSkin();
    }

    public static function isHelmet(Item $item): bool
    {
        if (
            $item instanceof DiamondHelmet ||
            $item instanceof GoldHelmet ||
            $item instanceof IronHelmet ||
            $item instanceof ChainHelmet ||
            $item instanceof LeatherCap) {
            return true;
        }
        return false;
    }

    public static function isChestplate(Item $item): bool
    {
        if (
            $item instanceof DiamondChestplate ||
            $item instanceof IronChestplate ||
            $item instanceof GoldChestplate ||
            $item instanceof ChainChestplate ||
            $item instanceof LeatherTunic) {
            return true;
        }
        return false;
    }

    public static function isLeggings(Item $item): bool
    {
        if ($item instanceof DiamondLeggings ||
            $item instanceof GoldLeggings ||
            $item instanceof IronLeggings ||
            $item instanceof ChainLeggings ||
            $item instanceof LeatherPants) {
            return true;
        }
        return false;
    }

    public static function isBoots(Item $item): bool
    {
        if ($item instanceof DiamondBoots ||
            $item instanceof GoldBoots ||
            $item instanceof IronBoots ||
            $item instanceof ChainBoots ||
            $item instanceof LeatherBoots) {
            return true;
        }
        return false;
    }
}