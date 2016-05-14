<?php

namespace Hatterhatalom\Engine\Contracts;

use Hatterhatalom\Engine\Cards\Card;
use Hatterhatalom\Engine\Cards\CardCollection;

interface CardLocation
{
    /**
     * Gets the card located in the location
     *
     * @return CardCollection
     */
    public function cards();

    /**
     * Adds a card to the location.
     *
     * @param Card $card
     */
    public function addCard(Card $card);
}
