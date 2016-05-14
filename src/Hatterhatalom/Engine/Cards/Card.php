<?php

namespace Hatterhatalom\Engine\Cards;

use Hatterhatalom\Engine\Contracts\CardLocation;
use Hatterhatalom\Engine\Events\Arguments\CardAction;
use Hatterhatalom\Engine\Events\CardEvents\CardIsBeingDestroyed;
use Hatterhatalom\Engine\Events\CardEvents\CardIsBeingPlayed;
use Hatterhatalom\Engine\Events\CardEvents\CardWasDestroyed;
use Hatterhatalom\Engine\Events\CardEvents\CardWasPlayed;
use Hatterhatalom\Engine\Player;

/**
 * Class Card represents a single card entity in the game.
 */
abstract class Card
{
    /**
     * The cost of the card.
     *
     * @var int
     */
    protected $cost = 0;

    /**
     * The owner of the card.
     *
     * @var Player
     */
    protected $owner;

    /**
     * The location of the card.
     *
     * @var CardLocation
     */
    protected $location;

    /**
     * Value indicating whether the card is in game.
     *
     * @var
     */
    protected $isInGame = false;

    /**
     * Gets a value indicating whether the card is in game.
     *
     * @return bool
     */
    public function isInGame()
    {
        return $this->isInGame;
    }

    /**
     * Plays the card.
     *
     * @return $this
     */
    public function play()
    {
        $cardAction = new CardAction($this);
        $this->owner()->game()->trigger(new CardIsBeingPlayed($cardAction));

        if ($cardAction->shouldHappen) {
            $this->isInGame = true;
            $this->location = $this->owner()->game()->board();
            $this->owner()->game()->trigger(new CardWasPlayed($this));
            $this->onPlayed();
        }

        return $this;
    }

    /**
     * Method called when the card is played (after the CardWasPlayed event
     * listeners are all called).
     */
    public function onPlayed()
    {
    }

    /**
     * Gets the cost of the card.
     *
     * @return int
     */
    public function cost()
    {
        return $this->cost;
    }

    /**
     * Sets the cost of the card to a given value.
     *
     * @param int $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * Gets the owner of the card.
     *
     * @return Player
     */
    public function owner()
    {
        return $this->owner;
    }

    /**
     * Sets a player as the owner of the card.
     *
     * @param Player $player
     */
    public function setOwner(Player $player)
    {
        $this->owner = $player;
    }

    /**
     * Gets the location of the card.
     *
     * @return CardLocation
     */
    public function location()
    {
        return $this->location;
    }

    /**
     * Destroys the card.
     *
     * @return $this
     */
    public function destroy()
    {
        $action = new CardAction($this);

        $this->owner()->game()->trigger(new CardIsBeingDestroyed($action));

        if ($action->shouldHappen) {
            $this->isInGame = false;
            $this->owner()->game()->trigger(new CardWasDestroyed($this));
            // TODO : Move to the cemetery
        }

        return $this;
    }
}
