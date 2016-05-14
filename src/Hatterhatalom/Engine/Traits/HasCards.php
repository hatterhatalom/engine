<?php

namespace Hatterhatalom\Engine\Traits;

use Hatterhatalom\Engine\Cards\Card;
use Hatterhatalom\Engine\Cards\CardCollection;

/**
 * Trait HasCards is a basic implementation of the CardLocation interface.
 */
trait HasCards
{
    /**
     * The cards of the entity.
     *
     * @var CardCollection
     */
    protected $cardCollection;

    /**
     * Gets the cards of the entity.
     *
     * @return CardCollection
     */
    public function cards()
    {
        if (!($this->cardCollection instanceof CardCollection)) {
            $this->cardCollection = new CardCollection();
        }

        return $this->cardCollection;
    }

    /**
     * Adds a card to the location.
     *
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        $this->cards()->push($card);
    }
}
