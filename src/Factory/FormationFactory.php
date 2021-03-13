<?php


namespace App\Factory;

use App\Entity\Base\StrategyInterface;
use App\Entity\Formations\Formation;

/**
 * Class FormationFactory
 * @package App\Factory
 */
class FormationFactory
{
    /**
     * @param StrategyInterface $strategy
     * @return Formation
     */
    public static function buildFormation(StrategyInterface $strategy)
    {
        return new Formation($strategy->choosePlayers());
    }

}