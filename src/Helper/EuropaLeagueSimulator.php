<?php

namespace App\Helper;

use App\Entity\Base\StrategyInterface;
use App\Entity\Strategies\StrategyAttacking;
use App\Entity\Strategies\StrategyDefensive;
use App\Entity\Strategies\StrategyRegular;
use App\Entity\Team;
use App\Exception\InjuredPlayersForPositionException;
use App\Factory\FormationFactory;
use ReflectionClass;

/**
 * Class EuropaLeagueSimulator
 * @package App\Helper
 */
class EuropaLeagueSimulator
{

    /**
     * @var string[]
     */
    const GAMES_ARRAY = [
        StrategyDefensive::class,
        StrategyRegular::class,
        StrategyAttacking::class
    ];
    /**
     * @var Team
     */
    private $team;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * EuropaLeagueSimulator constructor.
     * @param Team $team
     * @param Logger $logger
     */
    public function __construct(Team $team, Logger $logger)
    {
        $this->team = $team;
        $this->logger = $logger;
    }


    /**
     * Simulate games for group stage
     */
    public function simulateEuropaLeague()
    {
        foreach (self::GAMES_ARRAY as $key => $strategy)
        {
            try {
                $strategyObj = new ReflectionClass($strategy);
                /** @var StrategyInterface $strategy */
                $strategy = $strategyObj->newInstanceArgs([$this->team]);
                self::playGame($strategy, $key);
            } catch (\ReflectionException $e) {
                $this->logger->logError('Strategy does not exist');
            } catch (InjuredPlayersForPositionException $e) {
                $this->logger->logError($e->getMessage());
                return;
            }
        }

        $this->logger->logInfo("Congratulations you have advanced to group stage of UEFA Europa League!!!");
    }


    /**
     * @param StrategyInterface $strategy
     * @param $gameCont
     */
    private function playGame(StrategyInterface $strategy, $gameCont)
    {
        $this->logger->logInfo("Playing game $gameCont...");
        $formation = FormationFactory::buildFormation($strategy);
        $this->team->setCurrentFormation($formation);
        $this->logger->drawFormation($formation);
        $injuredPlayer = GameSimulator::simulateGame($this->team);
        $this->logger->logInfo(sprintf("Oooops, player: %s got injured :( ", $injuredPlayer->getStats()));
    }
}