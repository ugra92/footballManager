<?php

namespace App\Entity\Base;

use App\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AbstractFormation
 * @package App\Entity\Base
 */
abstract class AbstractFormation {

    /**
     * @var ArrayCollection<Player> $players
     */
    protected $players;

    /**
     * AbstractFormation constructor.
     * @param ArrayCollection $players
     */
    public function __construct(ArrayCollection $players)
    {
        $this->players = $players;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayers(): ArrayCollection
    {
        return $this->players;
    }

    /**
     * @param ArrayCollection $players
     * @return AbstractFormation
     */
    public function setPlayers(ArrayCollection $players): AbstractFormation
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @param Player $player
     * @return $this
     */
    public function addPlayer(Player $player)
    {
        if(!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    /**
     * @param Player $player
     * @return $this
     */
    public function removePlayer(Player $player)
    {
        if($this->players->contains($player)) {
            $this->players->removeElement($player);
        }

        return $this;
    }

}