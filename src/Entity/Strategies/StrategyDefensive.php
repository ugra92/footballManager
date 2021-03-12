<?php


namespace App\Entity\Strategies;

use App\Entity\Base\AbstractStrategy;
use App\Entity\Base\StrategyInterface;
use App\Entity\Team;
use App\Util\PositionUtil;
use App\Util\PropertyUtil;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class StrategyDefensive
 * @package App\Entity\Strategies
 */
class StrategyDefensive extends AbstractStrategy implements StrategyInterface
{

    /**
     * @return ArrayCollection
     */
    public function choosePlayers() : ArrayCollection
    {
        $goalKeeper = $this->getGoalkeeper();
        $defenders = $this->getBestByPositionAndProp(PositionUtil::DEFENCE, $this->getDefNumb());
        $midfielders = $this->getBestByPositionAndProp(PositionUtil::MIDFIELD, $this->getMidNumb());
        $attackers = $this->getBestByPositionAndProp(PositionUtil::ATTACK, $this->getAttNumb(), PropertyUtil::SPEED);

        return new ArrayCollection(array_merge($goalKeeper, $defenders, $midfielders, $attackers));
    }

    public function getDefNumb(): int
    {
        return 5;
    }

    public function getMidNumb(): int
    {
        return 4;
    }

    public function getAttNumb(): int
    {
        return 1;
    }

}