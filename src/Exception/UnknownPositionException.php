<?php


namespace App\Exception;

/**
 * Class UnknownPositionException
 * @package App\Exception
 */
class UnknownPositionException extends \Exception
{
    /**
     * UnknownPositionException constructor.
     */
    public function __construct()
    {
        parent::__construct('Trying to set unknown position to player!');
    }

}