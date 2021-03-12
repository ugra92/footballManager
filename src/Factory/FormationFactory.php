<?php


namespace App\Factory;

use App\Entity\Base\StrategyInterface;
use App\Entity\Formations\Formation;
use App\Entity\Formations\FormationAttacking;
use App\Entity\Formations\FormationDefensive;
use App\Entity\Formations\FormationRegular;
use App\Entity\Strategies\StrategyAttacking;
use App\Entity\Strategies\StrategyDefensive;
use App\Entity\Strategies\StrategyRegular;
use App\Entity\Team;

/**
 * Class FormationFactory
 * @package App\Factory
 */
class FormationFactory
{
    /**
     * @param StrategyInterface $strategy
     * @return mixed
     * @throws \Exception
     */
    public static function buildFormation(StrategyInterface $strategy)
    {

        return new Formation($strategy->choosePlayers());
//        switch(get_class($strategy)) {
//            case StrategyDefensive::class:
//                return new FormationDefensive($strategy->choosePlayers());
//            case StrategyAttacking::class:
//                return new FormationAttacking($strategy->choosePlayers());
//            case StrategyRegular::class:
//                return new FormationRegular($strategy->choosePlayers());
//            default:
//                throw new \Exception('Unknown strategy provided');
//        }
    }

}