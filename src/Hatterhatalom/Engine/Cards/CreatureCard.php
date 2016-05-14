<?php

namespace Hatterhatalom\Engine\Cards;

/**
 * Class CreatureCard represents a single creature card.
 */
abstract class CreatureCard extends Card
{
    /**
     * Attack points of the creature.
     *
     * @var int
     */
    protected $attackPoints = 0;

    /**
     * Defense points of the creature.
     *
     * @var int
     */
    protected $defensePoints = 0;

    /**
     * Gets the attack points of the creature.
     *
     * @return int
     */
    public function attackPoints()
    {
        return $this->attackPoints;
    }

    /**
     * Gets the defense points of the creature.
     *
     * @return int
     */
    public function defensePoints()
    {
        return $this->defensePoints;
    }

    /**
     * Sets the attack points of the card to a given value.
     *
     * @param int $attack
     */
    public function setAttackPoints($attack)
    {
        $this->attackPoints = $attack;
    }

    /**
     * Sets the defense points of the card to a given value.
     *
     * @param int $defense
     */
    public function setDefensePoints($defense)
    {
        $this->defensePoints = $defense;
    }
}
