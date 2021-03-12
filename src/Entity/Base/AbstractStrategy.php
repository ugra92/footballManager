<?php

namespace App\Entity\Base;

use App\Entity\Player;
use App\Entity\Team;
use App\Util\PositionUtil;
use App\Util\PropertyUtil;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class AbstractStrategy
 * @package App\Entity\Base
 */
abstract class AbstractStrategy {

    /**
     * @var Team $team;
     */
    protected $team;

    /**
     * AbstractStrategy constructor.
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * Sort provided players by passed property
     * @param array $players
     * @param String $prop
     * @return array
     */
    protected function sortByProp(array $players, String $prop)
    {
        usort($players,  function ($a, $b) use ($prop) {
            return $b->{'get'.ucfirst($prop)}() - $a->{'get'.ucfirst($prop)}();
        });

        return $players;
    }

    /**
     * @param String $position
     * @param int $numb
     * @param string $prop
     * @return array
     */
    protected function getBestByPositionAndProp(String $position, int $numb, string $prop = PropertyUtil::QUALITY)
    {
        $playersByPosition = $this->team->getPlayersForPosition($position);

        return array_slice($this->sortByProp($playersByPosition, $prop), 0, $numb);
    }

    /**
     * Get better goalkeeper
     * @return mixed
     */
    protected function getGoalkeeper()
    {
        $keepers = $this->team->getPlayersForPosition(PositionUtil::GOALKEEPER);
        /**
         * Get better keeper
         */
        return array_slice($this->sortByProp($keepers, PropertyUtil::QUALITY), 0, 1);
    }
}