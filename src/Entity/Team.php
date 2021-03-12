<?php

namespace App\Entity;

use App\Entity\Formations\Formation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Team
 * @package App\Entity
 */
class Team
{
    /**
     * @var String $name
     */
    protected $name;

    /**
     * @var ArrayCollection<Player> $players
     */
    protected $players;

    /**
     * @var ArrayCollection<Player> $injuredPlayers
     */
    protected $injuredPlayers;

    /**
     * @var Formation $currentFormation
     */
    protected $currentFormation;

    /**
     * Team constructor.
     * @param String $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->players = new ArrayCollection();
        $this->injuredPlayers = new ArrayCollection();
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
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
     * @return Team
     */
    public function setPlayers(ArrayCollection $players): Team
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getInjuredPlayers(): ArrayCollection
    {
        return $this->injuredPlayers;
    }

    /**
     * @param ArrayCollection $injuredPlayers
     * @return Team
     */
    public function setInjuredPlayers(ArrayCollection $injuredPlayers): Team
    {
        $this->injuredPlayers = $injuredPlayers;
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
            $player->setTeam($this);
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
            $player->setTeam(null);
        }

        return $this;
    }

    /**
     * @return Formation
     */
    public function getCurrentFormation(): Formation
    {
        return $this->currentFormation;
    }

    /**
     * @param Formation $currentFormation
     * @return Team
     */
    public function setCurrentFormation(Formation $currentFormation): Team
    {
        $this->currentFormation = $currentFormation;
        return $this;
    }

    /**
     * @param Player $injuredPlayer
     * @return $this
     */
    public function addInjuredPlayer(Player $injuredPlayer)
    {
        if(!$this->injuredPlayers->contains($injuredPlayer)) {
            $this->injuredPlayers->add($injuredPlayer);
        }

        return $this;
    }

    /**
     * @param Player $injuredPlayer
     * @return $this
     */
    public function removeInjuredPlayer(Player $injuredPlayer)
    {
        if($this->injuredPlayers->contains($injuredPlayer)) {
            $this->injuredPlayers->removeElement($injuredPlayer);
        }

        return $this;
    }



    /**
     * @param String $position
     * @return array
     */
    public function getPlayersForPosition(String $position)
    {
        return array_filter($this->players->toArray(), function ($player) use ($position) {
            /**
             * @var Player $player
             */
            return $position === $player->getPosition();
        });
    }


    /**
     * @param ArrayCollection<Player> $players
     * @return Team
     */
    public function addPlayersCollection(ArrayCollection $players)
    {
        foreach ($players as $player) {
            /**
             * @var Player $player
             */
            $this->addPlayer($player);
//            switch ($player->getPosition()){
//                case PositionUtil::GOALKEEPER:
//                    $this->goalkeepers->add($player);
//                    break;
//                case PositionUtil::DEFENCE:
//                    $this->defenders->add($player);
//                    break;
//                case PositionUtil::MIDFIELD:
//                    $this->midfielders->add($player);
//                    break;
//                case PositionUtil::ATTACK:
//                    $this->attackers->add($player);
//                    break;
//            }
        }
        return $this;
    }
}