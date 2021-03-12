<?php


namespace App\Util;

/**
 * Class PositionUtil
 * @package App\Util
 */
class PositionUtil
{

    public const GOALKEEPER = 'Goalkeeper';
    public const DEFENCE = 'Defence';
    public const MIDFIELD = 'Midfield';
    public const ATTACK = 'Attack';

    /**
     * Get all poossible positions
     * @return string[]
     */
    public static function getPossibleValues()
    {
        return [
            self::GOALKEEPER, self::DEFENCE, self::MIDFIELD, self::ATTACK
        ];
    }
}