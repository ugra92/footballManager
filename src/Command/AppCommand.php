<?php


namespace App\Command;

use App\Entity\Strategies\StrategyAttacking;
use App\Entity\Strategies\StrategyDefensive;
use App\Entity\Strategies\StrategyRegular;
use App\Entity\Team;
use App\Factory\FormationFactory;
use App\Helper\GameSimulator;
use App\Helper\Logger;
use App\Util\DefaultPlayers;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

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
        /**
         * Ask for Team name
         */
        $teamName = $this->askQuestion('Please enter the team name ( Leave blank for "Barcelona :D )"): ', 'Barcelona');

        $team = new Team($teamName);
        $this->logger->logInfo("Successfully created team: $teamName");

        $populateDefaultPlayers = $this->askQuestion('Do you want to auto populate players? [Y/n] ', true, ConfirmationQuestion::class);



        if(!$populateDefaultPlayers) {
            $this->logger->logInfo("You have no players too play with");

            return self::FAILURE;
        }

        $team->addPlayersCollection(DefaultPlayers::getDefaultPlayers());
        $this->logger->logInfo("Players successfully populated");

        $this->logger->logInfo("Playing game 1...");

        /**
         * Game 1 -> defensive formation
         */
        $formationDefensive = FormationFactory::buildFormation(new StrategyDefensive($team));
        $team->setCurrentFormation($formationDefensive);

        $this->logger->drawFormation($formationDefensive);

        GameSimulator::simulateGame($team);

        $this->logger->logInfo(sprintf("Oooops, player: %s got injured :( ", $team->getInjuredPlayers()->first()->getStats()));

        $this->logger->logInfo("Playing game 2...");
        /**
         * Game 2 -> regular formation
         */
        $formationRegular = FormationFactory::buildFormation(new StrategyRegular($team));

        $team->setCurrentFormation($formationRegular);

        $this->logger->drawFormation($formationRegular);

        GameSimulator::simulateGame($team);

        $this->logger->logInfo(sprintf("Oooops, player: %s got injured :( ", $team->getInjuredPlayers()->get(1)->getStats()));

        $this->logger->logInfo("Playing game 3...");
        /**
         * Game 3 -> attacking formation
         */
        $formationAttacking = FormationFactory::buildFormation(new StrategyAttacking($team));

        $team->setCurrentFormation($formationRegular);

        $this->logger->drawFormation($formationAttacking);

        GameSimulator::simulateGame($team);

        $this->logger->logInfo(sprintf("Oooops, player: %s got injured :( ", $team->getInjuredPlayers()->get(2)->getStats()));

        $this->logger->logInfo("Congratulations you have advanced to group stage of UEFA Europa League!!!");
    }


    /**
     * @param $question
     * @param string $defaultValue
     * @param string $questionType
     * @return bool|mixed|string|null
     * @throws \ReflectionException
     */
    private function askQuestion($question, $defaultValue = '', $questionType = Question::class)
    {
        $helper = $this->getHelper('question');
        $class = new ReflectionClass($questionType);
        /**
         * @var ConfirmationQuestion|Question $question
         */
        $question = $class->newInstanceArgs([$question, $defaultValue]);
        return $helper->ask($this->input, $this->output, $question);
    }
}