<?php

namespace App\Util;

use App\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DefaultPlayers
 * @package App\Util
 */
class DefaultPlayers
{

    /**
     * @return ArrayCollection
     */
    public static function getDefaultPlayers()
    {

        return new ArrayCollection(array_merge(
            self::getNPlayersForPosition(PositionUtil::GOALKEEPER, 2),
            self::getNPlayersForPosition(PositionUtil::DEFENCE, 6),
            self::getNPlayersForPosition(PositionUtil::MIDFIELD, 10),
            self::getNPlayersForPosition(PositionUtil::ATTACK, 4)
        ));
    }

    /**
     * @param $n
     * @param $position
     * @return array
     */
    private static function getNPlayersForPosition($position, $n)
    {
        $arr = [];
        for ($i = 0; $i < $n; $i++) {
            $arr[] = (new Player($position, rand(50, 100), rand(50, 100)));
        }

        return $arr;
    }
}