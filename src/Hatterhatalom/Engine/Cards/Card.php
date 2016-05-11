<?php

namespace Hatterhatalom\Engine\Cards;

/**
 * Class Card represents a single card entity in the game.
 *
 * @package Hatterhatalom\Engine\Cards
 */
abstract class Card
{
    /**
     * The cost of the card.
     *
     * @var int
     */
    protected $cost;

    /**
     * Gets the cost of the card.
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }
}