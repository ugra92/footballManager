<?php


namespace App\Command;

use App\Factory\TeamFactory;
use App\Helper\EuropaLeagueSimulator;
use App\Helper\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AppCommand
 * @package App\Command
 */
class AppCommand extends Command
{
    /**
     * @var Logger $logger
     */
    private $logger;

    private $input;

    private $output;

    /**
     * @var string
     */
    protected static $defaultName = 'app:simulate';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger = new Logger($output);
        $this->input = $input;
        $this->output = $output;

        $this->doSimulation();

        return self::SUCCESS;
    }

    /**
     * Do actual simulation
     */
    private function doSimulation()
    {
        $teamFactory = new TeamFactory($this->logger, $this->getHelper('question'), $this->input, $this->output);
        $team = $teamFactory->buildTeam();
        $leagueSimulator = new EuropaLeagueSimulator($team, $this->logger);
        $leagueSimulator->simulateEuropaLeague();
    }

}