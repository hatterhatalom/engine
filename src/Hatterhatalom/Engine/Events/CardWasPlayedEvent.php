<?php

namespace Hatterhatalom\Engine\Events;

use Hatterhatalom\Engine\Cards\Card;

/**
 * Class CardWasPlayedEvent represents the event fired when a card has been
 * played.
 */
class CardWasPlayedEvent extends Event
{
    public function __construct(Card $card)
    {
        $this->payload = $card;
    }
}
