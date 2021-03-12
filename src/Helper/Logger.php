<?php

namespace App\Helper;

use App\Entity\Formations\Formation;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class Logger
 * @package App\Util
 */
class Logger
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var null | self $instance
     */
    private static $instance;
    /**
     * Logger constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param OutputInterface $output
     * @return Logger|null
     */
    public static function getLogger(OutputInterface $output)
    {
        if(!self::$instance) {
            self::$instance = new Logger($output);
        }

        return self::$instance;
    }

    /**
     * @param String $message
     */
    public function logInfo(String $message)
    {
        $this->output->writeln("<info> $message </info>");
    }

    /**
     * @param String $message
     */
    public function logError(String $message)
    {
        $this->output->writeln("<error> $message </error>");
    }

    /**
     * @param Formation $formation
     */
    public function drawFormation(Formation $formation)
    {
        $this->output->writeln('Formation for this game: ');
        $players = $formation->getPlayers()->toArray();
        $len = count($players);
        foreach ($players as $key => $player) {
            if($key == 0 || (array_key_exists($key+1, $players) && $player->getPosition() !== $players[$key+1]->getPosition())) {
                $this->output->writeln(sprintf('%s: %s',$player->getPosition(), $player->getStats()));
            } elseif ($key == $len - 1) {
                $this->output->writeln(sprintf('%s: %s',$player->getPosition(), $player->getStats()));
            } else {
                $this->output->write(sprintf('%s: %s, ',$player->getPosition(), $player->getStats()));
            }
        }
    }
}