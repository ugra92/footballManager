<?php


namespace App\Factory;

use App\Entity\Team;
use App\Helper\Logger;
use App\Util\DefaultPlayers;
use ReflectionClass;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Class TeamFactory
 * @package App\Factory
 */
class TeamFactory
{
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var QuestionHelper
     */
    private $helper;
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * TeamFactory constructor.
     * @param Logger $logger
     * @param QuestionHelper $helper
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(Logger $logger, QuestionHelper $helper, InputInterface $input, OutputInterface $output)
    {
        $this->logger = $logger;
        $this->helper = $helper;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return Team
     */
    public function buildTeam()
    {
        /** Ask for Team name */
        $teamName = $this->askQuestion('Please enter the team name ( Leave blank for "Barcelona :D )"): ', 'Barcelona');
        $team = new Team($teamName);
        $this->logger->logInfo("Successfully created team: $teamName");
        $populateDefaultPlayers = $this->askQuestion('Do you want to auto populate players? [Y/n] ', true, ConfirmationQuestion::class);
        if (!$populateDefaultPlayers) {
            $this->logger->logInfo("You have no players too play with");
        }
        $team->addPlayersCollection(DefaultPlayers::getDefaultPlayers());
        $this->logger->logInfo("Players successfully populated");

        return $team;
    }

    /**
     * @param $question
     * @param string $defaultValue
     * @param string $questionType
     * @return bool|mixed|string|null
     */
    private function askQuestion($question, $defaultValue = '', $questionType = Question::class)
    {
        try {
            $class = new ReflectionClass($questionType);
            /** @var ConfirmationQuestion|Question $question */
            $question = $class->newInstanceArgs([$question, $defaultValue]);
            return $this->helper->ask($this->input, $this->output, $question);
        } catch (\ReflectionException $e) {
            return false;
        }
    }

}