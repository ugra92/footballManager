<?php


namespace App\Entity\Base;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface StrategyInterface
 * @package App\Entity\Base
 */
interface StrategyInterface
{
    public function choosePlayers(): ArrayCollection;

    public function getDefNumb(): int;
    public function getMidNumb(): int;
    public function getAttNumb(): int;
}