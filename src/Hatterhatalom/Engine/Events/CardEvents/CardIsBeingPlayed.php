<?php

namespace Hatterhatalom\Engine\Events\CardEvents;

use Hatterhatalom\Engine\Events\Arguments\CardAction;
use Hatterhatalom\Engine\Events\Event;

class CardIsBeingPlayed extends Event
{
    public function __construct(CardAction $payload)
    {
        parent::__construct($payload);
    }
}
