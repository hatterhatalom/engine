<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Cards\Card;

class CardWasDestroyed extends CardEvent
{
    public function __construct(Card $payload)
    {
        parent::__construct($payload);
    }
}
