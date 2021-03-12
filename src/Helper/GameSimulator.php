<?php


namespace App\Helper;


use App\Entity\Team;

/**
 * Class GameSimulator
 * @package App\Helper
 */
class GameSimulator
{
    /**
     * @param Team $team
     * @return Team
     */
    public static function simulateGame(Team $team)
    {
        /**
         * Get random injured player
         */
        $player = $team->getCurrentFormation()->getPlayers()->get(rand(1,10));

        /**
         * Remove player from current formation, from players list and add to injured players list
         */
        $team->getCurrentFormation()->removePlayer($player);
        $team->removePlayer($player);
        $team->addInjuredPlayer($player);

        return $team;
    }
}