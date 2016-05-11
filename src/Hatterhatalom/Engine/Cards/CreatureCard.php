<?php

namespace Hatterhatalom\Engine\Cards;

/**
 * Class CreatureCard represents a single creature card.
 *
 * @package Hatterhatalom\Engine\Cards
 */
abstract class CreatureCard extends Card
{
    /**
     * Attack points of the creature.
     *
     * @var int
     */
    protected $attackPoints;

    /**
     * Defense points of the creature.
     *
     * @var int
     */
    protected $defensePoints;

    /**
     * Gets the attack points of the creature.
     *
     * @return int
     */
    public function getAttackPoints()
    {
        return $this->attackPoints;
    }

    /**
     * Gets the defense points of the creature.
     *
     * @return int
     */
    public function getDefensePoints()
    {
        return $this->defensePoints;
    }
}