<?php


namespace App\Exception;

/**
 * Class InjuredPlayersForPositionException
 * @package App\Exception
 */
class InjuredPlayersForPositionException extends \Exception
{
    /**
     * UnknownPositionException constructor.
     * @param String $position
     */
    public function __construct(String $position)
    {
        parent::__construct("Not enough players for position: {$position}!");
    }

}