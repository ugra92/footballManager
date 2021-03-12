<?php

namespace App\Util;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DefaultPlayers
 * @package App\Util
 */
class DefaultPlayers
{

    /**
     * @return Player[]
     */
    public static function getDefaultPlayers(){

        return new ArrayCollection([
            new Player(PositionUtil::GOALKEEPER, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::GOALKEEPER, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::DEFENCE, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::MIDFIELD, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::ATTACK, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::ATTACK, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::ATTACK, rand(50, 100), rand(50, 100)),
            new Player(PositionUtil::ATTACK, rand(50, 100), rand(50, 100)),
        ]);
    }
}