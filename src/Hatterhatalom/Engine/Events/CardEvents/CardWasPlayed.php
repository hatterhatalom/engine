<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Cards\Card;

/**
 * Class CardWasPlayed represents the event fired when a card has been
 * played.
 */
class CardWasPlayed extends CardEvent
{
    /**
     * CardWasPlayed constructor.
     *
     * @param Card $payload
     */
    public function __construct(Card $payload)
    {
        parent::__construct($payload);
    }
}
