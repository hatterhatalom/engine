<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Cards\Card;
use Hatterhatalom\Engine\Events\Event;

class CardWasDestroyed extends Event
{
    public function __construct(Card $payload)
    {
        parent::__construct($payload);
    }
}
