<?php

namespace App\Entity;

use App\Exception\UnknownPositionException;
use App\Util\PositionUtil;

/**
 * Class Player
 * @package App\Entity
 */
class Player
{
    /**
     * @var $position
     */
    protected $position;

    /**
     * @var $quality
     */
    protected $quality;

    /**
     * @var $speed
     */
    protected $speed;

    /**
     * @var Team $team
     */
    protected $team;

    /**
     * Player constructor.
     * @param null $position
     * @param null $quality
     * @param null $speed
     * @param null $team
     */
    public function __construct($position = null, $quality = null, $speed = null, $team = null)
    {
        $this->position = $position;
        $this->quality = $quality;
        $this->speed = $speed;
        $this->team = $team;
    }


    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return Player
     * @throws UnknownPositionException
     */
    public function setPosition($position)
    {
        if (in_array($position, PositionUtil::getPossibleValues())) {
            $this->position = $position;
        } else {
            throw new UnknownPositionException();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     * @return Player
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     * @return Player
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team|null $team
     * @return Player
     */
    public function setTeam($team): Player
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return array|null[]
     */
    public function toArray()
    {
        return ['position' => $this->getPosition(), 'quality' => $this->getQuality(), 'speed' => $this->getSpeed()];
    }

    /**
     * @return string
     */
    public function getStats()
    {
        return sprintf('(Q:%s,S:%s)', $this->getQuality(), $this->getSpeed());
    }
}